<?php
/*
 * This Controller select all notifications of department from notifications table
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class ShowNotifications extends Controller
{
    use CheckRole;

    public function showNotifications()
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
            }

            $notifications = Notification::where(['department_id' => $department_id])->orderBy('created_at', 'desc')->paginate(10);

            return view('employee.showNotifications', ['notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
