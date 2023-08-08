<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // direct login page
    public function loginPage()
    {
        return view('auth.login');
    }

    // direct register page
    public function registerPage()
    {
        return view('auth.register');
    }

    // direct dashboard page
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('category#list');
        } else {
            return redirect()->route("user#home");
        }
    }

    // direct password change page
    public function passwordChangePage()
    {
        return view('admin.password.changePassword');
    }

    // password change
    public   function passwordChange(Request $request)
    {
        $this->passwordValidationCheck($request);
        $dbPassword = auth()->user()->password;
        if (Hash::check(request('oldPassword'), $dbPassword)) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make(request()->newPassword),
            ]);
            // After successful password change
            return redirect()->route('auth#loginPage')->with('success', 'Password changed successfully. Please login with new Password.');
        }
        return back()->with(['notMatch' => 'The Old Password did not Match. Try Again.']);
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
