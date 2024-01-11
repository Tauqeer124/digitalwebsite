<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Tree;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show(){
        $id = Auth::user()->id;
        $transactions = Wallet::where('user_id', $id)->get();
        // dd($transactions);
        return view('wallet', compact('transactions'));
    }
    public function AllUserWallet(){
        $transactions = Wallet::all();
        // dd($transactions);
        return view('wallet', compact('transactions'));
    }
    public function withdrawAmount(Request $request)
    {
        $userId = Auth::user()->id;
    
        // Fetch the user's wallet entry with the maximum total balance
        $userWalletEntry = Wallet::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
       
    
        if (!$userWalletEntry) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        // Calculate the total balance
        $totalBalance = $userWalletEntry->total_balance;
    
        $withdrawAmount = 0;
    
        // Check the total balance and set the withdrawal amount accordingly
        if ($totalBalance >= 50000.00 && $totalBalance < 100000.00) {
            $withdrawAmount = 10000;
        } elseif ($totalBalance >= 100000) {
            $withdrawAmount = 20000;
        }
    
        // Ensure there's enough balance for withdrawal
        if ($totalBalance >= $withdrawAmount) {
            // Begin a database transaction
            DB::beginTransaction();
    
            try {
                // Deduct the withdrawal amount from the total balance
                $userWalletEntry->total_balance -= $withdrawAmount;
                // $userWalletEntry->save();
    
                // Create a new transaction entry for the withdrawal
                $withdrawalTransaction = new Wallet([
                    'user_id' => $userId,
                    'total_balance' => $userWalletEntry->total_balance, // Negative value for withdrawal
                    'withdraw_amount' => $withdrawAmount,
                    'description'  => 'withdrawal',
                ]);
    
                $withdrawalTransaction->save();
    
                // Commit the transaction
                DB::commit();
    
                return redirect()->back()->with('success', 'Withdrawal successful. Amount: $' . $withdrawAmount);
            } catch (\Exception $e) {
                // Rollback the transaction in case of an error
                DB::rollback();
    
                return redirect()->back()->with('error', 'Error during withdrawal. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Insufficient balance for withdrawal.');
        }
    }
         
}
