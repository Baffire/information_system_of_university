<?php
/*
 * This Controller show all titles from title_confirms table which was protected
 */

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Title_confirm;

class ShowArchive extends Controller
{
    use CheckRole;
    use Notifications;

    public function showArchive()
    {
        if ($this->checkRole()) {

            $titles = Title_confirm::where('estimate', '!=', null)->orderBy('date_thesis_defense', 'desc')->paginate(10);

            $notifications = $this->notifications();

            return view('teacher.showArchive', ['titles' => $titles, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
