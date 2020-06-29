<?php
/*Controller show diplomas titles
 * */

namespace App\Http\Controllers\Student;

use App\Adviser;
use App\Http\Controllers\Controller;
use App\Student;
use App\Title;
use App\Title_confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTitles extends Controller
{
    use CheckRole;
    use Notifications;

    public function showTitles(Request $request)
    {
        if ($this->checkRole()) {

            $user_id = Auth::id();
            $student = Student::where('user_id', $user_id)->first();
            $student_id = $student->id;
            $department_id = $student->department_id;
            $training_program = $student->training_program_id;

            //Get all titles which contain same department_id and control status true from titles table
            $titles = Title::where(['department_id' => $department_id, 'training_program_id' => $training_program, 'control' => '1'])->orderBy('created_at', 'desc')->paginate(5);

            //Get all titles which contain same student_id from advisers table and not ignored
            $advisers_titles = Adviser::where(['student_id' => $student_id])->orderBy('created_at', 'desc')->first();

            if ($request->has('choose')) {

                $title_id = $request->choose;

                $titles_head = Title_confirm::where(['title_id' => $title_id, 'confirmation' => 1])->first();

                if (empty($titles_head)) {

                    $teacher = Title::where('id', $title_id)->first();
                    $teacher_id = $teacher->teacher_id;

                    $advisers_teachers = Adviser::where(['teacher_id' => $teacher_id, 'student_id' => $student_id, 'title_id' => $title_id])->count();
                    $advisers_ignored = Adviser::where(['teacher_id' => $teacher_id, 'student_id' => $student_id, 'title_id' => $title_id, 'ignored' => 1])->count();
                    $advisers_confirm = Title_confirm::where(['student_id' => $student_id, 'confirmation' => 1])->first();
                    $advisers_negative = Title_confirm::where(['student_id' => $student_id, 'negative' => 1])->first();

                    if (empty($advisers_confirm)) {
                        if ($advisers_teachers > 0 && $advisers_teachers < 3) {
                            if ($advisers_titles->negative != null || $advisers_titles->ignored != null || ($advisers_titles->confirmation == 1 && !empty($advisers_negative))) {
                                $title_adviser = new Adviser;

                                $title_adviser->teacher_id = $teacher_id;
                                $title_adviser->student_id = $student_id;
                                $title_adviser->title_id = $request->choose;

                                $title_adviser->save();

                                $request->session();
                                $request->session()->put('message', "Заявка отправлена");
                                $request->session()->put('status', "success");

                            } else {
                                $request->session();
                                $request->session()->put('message', "Вы отправили заявку " . date('d.m.Y', strtotime("$advisers_titles->created_at")) . ". Ожидайте результатов");
                                $request->session()->put('status', "warning");

                            }
                        } elseif ($advisers_teachers == 0) {
                            if (!empty($advisers_titles) && ($advisers_titles->negative == 1 || $advisers_titles->ignored == 1) || (!empty($advisers_titles) && $advisers_titles->confirmation == 1 && !empty($advisers_negative))) {
                                $title_adviser = new Adviser;

                                $title_adviser->teacher_id = $teacher_id;
                                $title_adviser->student_id = $student_id;
                                $title_adviser->title_id = $request->choose;

                                $title_adviser->save();

                                $request->session();
                                $request->session()->put('message', "Заявка отправлена");
                                $request->session()->put('status', "success");

                            } elseif (empty($advisers_titles)) {

                                $title_adviser = new Adviser;

                                $title_adviser->teacher_id = $teacher_id;
                                $title_adviser->student_id = $student_id;
                                $title_adviser->title_id = $request->choose;

                                $title_adviser->save();

                                $request->session();
                                $request->session()->put('message', "Заявка отправлена");
                                $request->session()->put('status', "success");

                            } else {
                                $request->session();
                                $request->session()->put('message', "Вы отправили заявку " . date('d.m.Y', strtotime("$advisers_titles->created_at")) . ". Ожидайте результатов");
                                $request->session()->put('status', "warning");
                            }

                        } elseif ($advisers_ignored == 3) {
                            $request->session();
                            $request->session()->put('message', "Превышен лимит. Выберите другую тему");
                            $request->session()->put('status', "warning");
                        }
                    } else {
                        $request->session();
                        $request->session()->put('message', "За вами уже закреплены тема и руководитель");
                        $request->session()->put('status', "danger");
                    }

                } else {
                    $request->session();
                    $request->session()->put('message', "Тема уже закреплена");
                    $request->session()->put('status', "danger");
                }


                return redirect('student/titles');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('student.showTitles', ['titles' => $titles, 'advisers_titles' => $advisers_titles, 'message' => $message, 'notifications' => $notifications, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
