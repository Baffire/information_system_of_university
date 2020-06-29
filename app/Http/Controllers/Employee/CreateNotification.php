<?php
/*
 * This Controller create one new notification in notifications tables
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateNotification extends Controller
{
    use CheckRole;

    public function createNotification(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();

            if ($request->has('text') && $request->has('start_date') && $request->has('finish_date') && ($request->has('teachers') || $request->has('students'))) {

                $request->validate([
                    'text' => 'required|unique:App\Notification,text|max:255|bail',
                    'start_date' => 'required|date|after:yesterday',
                    'finish_date' => 'required|date|after:start_date',
                    'teachers' => 'boolean|nullable',
                    'students' => 'boolean|nullable',
                    'training_programs' => 'required_unless:students,1',
                ]);

                $notification = new Notification();

                $notification->user_id = $user_id;
                $notification->text = $request->text;
                $notification->start_date = $request->start_date;
                $notification->finish_date = $request->finish_date;
                $notification->faculty_id = $faculty_id;
                $notification->department_id = $department_id;

                if ($request->teachers == 1) {
                    $notification->teachers = $request->teachers;
                }

                if ($request->students == 1) {
                    $notification->students = $request->students;
                    $notification->training_program_id = $request->training_programs;
                }

                $notification->save();

                $request->session();
                $request->session()->put('message', "Оповещение успешно создано");

                return redirect('/employee/notification/create');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.createNotification', ['message' => $message, 'training_programs' => $training_programs]);
        } else {
            return redirect('/');
        }
    }
}
