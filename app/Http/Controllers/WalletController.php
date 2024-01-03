<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show(){
        $id = Auth::user()->id;
        $transactions = Wallet::where('user_id', $id)->get();
        // dd($transactions);
        return view('wallet', compact('transactions'));
    }
}
