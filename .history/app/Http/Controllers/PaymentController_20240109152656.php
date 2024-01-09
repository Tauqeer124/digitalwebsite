<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\Tree;
use App\Models\User;
use App\Models\Wallet;
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

        $request->validate([
            'transcation_id' => 'required',
            'account_title' => 'required',
            'account_no' => 'required',
            'account_type' => 'required|in:Bank,Jazz-Cash,Easypaisa',

        ]);

        // Initialize $screenshotName to null
        $screenshotName = null;

        // Check if an image is provided
        if ($request->hasFile('image')) {

            // Generate a unique name for the screenshot
            $screenshotName = time() . '.' . $request->file('image')->getClientOriginalExtension();

            // Move the image to the specified directory
            $request->file('image')->move(public_path('payment_screenshots'), $screenshotName);
        }

        // Save the payment record
        $payment = new Payment();
        $payment->user_id = Auth::user()->id; // Assuming you are using user authentication
        $payment->image = $screenshotName;
        $payment->transcation_id = $request->transcation_id;
        $payment->account_title = $request->account_title;
        $payment->account_type = $request->account_type;
        $payment->account_no = $request->account_no;

        $payment->status = 'pending';
        // dd($payment);
        $payment->save();

        $package = Package::find($request->package_id);

        $package_id = $package->id;
        $packagePrice = $package->price;
        // dd($packagePrice);

        $user_id = Auth::user()->id;

        // Check if the current user has a referrer
        $referral_id = User::where('id', $user_id)->value('referrer_id');

        // Create a new tree entry
        $tree = new Tree();
        $tree->user_id = $user_id;
        $tree->package_id = $package_id;
       
        $tree->parent_id = 1;

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
        $wallet = new Wallet();

        // Determine commission rate based on the package
        $commissionRate = 0;
        if ($packagePrice == 1000.00) {
            $commissionRate = 0.65;
        } elseif ($packagePrice === 3000.00) {
            $commissionRate = 0.70;
        } elseif ($packagePrice == 5000.00) {
            // dd('fjfkjf');
            $commissionRate = 0.75;
        } elseif ($packagePrice === 10000.00) {
            $commissionRate = 0.80;
        }
        // dd($wallet);

        // Calculate and update the wallet balance
        $commissionAmount = $packagePrice * $commissionRate;
        // dd($commissionAmount);

        // Get the current block and member id for the user's referral link
        $currentBlockInfo = Tree::where('parent_id', $referral_id)
            ->orderByDesc('created_at')
            ->first();

        if ($currentBlockInfo) {
            $currentBlock = $currentBlockInfo->block_id;
            $currentMemberId = $currentBlockInfo->member_id;

            // Check the member id within the current block
            switch ($currentMemberId) {
                case 1:
                    // First member, give 65% of the 1st package

                    $wallet->user_id = $tree->parent_id;
                    $wallet->total_balance = $commissionAmount;
                    $wallet->description = 'income from referal comission';


                    break;
                case 2:
                    // Second member, give 70% of the 2nd package

                    $wallet->user_id = $tree->parent_id;
                    $wallet->total_balance = $commissionAmount;
                    $wallet->description = 'income from referal comission';


                    break;
                case 3:
                    // Third member, give 75% of the 3rd package

                    // dd($commissionAmount);
                    $wallet->user_id = $tree->senior_id ?? 1;
                    $wallet->total_balance = $commissionAmount;
                    $wallet->description = 'income from referal comission';


                    break;
                case 4:
                case 5:
                    // Fourth or fifth member, give 80% of the 4th package

                    $wallet->user_id = $tree->parent_id;
                    $wallet->total_balance = $commissionAmount;
                    $wallet->description = 'income from referal comission';


                    break;
                case 6:
                    $ccommissionRate = 0;
                    if ($packagePrice == 1000.00) {
                       
                        $ccommissionRate = 0.30;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                        $wallet->description = 'income from new user registration';

                    } elseif ($packagePrice == 3000.00) {
                        dd('31');
                        $ccommissionRate = 0.31;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                        $wallet->description = 'income from new user registration';
                    } elseif ($packagePrice == 5000.00) {
                        dd('fjfkjf');
                        $ccommissionRate = 0.32;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                        $wallet->description = 'income from new user registration';
                    } elseif ($packagePrice == 10000.00) {
                        $ccommissionRate = 0.33;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                        $wallet->description = 'income from new user registration';
                    }

                    break;
                default:
                    // Other cases can be handled as needed
                    break;
            }

            // Update the wallet balance
            $wallet->save();
        }
        $referralCount = Tree::where('parent_id', $referral_id)->count();

        // Check the referral count to determine the level and points
        if ($referralCount >= 15) {
            // Level 2: 15 or more referrals
            $points = 10000;
            // Add points to the user's wallet

        } elseif ($referralCount >= 2) {
            // Level 1: 10 or more referrals
            $points = 5000;
            // Add points to the user's wallet

        } else {
            $points = 0;
        }
        $wallet = Wallet::where('user_id', $tree->parent_id)->first();

        if (!$wallet) {
            // Create a new wallet record if it doesn't exist
            $wallet = new Wallet();
            $wallet->user_id = $tree->parent_id;
        }

        // Update points in the wallet
        $wallet->points_reward += $points;
       
        $wallet->description = 'comision earned from buying package';

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
   
    public function convertpoint()
    {
        return view('convertpoint');
    }
    public function convertAndAddToWallet(Request $request)
    {
        $userId = Auth::user()->id;
        $Wallet = (float) Wallet::where('user_id', $userId)->sum('points_reward');
        // dd($Wallet);

        $points = $Wallet->points_reward;

        // Define the conversion rate
        $conversionRate = 10; // 10 rupees for every 1000 points

        // Define the reserve limit
        $reserveLimit = 10000;

        // Check if points exceed the reserve limit
        if ($points <= $reserveLimit) {
            return redirect()->back()->with('error', 'Points are within the reserve limit, no conversion performed.');
        }
        // dd($points);

        // Calculate the rupees based on the conversion rate for points above the reserve limit
        $convertedPoints = $points - $reserveLimit;
        $rupees = $convertedPoints / 1000 * $conversionRate;
        // Round to 2 decimal places (optional)
        $rupees = round($rupees, 2);

        // Deduct the converted points from the user's wallet only if there are rupees to be added
        if ($rupees > 0) {

            // Deduct the converted points
            $Wallet->points_reward -= $convertedPoints;
            $Wallet->points_reward = max(0, $Wallet->points_reward); // Ensure points don't go negative
            $Wallet->save();
            $userWallet = new Wallet();
            $userWallet->user_id = $userId;
            $userWallet->points_reward = 0;

            // Add the converted rupees to the wallet balance
            $userWallet->total_balance += $rupees;

            // Save the changes to the user's wallet
            $userWallet->save();

            return redirect()->back()->with('success', 'Points converted to rupees and added to the wallet successfully.');
        }

        return redirect()->back()->with('error', 'No rupees added to the wallet.');
    }

    public function showAddPointsForm($userId)
    {
        // Check if the authenticated user is an admin (you need to implement this logic)

        $user = User::find($userId);

        if ($user) {
            return view('admin.addpoints', compact('user'));
        }

        return redirect()->back()->with('error', 'User not found.');

    }
    public function addPoints(Request $request, $userId)
    {
        
            // Validate and process the request to add points to the user
            $request->validate([
                'points' => 'required|integer|min:1',
            ]);

            $user = User::find($userId);

            if ($user) {
                $Wallet = New Wallet();

                // Add points to the user
                $Wallet->user_id = $userId;
                $Wallet->points_reward	 += $request->input('points');
                $wallet->description = 'points earned from bonus by admin';
                dd($wallet->description)

                $Wallet->save();

                return redirect()->route('admin.showAddPointsForm', ['user' => $user->id])->with('success', 'Points added successfully.');
            }

            return redirect()->back()->with('error', 'User not found.');
      
    }

}
