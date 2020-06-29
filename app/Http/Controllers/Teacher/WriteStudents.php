<?php
/*
 * This Controller write student.id and teacher.id in title_confirms table when teacher confirm students choosing
 */
namespace App\Http\Controllers\Teacher;

use App\Adviser;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title_confirm;
use Illuminate\Http\Request;
use App\Http\Controllers\TitleIgnored;

class WriteStudents extends Controller
{
    use CheckRole;

    public function writeStudents(Request $request, $confirm, $id)
    {
        if ($this->checkRole()) {

            //Check created date for search ignored requests
            if (!empty($advisers_titles_ignored)) {
                $newTitleIgnored = new TitleIgnored();
                $newTitleIgnored->titleIgnored();
            }

            $confirm_adviser = Adviser::find($id);

            $advisers = Adviser::where(['student_id' => $confirm_adviser->student_id, 'confirmation' => 1])->first();
            $confirm_heads = Title_confirm::where(['title_id' => $confirm_adviser->title_id, 'confirmation' => 1])->first();
            $confirm_teachers = Adviser::where(['title_id' => $confirm_adviser->title_id, 'confirmation' => 1])->first();

            if ( empty($advisers) && empty($confirm_heads)) {
                if ( empty($confirm_teachers) ) {
                    if ( $confirm == 1 ) {
                        $confirm_adviser->confirmation = '1';

                        $teacher_id = $confirm_adviser->teacher_id;
                        $student_id = $confirm_adviser->student_id;
                        $title_id = $confirm_adviser->title_id;

                        //Get department_id from teacher table
                        $teacher = Teacher::find($teacher_id);

                        $department_id = $teacher->department_id;

                        $title_confirm_new = new Title_confirm();

                        $title_confirm_new->teacher_id = $teacher_id;
                        $title_confirm_new->student_id = $student_id;
                        $title_confirm_new->title_id = $title_id;
                        $title_confirm_new->department_id = $department_id;

                        $title_confirm_new->save();
                    } else {
                        $confirm_adviser->negative = '1';
                    }

                    $confirm_adviser->save();
                } else {
                    $request->session();
                    $request->session()->put('message', "Тема закреплена за другим студентом");
                    $request->session()->put('status', "danger");

                    $confirm_adviser->negative = '1';
                    $confirm_adviser->save();
                }
            } else {
                $request->session();
                $request->session()->put('message', "Студент закреплен за другим руководителем");
                $request->session()->put('status', "danger");

                $confirm_adviser->negative = '1';
                $confirm_adviser->save();
            }

            return redirect('teacher/students');

        } else {
            return redirect('/');
        }
    }
}
