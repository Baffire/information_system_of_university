<?php
/*
 * This Controller show templates for documents
 */

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class ShowTemplates extends Controller
{
    use CheckRole;
    use Notifications;

    public function showTemplates()
    {
        if ($this->checkRole()) {

            $notifications = $this->notifications();

            return view('teacher.showTemplates', ['notifications' => $notifications,]);
        } else {
            return redirect('/');
        }
    }
}
