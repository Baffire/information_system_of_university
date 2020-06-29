<?php
/*Controller allowed head of department create comment to negative response
 * */

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;

class CreateTitlesNegativeComment extends Controller
{
    use CheckRole;

    public function createTitlesNegativeComment(Request $request, $id)
    {
        if ($this->checkRole()) {

            $title = Title::find($id);

            if ($request->has('comment')) {

                $request->validate([
                    'comment' => 'required|bail',
                ]);

                $title->comment = $request->comment;
                $title->save();

                $request->session();
                $request->session()->put('message', "Комментарий отправлен. Тема отклонена");
                $request->session()->put('status', "success");

                return redirect()->route('head_titles');
            }

            return view('head.createTitlesNegativeComment');
        } else {
            return redirect('/');
        }
    }
}
