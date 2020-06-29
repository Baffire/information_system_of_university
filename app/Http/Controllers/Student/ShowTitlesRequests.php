<?php
/*Controller show requests to advisers and titles
 * */

namespace App\Http\Controllers\Student;

use App\Adviser;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTitlesRequests extends Controller
{
    use CheckRole;
    use Notifications;

    public function showTitlesRequests(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();
            $student = Student::where('user_id', $user_id)->first();
            $student_id = $student->id;

            //Get all titles which contain same department_id and control status true from titles table
            $titles = Adviser::where(['student_id' => $student_id])->orderBy('created_at', 'desc')->paginate(10);

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('student.showTitlesRequests', ['titles' => $titles, 'message' => $message, 'notifications' => $notifications, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
