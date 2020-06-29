<?php
/* The Controller show heads from heads table
 * */

namespace App\Http\Controllers\Admin;

use App\Head;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowHeads extends Controller
{
    use CheckRole;

    public function showHeads(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $sortHeads = $request->session()->get('sortHeads');

            if ($request->sort == null && $sortHeads == null) {
                $sortHeads = null;
                $request->session()->put('sortHeads', $sortHeads);
            } elseif ($request->sort == null && !empty($sortHeads)) {
                $request->session()->put('sortHeads', $sortHeads);
            } else {
                $sortHeads = $request->sort;
                $request->session()->put('sortHeads', $sortHeads);
            }

            switch ($sortHeads) {
                case 'created_at':
                    $order = 'desc';
                    break;
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortHeads) {
                $heads = Head::orderBy($sortHeads, $order)->paginate(10);
            } else {
                $heads = Head::paginate(10);
            }

            return view('admin.showHeads', ['heads' => $heads]);
        } else {
            return redirect('/');
        }
    }
}
