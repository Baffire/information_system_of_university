<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Title_from_student;
use Illuminate\Http\Request;

class EditTitle extends Controller
{
    use CheckRole;
    use Notifications;

    public function editTitle(Request $request, $id)
    {
        if ($this->checkRole()) {

            $student_title = Title_from_student::find($id);

            if ($request->has('name') && $request->has('description') && $request->has('software')) {

                $request->validate([
                    'name' => 'required|string|max:255|unique:App\Title,name|bail',
                    'description' => 'required|string|bail',
                    'software' => 'required|string|bail',
                ]);

                $student_title->name = $request->name;
                $student_title->description = $request->description;
                $student_title->software = $request->software;

                $student_title->save();

                $request->session();
                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");

                return redirect('/student/teachers/show_titles');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('student.editTitle', ['message' => $message, 'status' => $status, 'notifications' => $notifications, 'student_title' => $student_title]);
        } else {
            return redirect('/');
        }
    }
}
