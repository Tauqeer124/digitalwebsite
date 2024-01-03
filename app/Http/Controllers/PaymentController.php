<?php

namespace App\Http\Controllers;

use App\Models\Wallet;

use App\Models\Tree;
use App\Models\User;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment_form(Request $req)
    {
        $package = Package::findOrFail($req->package_id);
        $package_id = $package->id;
        return view('payment', [
            'packageId' => $package_id,
            'accountTitle' => 'Digital Ocean',
            'accountNumber' => '458-9658-5874',

            // Replace with actual account number
        ]);
    }

    public function submitPayment(Request $request)
    {

        // Validate the screenshot and save it
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd('lll');
        $screenshotName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('payment_screenshots'), $screenshotName);


        // Save the payment record
        $payment = new Payment();
        $payment->user_id = Auth::user()->id; // Assuming you are using user authentication
        $payment->image = $screenshotName;
        $payment->transcation_id =  $request->transcation_id;
        $payment->account_title = $request->account_title;
        $payment->account_no = $request->account_no;
        $payment->status = 'pending';
        // dd($payment);
        $payment->save();

        $package = Package::find($request->package_id);
    
        $package_id = $package->id;
        $packagePrice = $package->price;


        $user_id = Auth::user()->id;

        // Check if the current user has a referrer
        $referral_id = User::where('id', $user_id)->value('referrer_id');

        // Create a new tree entry
        $tree = new Tree();
        $tree->user_id = $user_id;
        $tree->package_id = $package_id;

        // If the current user has a referrer, insert the referrer's ID
        if ($referral_id) {
            $tree->parent_id = $referral_id;
            $parentReferrerId = User::where('id', $referral_id)->value('referrer_id');

            // Set the parent referrer ID as the senior if it exists, otherwise use the referrer ID
            $senior_id = $parentReferrerId;
            $tree->senior_id = $senior_id;



            // Check the current block_id for the user's referral link
            $currentBlock = Tree::where('parent_id', $referral_id)
                ->orderByDesc('created_at')
                ->value('block_id');

            if ($currentBlock) {
                // Check the number of members in the current block
                $membersInBlock = Tree::where('parent_id', $referral_id)
                    ->where('block_id', $currentBlock)
                    ->count();

                if ($membersInBlock < 6) {
                    // Increment the member_id within the current block
                    $tree->block_id = $currentBlock;
                    $tree->member_id = $membersInBlock + 1;
                } else {
                    // Start a new block
                    $tree->block_id = $currentBlock + 1;
                    $tree->member_id = 1;
                }
            } else {
                // First member for the referral link and block
                $tree->block_id = 1;
                $tree->member_id = 1;
            }
        }
        $tree->save();

$user = Auth::user();
$user_id = $user->id;
// dd($user_id);
// dd($user);
    $wallet = New Wallet();

    // Determine commission rate based on the package
    $commissionRate = 0;
    if ($packagePrice === 1) {
        $commissionRate = 0.65;
    } elseif ($packagePrice === 2) {
        $commissionRate = 0.70;
    } elseif ($packagePrice === 3) {
        $commissionRate = 0.75;
    } elseif ($packagePrice === 4) {
        $commissionRate = 0.80;
    }
    // dd($wallet);

    // Calculate and update the wallet balance
    $commissionAmount = $packagePrice * $commissionRate;
    // dd($user_id);
    // $wallet->user_id = $user_id;
    $wallet->Total_balance += $commissionAmount;
    $wallet->save();



        return redirect()->route('paymentSubmitted');
    }


    public function viewPayments()
    {
        $payments = Payment::all();

        return view('payment.index', ['payments' => $payments]);
    }
    public function changePaymentStatus($paymentId, $newStatus)
    {
        $payment = Payment::findOrFail($paymentId);

        // Update the payment status and record the admin who made the change
        $payment->status = $newStatus;

        $payment->save();

        return redirect()->back()->with('success', 'Payment status changed successfully.');
    }
}
