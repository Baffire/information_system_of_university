<?php
/*
 * This Controller write student.id and teacher.id in title_confirms table when teacher confirm students choosing
 */

namespace App\Http\Controllers\Teacher;

use App\Adviser;
use App\Http\Controllers\Controller;
use App\Title_confirm;
use App\Title_from_student;
use Illuminate\Http\Request;

class WriteStudentsTitles extends Controller
{
    use CheckRole;

    public function writeStudentsTitles(Request $request, $confirm, $id)
    {
        if ($this->checkRole()) {

            $confirm_adviser = Title_from_student::find($id);

            $advisers = Adviser::where(['student_id' => $confirm_adviser->student_id, 'confirmation' => 1])->first();
            $confirm_heads = Title_confirm::where(['title_id' => $confirm_adviser->title_id, 'confirmation' => 1])->first();
            $confirm_teachers = Title_from_student::where(['student_id' => $confirm_adviser->student_id, 'confirmation' => 1])->first();

            if (empty($advisers) && empty($confirm_heads)) {
                if (empty($confirm_teachers)) {
                    if ($confirm == 1) {
                        $confirm_adviser->confirmation = '1';
                        $confirm_adviser->save();

                        $request->session();
                        $request->session()->put('message', "Одобрено. Предложите тему заведующему кафедрой для утверждения");
                        $request->session()->put('status', "success");
                    } else {
                        $confirm_adviser->negative = '1';
                        $confirm_adviser->save();
                    }
                } else {
                    $confirm_adviser->negative = '1';
                    $confirm_adviser->save();
                }
            } else {
                $confirm_adviser->negative = '1';
                $confirm_adviser->save();

                $request->session();
                $request->session()->put('message', "Студент закреплен за другим руководителем");
                $request->session()->put('status', "danger");
            }

            return redirect('teacher/students/titles');

        } else {
            return redirect('/');
        }
    }
}
