<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function validate_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Login');
        }
        return redirect('login')->with('success', 'Login details are not valid.');
    }

    public function register()
    {
        return view('auth.registration');
    }

    public function validate_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // 'profile_image' => 'required'
        ]);
        // if ($request->hasFile('profile_image')) {
        //     $imageName = str_replace(".", "", (string)microtime(true)) . '.' . $request->profile_image->getClientOriginalExtension();
        //     $request->profile_image->storeAs("public/profiles", $imageName);
        // }

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => 'admin'
            // 'profile_image' => $imageName
        ]);

        return redirect('login')->with('success', 'Registration Completed. Now you can login successfully.');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect('login')->with('success', 'You are not allowed to access');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login')->with('success', 'You are successfully logout');
    }
}
