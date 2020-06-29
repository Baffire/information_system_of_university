<?php
/*
 * This Controller show students from degree_of_preparations table where degree_of_preparations.student_id == advisers.student_id
 */

namespace App\Http\Controllers\Teacher;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;

class ProgressMyStudents extends Controller
{
    use CheckRole;
    use Notifications;

    public function progressMyStudents($id)
    {
        if ($this->checkRole()) {
            $roadmaps = Degree_of_preparation::where(['student_id' => $id])->get();

            $notifications = $this->notifications();

            return view('teacher.progressMyStudents', ['roadmaps' => $roadmaps, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
