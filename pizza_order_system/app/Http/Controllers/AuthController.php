<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // direct login page
    public function loginPage()
    {
        return view('login');
    }

    // direct register page
    public function registerPage()
    {
        return view('register');
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
}
