<?php
/*
 * This Controller show students from advisers table where advisers.teacher_id == teachers.id and confirmation == 1
 */

namespace App\Http\Controllers\Teacher;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title_confirm;
use Illuminate\Support\Facades\Auth;

class ShowMyStudents extends Controller
{
    use CheckRole;
    use Notifications;

    public function showMyStudents()
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $teacher = Teacher::where('user_id', $user_id)->get();

            foreach ($teacher as $item) {
                $teacher_id = $item->id;
            }

            $students = Title_confirm::where(['teacher_id' => $teacher_id, 'confirmation' => 1, 'estimate' => null])->orderBy('created_at', 'desc')->paginate(10);

            if (count($students) != 0) {
                foreach ($students as $student) {
                    $student_id = $student->student_id;

                    $roadmap = Degree_of_preparation::where('student_id', $student_id)->get();
                    $roadmap_confirm = Degree_of_preparation::where(['student_id' => $student_id, 'confirmation' => 1])->get();

                    $all = count($roadmap);
                    $confirm = count($roadmap_confirm);

                    if ($confirm && $all) {
                        $percent = $confirm * 100 / $all;
                        $progress_bar = $percent . "%";
                    } else {
                        $progress_bar = '0%';
                    }
                }

                $notifications = $this->notifications();
                return view('teacher.showMyStudents', ['students' => $students, 'teacher' => $teacher, 'notifications' => $notifications, 'progress_bar' => $progress_bar]);

            } else {
                $notifications = $this->notifications();
                return view('teacher.showMyStudents', ['students' => $students, 'teacher' => $teacher, 'notifications' => $notifications]);
            }

        } else {
            return redirect('/');
        }
    }
}
