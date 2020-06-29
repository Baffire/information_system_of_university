<?php
/*Controller show diplomas titles from students to teachers
 * */

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use App\Title_from_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTeacherTitles extends Controller
{
    use CheckRole;
    use Notifications;

    public function showTeacherTitles(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();
            $student = Student::where('user_id', $user_id)->first();
            $student_id = $student->id;

            //Get all titles which contain same student_id from title_from_students table
            $titles = Title_from_student::where(['student_id' => $student_id])->orderBy('created_at', 'desc')->paginate(10);

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('student.showTeacherTitles', ['titles' => $titles, 'message' => $message, 'notifications' => $notifications, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
