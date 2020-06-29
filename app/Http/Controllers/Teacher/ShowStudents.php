<?php
/*
 * This Controller show all students from advisers table where advisers.teacher_id
 */
namespace App\Http\Controllers\Teacher;

use App\Adviser;
use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowStudents extends Controller
{
    use CheckRole;
    use Notifications;

    public function showStudents(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            //Get teacher id from teachers table
            $teacher = Teacher::where('user_id', $user_id)->get();

            foreach ($teacher as $id){
                $teacher_id = $id->id;
            }

            //Get requests from students from advisers table
            $requests = Adviser::where('teacher_id', $teacher_id)->orderBy('updated_at', 'desc')->paginate(10);

            $notifications = $this->notifications();

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('teacher.showStudents', ['requests' => $requests, 'notifications' => $notifications, 'message' => $message, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }

}
