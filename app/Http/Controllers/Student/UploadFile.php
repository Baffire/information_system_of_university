<?php
/*Controller allows upload files
 * */

namespace App\Http\Controllers\Student;

use App\Degree_of_preparation;
use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadFile extends Controller
{
    use CheckRole;
    use Notifications;

    public function uploadFile(Request $request, $id)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            if ($request->has('file') && !empty($id)) {

                $request->validate([
                    'file' => 'required|file|mimes:doc,docx|bail',
                ]);

                $path = $request->file('file')->store(
                    'public/students_files/' . $request->user()->id
                );

                $file = new File();

                $file->path = $path;
                $file->user_id = $user_id;

                $file->save();

                $last_file_id = File::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();

                $degree_of_preparation = Degree_of_preparation::find($id);

                $degree_of_preparation->file_id = $last_file_id->id;

                $degree_of_preparation->save();

                $request->session();
                $request->session()->put('message', "Файл успешно загружен");

                return redirect('/student/progress');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $notifications = $this->notifications();

            return view('student.uploadFile', ['message' => $message, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
