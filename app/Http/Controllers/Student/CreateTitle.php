<?php

namespace App\Http\Controllers\Student;

use App\Adviser;
use App\Http\Controllers\Controller;
use App\Student;
use App\Title_from_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTitle extends Controller
{
    use CheckRole;
    use Notifications;

    public function createTitle(Request $request, $id)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();
            $teacher_id = $id;
            $student = Student::where('user_id', $user_id)->first();
            $student_id = $student->id;

            //Check double orders
            $advisers = Adviser::where(['student_id' => $student_id, 'confirmation' => 1])->count();

            if ($advisers == 0) {
                if ($request->has('name') && $request->has('description') && $request->has('software')) {

                    $request->validate([
                        'name' => 'required|string|max:255|unique:App\Title,name|bail',
                        'description' => 'required|string|bail',
                        'software' => 'required|string|bail',
                    ]);

                    $title = new Title_from_student();

                    $title->student_id = $student_id;
                    $title->teacher_id = $teacher_id;
                    $title->name = $request->name;
                    $title->description = $request->description;
                    $title->software = $request->software;

                    $title->save();

                    $request->session();
                    $request->session()->put('message', "Заявка отправлена");
                    $request->session()->put('status', "success");

                    return redirect('/student/teachers');
                }
            } else {
                $request->session();
                $request->session()->put('message', "За вами уже закреплены руководитель и тема");
                $request->session()->put('status', "danger");

                return redirect('/student/teachers');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('student.createTitle', ['message' => $message, 'status' => $status, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
