<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct Admin password change page
    public function passwordChangePage()
    {
        return view('admin.account.changePassword');
    }

    // Admin password change
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

    // direct Admin account detail page
    public function detailPage()
    {
        return view('admin.account.detail');
    }

    // direct Admin account edit page
    public function editPage()
    {
        return view('admin.account.edit');
    }

    // Admin account update
    public function update(Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if ($request->hasFile('image')) {
            $dbImage = auth()->user()->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }


        User::where('id', auth()->user()->id)->update($data);
        return redirect()->route('admin#detailPage')->with('updateSuccess', 'Successfully Update');
    }

    // request user data
    private function getUserData($request)
    {
        return [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'address' => $request['address'],
        ];
    }

    // Admin account Validation Check
    private function accountValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]
        )->validate();
    }

    // Admin Password Validation Check
    private function passwordValidationCheck($request)
    {

        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
            'newPassword_confirmation' => 'required|min:6',
        ], [])->validate();
    }
}
