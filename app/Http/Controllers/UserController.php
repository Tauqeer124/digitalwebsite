<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        $users = User::where('isAdmin', 0)->where('status','active')->get();
        return view('user.index', compact('users'));
        
    }
    public function edit(User $user){
        return view('user.edit',compact('user'));
    }
    public function update(Request $request, User $user){
        // dd($request->all());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->referrer_id = $request->referrer_id;
        $user->status = $request->status;
            $user->update();
            // dd($user);
            
            return redirect()->route('user.all')->with('success', 'User status changed successfully.');
        
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('user.all')->with('success', 'User has been deleted.');

    }
    public function block(){
        $users = User::where('isAdmin', 0)->where('status','block')->get();
        return view('user.block', compact('users'));
    }
    public function review(){
        $users = User::where('isAdmin', 0)->where('status','review')->get();
        return view('user.review', compact('users'));
    }
    public function updateStatus(Request $request, User $user)
    {
        $newStatus = $request->input('status');

        // Validate the input
        $request->validate([
            'status' => 'required|in:active,block,review',
        ]);

        // Update the user status
        $user->status = $newStatus;
        $user->save();

        return response()->json(['success' => true]);
    }  
}
