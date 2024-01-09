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
        $payment->transcation_id =  $request->transcation_id;
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



                    break;
                case 2:
                    // Second member, give 70% of the 2nd package

                    $wallet->user_id = $tree->parent_id;
                    $wallet->total_balance = $commissionAmount;

                    break;
                case 3:
                    // Third member, give 75% of the 3rd package

                    // dd($commissionAmount);
                    $wallet->user_id = $tree->senior_id ?? 1;
                    $wallet->total_balance = $commissionAmount;


                    break;
                case 4:
                case 5:
                    // Fourth or fifth member, give 80% of the 4th package

                    $wallet->user_id = $tree->parent_id;
                    $wallet->total_balance = $commissionAmount;


                    break;
                case 6:
                    $ccommissionRate = 0;
                    if ($packagePrice == 1000.00) {
                        dd('30');
                        $ccommissionRate = 0.30;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                    } elseif ($packagePrice == 3000.00) {
                        dd('31');
                        $ccommissionRate = 0.31;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                    } elseif ($packagePrice == 5000.00) {
                        dd('fjfkjf');
                        $ccommissionRate = 0.32;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
                    } elseif ($packagePrice == 10000.00) {
                        $ccommissionRate = 0.33;
                        $ccommissionAmount = $packagePrice * $ccommissionRate;
                        $wallet->user_id = 1;
                        $wallet->total_balance = $ccommissionAmount;
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

        }
        else{
            $points = 0;
        }
        $wallet = Wallet::where('user_id', $tree->parent_id)->first();

        if (!$wallet) {
            // Create a new wallet record if it doesn't exist
            $wallet = new Wallet();
            $wallet->user_id = $tree->parent_id;
        }

        // Update points in the wallet
        $wallet->points_reward+= $points;
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
    function addPointsToWallet($userId, $points)
    {
        $wallet = Wallet::where('user_id', $userId)->first();

        if (!$wallet) {
            // Create a new wallet record if it doesn't exist
            $wallet = new Wallet();
            $wallet->user_id = $userId;
        }

        // Update points in the wallet
        $wallet->points += $points;
        $wallet->save();
    }

    public function convertAndAddToWallet(Request $request)
    {
        // Validate the request, make sure to include any other required validations
        $request->validate([
            'points' => 'required|integer|min:0',
        ]);

        $userId = Auth::user()->id;
        $points = $request->input('points');

        // Define the conversion rate
        $conversionRate = 10; // 10 rupees for every 1000 points

        // Define the reserve limit
        $reserveLimit = 10000;

        // Check if points exceed the reserve limit
        if ($points <= $reserveLimit) {
            return redirect()->route('your.route.name')->with('error', 'Points are within the reserve limit, no conversion performed.');
        }

        // Calculate the rupees based on the conversion rate for points above the reserve limit
        $rupees = ($points - $reserveLimit) / 1000 * $conversionRate;

        // Round to 2 decimal places (optional)
        $rupees = round($rupees, 2);

        // Update the user's wallet balance only if there are rupees to be added
        if ($rupees > 0) {
            // Update the user's wallet balance
            $userWallet = Wallet::where('user_id', $userId)->first();

            if (!$userWallet) {
                // Create a new wallet record if it doesn't exist
                $userWallet = new Wallet();
                $userWallet->user_id = $userId;
            }

            // Add the converted rupees to the wallet balance
            $userWallet->Total_balance += $rupees;
            $userWallet->save();

            return redirect()->route('your.route.name')->with('success', 'Points converted to rupees and added to the wallet successfully.');
        }

        return redirect()->route('your.route.name')->with('error', 'No rupees added to the wallet.');
    }
}
Create a Route:
In your web.php routes file, define a route that corresponds to the convertAndAddToWallet function in your controller.

php
Copy code
// routes/web.php

use App\Http\Controllers\YourController; // Update namespace as per your application

Route::post('/convert-and-add-to-wallet', [YourController::class, 'convertAndAddToWallet'])->name('your.route.name');
Show Error/Success Messages in Your View:
Assuming you have a Blade view, you can show the messages there.

html
Copy code
<!-- resources/views/your-view.blade.php -->

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Your other view content goes here -->
Replace 'your.route.name' with the actual name you give to your route. Make sure to adjust namespaces, model names, and other details based on your actual application structure.


User
i want to make a button on which user click the points automaticaly chanes and show error or success message
ChatGPT
To create a button that triggers the points conversion and displays success or error messages when clicked, you can use a combination of Laravel, JavaScript, and your Blade views. Here's a simple example using Laravel Livewire for the real-time interaction:

Install Livewire:
Run the following command in your terminal to install Laravel Livewire:

bash
Copy code
composer require livewire/livewire
Create a Livewire Component:
Create a Livewire component to handle the points conversion logic.

bash
Copy code
php artisan make:livewire ConvertPoints
Edit the generated ConvertPoints.php file:

php
Copy code
// app/Http/Livewire/ConvertPoints.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class ConvertPoints extends Component
{
    public function convertAndAddToWallet()
    {
        $userId = Auth::user()->id;
        $points = // Get the user's points from your database or any other source;

        // Your existing conversion logic here...
        // ...

        // Example: Simulate a success message
        $this->emit('conversionSuccess', 'Points converted to rupees and added to the wallet successfully.');
    }

    public function render()
    {
        return view('livewire.convert-points');
    }
}
Edit the Blade View for the Livewire Component:
Create a new Blade view file for the Livewire component.

bash
Copy code
mkdir resources/views/livewire
touch resources/views/livewire/convert-points.blade.php
Edit the convert-points.blade.php file:

html
Copy code
<!-- resources/views/livewire/convert-points.blade.php -->

<div>
    <button wire:click="convertAndAddToWallet">Convert Points</button>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
Wire Up the Livewire Component in Your Blade View:
Include the Livewire component in the view where you want to display the button.

html
Copy code
<!-- resources/views/your-view.blade.php -->

@livewire('convert-points')
@livewireScripts
Load Livewire Scripts:
Make sure to include Livewire scripts at the end of your Blade layout or view:

html
Copy code
<!-- resources/views/layouts/app.blade.php or your specific layout file -->

@livewireScripts
Run Your Application:
Run your Laravel development server:

bash
Copy code
php artisan serve
Visit your application in the browser, navigate to the page containing the Livewire component, and you should see the "Convert Points" button. When you click the button, the Livewire component will trigger the conversion logic, and the success or error messages will be displayed dynamically without refreshing the entire page.

This example assumes you already have a mechanism to retrieve the user's points from the database. Adjust the logic based on your specific requirements.

User
without livewire 
by using larael
ChatGPT
Certainly, you can achieve this without using Livewire by using Laravel and JavaScript. You'll need to set up an endpoint to handle the conversion logic and then use JavaScript to make an AJAX request when the button is clicked. Here's a simplified example:

Create a Controller Method:
Create a new method in your controller to handle the points conversion.

php
Copy code
// YourController.php

use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;

class YourController extends Controller
{
    public function convertAndAddToWallet()
    {
        $userId = Auth::user()->id;
        $points = // Get the user's points from your database or any other source;

        // Your existing conversion logic here...
        // ...

        // Example: Simulate a success message
        return response()->json(['message' => 'Points converted to rupees and added to the wallet successfully']);
    }

    // Other methods in your controller...
}
Define a Route:
Define a route that maps to your new controller method.

php
Copy code
// routes/web.php

use App\Http\Controllers\YourController;

Route::post('/convert-and-add-to-wallet', [YourController::class, 'convertAndAddToWallet'])->name('convertAndAddToWallet');
Create a JavaScript File:
Create a JavaScript file that will handle the AJAX request and update the UI.

javascript
Copy code
// resources/js/convertPoints.js

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('convertPointsButton').addEventListener('click', function () {
        axios.post('/convert-and-add-to-wallet')
            .then(function (response) {
                alert(response.data.message); // Display success message (you can use a modal or other UI element)
                // Optionally, update the UI or perform additional actions
            })
            .catch(function (error) {
                alert('Error converting points'); // Display error message
                console.error(error);
            });
    });
});
Include the JavaScript File:
Include the JavaScript file in your Blade view.

html
Copy code
<!-- resources/views/layouts/app.blade.php or your specific layout file -->

<script src="{{ asset('js/convertPoints.js') }}"></script>
Create the Button in Your View:
Add the button to your Blade view.

html
Copy code
<!-- resources/views/your-view.blade.php -->

<button id="convertPointsButton">Convert Points</button>
Compile Assets:
If you're not using Laravel Mix, make sure to compile your JavaScript assets.

bash
Copy code
npm run dev
If you're using Laravel Mix, this step might not be necessary.

Run Your Application:
Run your Laravel development server:

bash
Copy code
php artisan serve
Visit your application in the browser, navigate to the page containing the button, and when you click the "Convert Points" button, it should trigger the AJAX request to the Laravel endpoint, and you'll see success or error messages.

This example uses Axios for the AJAX request. Make sure to include Axios in your project if you haven't already:

bash
Copy code
npm install axios
This is a simplified example, and you might want to enhance it based on your specific needs and requirements.

User
but i am using laravel 9
ChatGPT
Sure, if you're using Laravel 9, the general approach remains the same, but Laravel 9 introduced a new JavaScript stack called "Jetstream" which includes Alpine.js by default. You can use Alpine.js to handle the JavaScript interactions more seamlessly. Here's an updated example:

Create a Controller Method:
Create a new method in your controller to handle the points conversion.

php
Copy code
// YourController.php

use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;

class YourController extends Controller
{
    public function convertAndAddToWallet()
    {
        $userId = Auth::user()->id;
        $points = // Get the user's points from your database or any other source;

        // Your existing conversion logic here...
        // ...

        // Example: Simulate a success message
        return response()->json(['message' => 'Points converted to rupees and added to the wallet successfully']);
    }

    // Other methods in your controller...
}
}
