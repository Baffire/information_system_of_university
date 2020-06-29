<?php
/*
 * This Controller create one new teacher in teachers and users tables
 */

namespace App\Http\Controllers\Employee;

use App\Academic_degree;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Post;
use App\Status;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateTeacher extends Controller
{
    use CheckRole;

    public function createTeacher(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
            }

            $academic_degrees = Academic_degree::all();
            $statuses = Status::all();
            $posts = Post::all();

            if ($request->has('name') && $request->has('surname') && $request->has('email') && $request->has('password') && $request->has('password_confirmation') && $request->has('post')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|unique:users,email|bail',
                    'password' => 'required|string|min:8|confirmed',
                    'post' => 'required|bail',
                ]);

                $user = new User();

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;
                $user->email = $request->email;
                $user->role_id = 3;
                $user->password = Hash::make($request->password);

                $user->save();

                $last_user = User::orderBy('id', 'desc')->first();

                $teacher = new Teacher();

                $teacher->user_id = $last_user->id;
                $teacher->faculty_id = $faculty_id;
                $teacher->department_id = $department_id;

                if (!empty($request->academic_degree)) {
                    $teacher->academic_degree_id = $request->academic_degree;
                }

                if (!empty($request->status)) {
                    $teacher->status_id = $request->status;
                }

                $teacher->post_id = $request->post;
                $teacher->role_id = 3;

                $teacher->save();

                $request->session();
                $request->session()->put('message', "Пользователь успешно создан");

                return redirect(view('employee.createTeacher'));
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.createTeacher', ['message' => $message, 'academic_degrees' => $academic_degrees, 'statuses' => $statuses, 'posts' => $posts]);
        } else {
            return redirect('/');
        }
    }
}
