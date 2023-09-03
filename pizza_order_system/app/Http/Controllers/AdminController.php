<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct admin list page
    public function listPage(Request $request)
    {
        // for admins
        $admins = User::when(request('searchData'), function ($key) {
            $key->where('role', 'admin')
                ->where(function ($query) {
                    $query->orWhere('name', 'like', '%' . request('searchData') . '%')
                        ->orWhere('email', 'like', '%' . request('searchData') . '%')
                        ->orWhere('phone', 'like', '%' . request('searchData') . '%')
                        ->orWhere('gender', 'like', '%' . request('searchData') . '%')
                        ->orWhere('address', 'like', '%' . request('searchData') . '%');
                });
        })
            ->where('role', 'admin')
            ->paginate(3);
        $admins->appends($request->all());
        return view('admin.account.list', compact('admins'));
    }

    // direct to user list page
    public function userListPage(Request $request)
    {
        // for customers
        $users = User::when(request('searchData'), function ($key) {
            $key->where('role', 'user')
                ->where(function ($query) {
                    $query->orWhere('name', 'like', '%' . request('searchData') . '%')
                        ->orWhere('email', 'like', '%' . request('searchData') . '%')
                        ->orWhere('phone', 'like', '%' . request('searchData') . '%')
                        ->orWhere('gender', 'like', '%' . request('searchData') . '%')
                        ->orWhere('address', 'like', '%' . request('searchData') . '%');
                });
        })
            ->where('role', 'user')
            ->paginate(3);
        $users->appends($request->all());
        return view('admin.user.list', compact('users'));
    }

    // direct Admin account change role page
    public function changeRolePage($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }


    // direct Admin password change page
    public function passwordChangePage()
    {
        return view('admin.account.changePassword');
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
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }


        User::where('id', auth()->user()->id)->update($data);
        return redirect()->route('admin#detailPage')->with('updateSuccess', 'Successfully Update');
    }

    // Admin password change
    public function passwordChange(Request $request)
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

    // change role of other admin account
    public function changeRole(Request $request, $id)
    {
        $data = ['role' => request()->role];
        User::where('id', $id)->update($data);
        return redirect()->route('admin#listPage')->with('updateMessage', 'Role was successfully changed.');
    }

    // delete user account from entire Pos
    public function delete($id)
    {

        Cart::where('user_id', $id)->delete();
        Order::where('user_id', $id)->delete();
        OrderList::where('user_id', $id)->delete();
        Rating::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back()->with('deleteMessage', 'Successfully deleted.');
    }

    // edit user acc page from admin
    public function userEditPage($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user'));
    }

    // edit user acc from admin
    public function userEdit(Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if ($request->hasFile('image')) {
            $dbImage = request()->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }


        User::where('id', request()->id)->update($data);
        return redirect()->route('admin#userListPage');
    }

    public function ajaxChangeRole(Request $request)
    {
        User::where('id', $request->id)->update([
            'role' => $request->role
        ]);
        return response()->json(['success change role'], 200);
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
                'image' => 'mimes:png,jpg,jpeg|file',
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
