<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Admin_Login_Form()
    {
        return view('auth.admin.login');
    }
    public function Admin_Login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Check if the user is an admin (assuming there is an 'isAdmin' column in your users table)
        if ($user->isAdmin == 1) {
            return redirect()->intended(route('home'))->with('success', 'You have logged in as an admin');
        } else {
            Auth::logout(); // Log out the user if not an admin
            return redirect(route('admin.login-form'))->with('error', 'You are not authorized to access the admin panel');
        }
    }

    return redirect(route('admin.login-form'))->with('error', 'Oops! You have entered invalid credentials');
}

    public function Admin_Register_Form()
    {
        return view('auth.admin.register');
    }
    public function Admin_register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->isAdmin = 1;
        $user->password = Hash::make($request->password);

        $user->save();
        if ($user) {
            return redirect()->route('admin.login-form')->with('success', 'Your have registered  Successfullly');
        } else {
            // dd("wrong");
            return redirect()->back()->with('success', 'something went wrong please try again');
        }
    }
    

}
