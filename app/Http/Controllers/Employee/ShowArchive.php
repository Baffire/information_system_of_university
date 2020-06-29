<?php
/*
 * This Controller show all titles from title_confirms table which was protected
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Title_confirm;

class ShowArchive extends Controller
{
    use CheckRole;

    public function showArchive()
    {
        if ($this->checkRole()) {

            $titles = Title_confirm::where('estimate', '!=', null)->orderBy('date_thesis_defense', 'desc')->paginate(10);

            return view('employee.showArchive', ['titles' => $titles]);
        } else {
            return redirect('/');
        }
    }
}
