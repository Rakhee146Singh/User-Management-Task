<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::findOrFail(Auth::user()->id);
        return view('profile', compact('data'));
    }

    public function edit_validation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_image' => 'required'
        ]);
        $imageName = str_replace(".", "", (string)microtime(true)) . '.' . $request->profile_image->getClientOriginalExtension();
        $request->profile_image->storeAs("public/profiles", $imageName);

        $data = $request->all();
        $form_data = array(
            'profile_image' => $imageName,
            'name' => $data['name'],
            'email' => $data['email'],
        );
        User::whereId(Auth::user()->id)->update($form_data);
        return redirect('profile')->with('success', 'Profile Data Updated');
    }
}
