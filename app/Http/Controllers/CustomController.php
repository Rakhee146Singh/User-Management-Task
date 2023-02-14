<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            return redirect()->intended('dashboard')->withSuccess('Login Successfully');
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
            'profile_image' => 'required'
        ]);
        if ($request->hasFile('profile_image')) {
            $imageName = str_replace(".", "", (string)microtime(true)) . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->storeAs("public/profiles", $imageName);
        }

        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_image' => $imageName,
            'roles' => 'employee'
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

    public function forget()
    {
        return view('auth.forget-password');
    }

    public function forgetPassword(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        $token = Str::random(40);
        $domain = URL::to('/');
        $url = $domain . '/reset-password?token=' . $token;
        if ($user) {

            $data['url'] = $url;
            $data['email'] = $user->email;
            $data['title'] = 'Password Reset';
            $data['body'] = 'Please click on below link to reset password ';

            PasswordReset::create([
                'email' => $user->email,
                'token' => $token
            ]);

            Mail::to($user->email)->send(new ForgetPasswordMail($data));

            return back()->with('success', 'Please check your mail to reset your password');
        } else {
            return back()->with('error', 'Email Not Exists!');
        }
    }

    public function reset(Request $request)
    {
        $pwd = PasswordReset::where('token', $request->token)->first();

        if ($pwd) {
            $user = User::where('email', $pwd->email)->first();
            $pwd->delete();
            return view('auth.resetPassword', ['data' => $user]);
        } else {
            return view('404');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::findOrFail($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        User::where('email', $user->email)->delete();
        return "Your Password has been Reset Successfully.";
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password changed successfully!");
    }
}
