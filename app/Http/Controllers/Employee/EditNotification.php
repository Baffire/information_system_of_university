<?php
/*
 * This Controller edit one notification in notifications tables
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditNotification extends Controller
{
    use CheckRole;

    public function editNotification(Request $request, $id)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();

            $notification = Notification::find($id);

            if ($request->has('text') && $request->has('start_date') && $request->has('finish_date') && ($request->has('teachers') || $request->has('students'))) {

                $request->validate([
                    'text' => 'required|max:255|bail',
                    'start_date' => 'required|date',
                    'finish_date' => 'required|date',
                    'teachers' => 'boolean|nullable',
                    'students' => 'boolean|nullable',
                    'training_programs' => 'required_with:students,1',
                ]);

                $notification->text = $request->text;
                $notification->start_date = $request->start_date;
                $notification->finish_date = $request->finish_date;

                if ($request->teachers == 1) {
                    $notification->teachers = $request->teachers;
                }

                if ($request->students == 1) {
                    $notification->students = $request->students;
                    $notification->training_program_id = $request->training_programs;
                }

                $notification->update();

                $request->session();
                $request->session()->put('message', "Оповещение успешно изменено");

                return redirect("/employee/notifications/edit/$id");
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.editNotification', ['message' => $message, 'training_programs' => $training_programs, 'notification' => $notification]);
        } else {
            return redirect('/');
        }
    }
}
