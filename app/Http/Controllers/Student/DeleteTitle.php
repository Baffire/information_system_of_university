<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Title_from_student;
use Illuminate\Http\Request;

class DeleteTitle extends Controller
{
    use CheckRole;
    use Notifications;

    public function deleteTitle(Request $request, $id)
    {
        if ($this->checkRole()) {

            $student_title = Title_from_student::find($id);

            if ($student_title->confirmation == null) {
                Title_from_student::find($id)->delete();

                $request->session();
                $request->session()->put('message', "Заявка удалена");
                $request->session()->put('status', "success");

                return redirect('/student/teachers/show_titles');
            } else {
                $request->session();
                $request->session()->put('message', "Нельзя удалить принятую заявку");
                $request->session()->put('status', "danger");

                return redirect('/student/teachers/show_titles');
            }

        } else {
            return redirect('/');
        }
    }
}
