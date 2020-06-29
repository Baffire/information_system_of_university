<?php
/* The trait show notifications on students pages
 * */

namespace App\Http\Controllers\Teacher;

use App\Notification;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

trait Notifications
{
    protected function notifications()
    {
        $user_id = Auth::id();

        $teacher = Teacher::where('user_id', $user_id)->first();

        $department_id = $teacher->department_id;
        $today = date('Y-m-d');

        $notifications = Notification::where(['department_id' => $department_id, 'teachers' => 1])->get();

        return $notifications;
    }
}


