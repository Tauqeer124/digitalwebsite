<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\Wallet;
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
        $balance = Wallet::where('user_id', $id)->orderBy('created_at', 'desc')->first();
        $withdraw = Wallet::where('user_id',$id)->sum('withdraw_amount');
        $point = Wallet::where('user_id',$id)->sum('points_reward');
        $refer = Tree::where('parent_id',$id)->count();
        // dd($balance);
        return view('admin.dashboard' , compact('total_package','balance','refer','withdraw','point'));
    }
}
