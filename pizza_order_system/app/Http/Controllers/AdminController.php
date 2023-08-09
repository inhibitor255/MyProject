<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct password change page
    public function passwordChangePage()
    {
        return view('admin.account.changePassword');
    }

    // password change
    public   function passwordChange(Request $request)
    {
        $this->passwordValidationCheck($request);
        $dbPassword = auth()->user()->password;
        if (Hash::check(request('oldPassword'), $dbPassword)) {
            User::where('id', auth()->user()->id)->update(['password' => Hash::make(request()->newPassword),]);
            // After successful password change
            return back()->with('success', 'Password changed successfully.');
        }
        return back()->with(['notMatch' => 'The Old Password did not Match. Try Again.']);
    }

    // direct account detail
    public function detail()
    {
        return view('admin.account.detail');
    }

    // Password Validation Check
    private function passwordValidationCheck($request)
    {

        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
            'newPassword_confirmation' => 'required|min:6',
        ], [])->validate();
    }
}
