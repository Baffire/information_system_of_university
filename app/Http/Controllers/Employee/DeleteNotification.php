<?php
/*
 * This Controller delete one notification in notifications tables
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class DeleteNotification extends Controller
{
    use CheckRole;

    public function deleteNotification(Request $request, $id)
    {
        if ($this->checkRole()) {
            Notification::find($id)->delete();
            $request->session();
            $request->session()->put('message', "Оповещение успешно удалено");

            return redirect()->route('employee_notifications');
        } else {
            return redirect('/');
        }
    }
}
