<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{

    public function editProfile()
    {
        return view('AdminDashboard.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The old password is incorrect.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        toastr()->success(__('Password changed successfully.'));
        return redirect()->route('admin.password.edit');
    }
}