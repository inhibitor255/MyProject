<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // direct User home page
    public function homePage()
    {
        $pizzas = Product::orderBy('updated_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.home', compact('pizzas', 'categories'));
    }

    //direct User profile change page
    public function profileChangePage()
    {
        return view('user.account.profile');
    }

    // direct User account password change page
    public function passwordChangePage()
    {
        return view('user.account.changePassword');
    }

    // direct Pizza detail page
    public function pizzaDetailPage($id)
    {
        $pizza = Product::where('id', $id)->first();
        $pizzas = Product::get();
        return view('user.main.detail', compact('pizza', 'pizzas'));
    }

    // change User profile
    public function profileChange(Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if (request()->hasFile('image')) {
            $dbImage = auth()->user()->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $updatedFileName = uniqid() . "_" . request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('public/', $updatedFileName);
            $data['image'] = $updatedFileName;
        }

        User::where('id', auth()->user()->id)->update($data);
        return redirect()->route('user#profileChangePage')->with('updateSuccess', 'Successfully Update');
    }

    // User password change
    public function passwordChange(Request $request)
    {
        $this->passwordValidationCheck($request);
        if (Hash::check(request()->oldPassword, auth()->user()->password)) {
            $hashNewPassword = Hash::make(request()->newPassword);
            User::where('id', auth()->user()->id)->update(['password' => $hashNewPassword]);
            // After successful password change
            return back()->with('success', 'Password changed successfully.');
        }
        return back()->with(['notMatch' => 'The Old Password did not Match. Try Again.']);
    }

    // filter pizza
    public function filter($id)
    {
        $pizzas = Product::where('category_id', $id)->orderBy('updated_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.home', compact('pizzas', 'categories'));
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

    // User account Validation Check
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
                'image' => 'mimes:png,jpg,jpeg|file',
            ]
        )->validate();
    }

    // User Password Validation Check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
            'newPassword_confirmation' => 'required|min:6',
        ], [])->validate();
    }
}
