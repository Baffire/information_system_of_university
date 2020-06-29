<?php
/*Controller allows download files from my student
 * */

namespace App\Http\Controllers\Teacher;

use App\Adviser;
use App\File;
use App\Http\Controllers\Controller;
use App\Student;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

class DownloadFileMyStudents extends Controller
{
    use CheckRole;

    public function downloadFileMyStudents($id, $student_id)
    {
        if ($this->checkRole()) {
            $file = File::find($id);

            $user_id = Auth::id();
            $teacher = Teacher::where('user_id', $user_id)->get();

            foreach ($teacher as $item) {
                $teacher_id = $item->id;
            }

            $adviser = Adviser::where(['teacher_id' => $teacher_id, 'student_id' => $student_id, 'confirmation' => 1])->first();

            $student_user = Student::where('id', $student_id)->first();
            $student_user_id = $student_user->user_id;

            if ($file && ($adviser != null) && ($file->user_id == $student_user_id)) {
                $file_path = $file->path;
                $dir_path = $_SERVER['DOCUMENT_ROOT'];
                $dir = str_replace('public', 'storage/app/', $dir_path);
                $file = $dir . $file_path;

                return response()->download($file);
            }

            return redirect("/teacher/my_students/progress/$student_id");
        } else {
            return redirect('/');
        }
    }
}
