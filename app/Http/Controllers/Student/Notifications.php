<?php
/* The trait show notifications on students pages
 * */

namespace App\Http\Controllers\Student;

use App\Notification;
use App\Student;
use Illuminate\Support\Facades\Auth;

trait Notifications
{
    protected function notifications()
    {
        $user_id = Auth::id();

        $student = Student::where('user_id', $user_id)->first();

        $department_id = $student->department_id;
        $training_program_id = $student->training_program_id;

        $notifications = Notification::where(['department_id' => $department_id, 'training_program_id' => $training_program_id, 'students' => 1])->get();

        return $notifications;
    }
}


