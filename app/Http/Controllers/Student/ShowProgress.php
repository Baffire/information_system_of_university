<?php
/*Controller show data from degree_of_preparatoions table
 * */

namespace App\Http\Controllers\Student;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowProgress extends Controller
{
    use CheckRole;
    use Notifications;

    public function showProgress(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();
            $student = Student::where('user_id', $user_id)->first();
            $student_id = $student->id;

            $roadmaps = Degree_of_preparation::where(['student_id' => $student_id])->get();

            $notifications = $this->notifications();

            return view('student.showProgress', ['roadmaps' => $roadmaps, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
