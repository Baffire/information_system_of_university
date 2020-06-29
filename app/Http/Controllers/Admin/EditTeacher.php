<?php
/* The Controller edit one teacher
 * */

namespace App\Http\Controllers\Admin;

use App\Academic_degree;
use App\Department;
use App\Http\Controllers\Controller;
use App\Post;
use App\Status;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class EditTeacher extends Controller
{
    use CheckRole;

    public function editTeacher(Request $request, $id)
    {
        if ($this->checkRole()) {

            $teacher = Teacher::find($id);
            $user_id = $teacher->user_id;
            $faculty_id = $teacher->faculty_id;
            $user = User::where('id', $user_id)->first();
            $departments = Department::where('faculty_id', $faculty_id)->get();
            $academic_degrees = Academic_degree::all();
            $statuses = Status::all();
            $posts = Post::all();


//            dd( $request->has('email') );
            if ($request->has('name') && $request->has('surname') && $request->has('email') && $request->has('department_id') && $request->has('post')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|max:255|bail',
                    'department_id' => 'required|integer|bail',
                    'academic_degree' => 'integer|bail',
                    'status' => 'integer|bail',
                    'post' => 'required|integer|bail',
                ]);

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;
                $user->email = $request->email;

                $user->save();

                $teacher->department_id = $request->department_id;

                if ($request->has('academic_degree')) {
                    $teacher->academic_degree_id = $request->academic_degree;
                }

                if ($request->has('status')) {
                    $teacher->status_id = $request->status;
                }

                $teacher->post_id = $request->post;

                $teacher->save();

                return redirect('/admin/teachers');
            }

            return view('admin.editTeacher', ['teacher' => $teacher, 'departments' => $departments, 'academic_degrees' => $academic_degrees, 'statuses' => $statuses, 'posts' => $posts]);
        } else {
            return redirect('/');
        }
    }
}
