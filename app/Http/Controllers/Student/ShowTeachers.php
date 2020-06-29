<?php
/*Controller show teachers from students.department_id
 * */

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTeachers extends Controller
{
    use CheckRole;
    use Notifications;

    public function showTeachers(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();
            $student = Student::where('user_id', $user_id)->first();
            $department_id = $student->department_id;

            $teachers = Teacher::where('department_id', $department_id)->paginate(10);

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('student.showTeachers', ['message' => $message, 'status' => $status, 'teachers' => $teachers, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
