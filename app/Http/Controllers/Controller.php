<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    
    public function dashboard(){
        $id = Auth::user()->id;
        $total_package = Tree::where('user_id',$id)->count();
        return view('admin.dashboard' , compact('total_package'));
    }
}
