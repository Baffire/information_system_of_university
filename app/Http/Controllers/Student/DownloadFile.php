<?php
/*Controller allows download files
 * */

namespace App\Http\Controllers\Student;

use App\Degree_of_preparation;
use App\File;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Support\Facades\Auth;

class DownloadFile extends Controller
{
    use CheckRole;

    public function downloadFile($id)
    {
        if ($this->checkRole()) {

            $roadmap = Degree_of_preparation::find($id);

            $file_id = $roadmap->file_id;
            $student_id = $roadmap->student_id;

            $user_id = Auth::id();
            $student = Student::where('user_id', $user_id)->first();
            $st_id = $student->id;

            if ($student_id === $st_id) {

                $file = File::where(['id' => $file_id, 'user_id' => $user_id])->first();

                if ($file) {

                    $file_path = $file->path;
                    $dir_path = $_SERVER['DOCUMENT_ROOT'];
                    $dir = str_replace('public', 'storage/app/', $dir_path);
                    $file = $dir . $file_path;

                    return response()->download($file);
                }
            }

            return redirect()->route('student_progress');
        } else {
            return redirect('/');
        }
    }
}
