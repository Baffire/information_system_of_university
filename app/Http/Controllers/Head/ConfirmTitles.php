<?php
/*Controller allows set status on titles
 * */

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;

class ConfirmTitles extends Controller
{
    use CheckRole;

    public function confirmTitles(Request $request, $confirm, $id)
    {
        if ($this->checkRole()) {

            $title = Title::find($id);

            if ($confirm == 1) {
                $title->control = 1;
                $title->date_control = date('Y-m-d H:i:s');

                $request->session();
                $request->session()->put('message', "Тема принята");
                $request->session()->put('status', "success");

                $title->save();
            }

            if ($confirm == 0) {
                $title->negative = 1;

                $title->save();

                $request->session();
                $request->session()->put('message', "Тема отклонена");
                $request->session()->put('status', "success");

                return redirect("head/titles/negative/comment/$id");
            }

            return redirect('head/titles');

        } else {
            return redirect('/');
        }
    }
}
