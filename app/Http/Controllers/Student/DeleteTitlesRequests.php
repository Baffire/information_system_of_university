<?php
/*Controller delete ignored requests to advisers and titles
 * */

namespace App\Http\Controllers\Student;

use App\Adviser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteTitlesRequests extends Controller
{
    use CheckRole;

    public function deleteTitlesRequests(Request $request, $id)
    {
        if ($this->checkRole()) {

            $title_request = Adviser::find($id);

            if ($title_request->confirmation == null && $title_request->negative == null && $title_request->ignored == null) {
                Adviser::find($id)->delete();

                $request->session();
                $request->session()->put('message', "Запись успешно удалена");
                $request->session()->put('status', "success");

            } else {

                $request->session();
                $request->session()->put('message', "Проверенная запись не может быть удалена");
                $request->session()->put('status', "danger");

            }

            return redirect()->route('student_titles_requests');

        } else {
            return redirect('/');
        }
    }
}
