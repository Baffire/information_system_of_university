<?php
/*Controller show profile information
 * */

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TitleIgnored;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowProfile extends Controller
{
    use CheckRole;
    use Notifications;

    public function showProfile(Request $request)
    {
        if ($this->checkRole()) {
            //Check created date for search ignored requests
            $newTitleIgnored = new TitleIgnored();
            $newTitleIgnored->titleIgnored();

            $user = Auth::user();

            //Check created date for search ignored requests
            $newTitleIgnored = new TitleIgnored();
            $newTitleIgnored->titleIgnored();

            $notifications = $this->notifications();

            return view('student.showProfile', ['user' => $user, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
