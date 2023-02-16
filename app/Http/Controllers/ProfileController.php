<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        // $user = User::all();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_image' => 'required'
        ]);
        $imageName = str_replace(".", "", (string)microtime(true)) . '.' . $request->profile_image->getClientOriginalExtension();
        $request->profile_image->storeAs("public/profiles", $imageName);

        $data = $request->all();
        // if ($request->hasFile('profile_image')) {
        //     Storage::delete($user->profile_image);
        //     $request->profile_image->storeAs("public/profiles", $imageName);
        // }
        $form_data = array(
            'profile_image' => $imageName,
            'name' => $data['name'],
            'email' => $data['email'],
        );
        User::whereId(Auth::user()->id)->update($form_data);
        return redirect('profile')->with('success', 'Profile Data Updated');
    }

    // public function destroy()
    // {
    //     $data = User::all();
    //     Storage::delete($data->profile_image);
    //     $data->delete();
    // }
}
