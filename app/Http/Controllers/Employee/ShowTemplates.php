<?php
/*
 * This Controller show templates for documents
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class ShowTemplates extends Controller
{
    use CheckRole;

    public function showTemplates()
    {
        if ($this->checkRole()) {
            return view('employee.showTemplates');
        } else {
            return redirect('/');
        }
    }
}
