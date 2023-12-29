<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'))->with('success', 'You have logged in');
        }

        return redirect(route('login-form'))->with('error', 'Opps! You have entered invalid credentials');
    }
    public function register_form()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required
            'password' => 'required|min:8',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        $user->save();
        if ($user) {
            return redirect()->route('login-form')->with('success', 'Your have registered  Successfullly');
        } else {
            // dd("wrong");
            return redirect()->back()->with('success', 'something went wrong please try again');
        }
    }
    public function user_logout()
    {

        Auth::logout();
        return redirect()->route('login-form');
    }

    public function account()
    {
        $d['my'] = Auth::user();
        return view('auth.myprofile', $d);
    }
    public function change_pass(Request $request)
    {
        //  dd("update");
        // dd($request->all());

        $user = Auth::user();
        // dd($user);

        // Check if the entered current password matches the user's current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with(['error' => 'The current password is incorrect.']);
        }
        if ($request->input('current_password') === $request->input('password')) {
            return redirect()->back()->with(['error' => 'The current password and new password cannot be the same.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('home')->with('success', 'Password updated successfully.');
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            
            // Add more fields as needed
        ]);

        // Update the user's profile information
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
            // Update more fields as needed
        ]);

        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }
}
