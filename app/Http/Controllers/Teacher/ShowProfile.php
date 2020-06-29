<?php
/*
 * This Controller show information for profile
 */
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowProfile extends Controller
{
    use CheckRole;
    use Notifications;

    public function showProfile()
    {
        if ($this->checkRole()) {
            $user = Auth::user();

            $notifications = $this->notifications();

            return view('teacher.showProfile', ['user' => $user, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
