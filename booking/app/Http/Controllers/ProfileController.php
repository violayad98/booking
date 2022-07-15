<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile');
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'country' => 'required',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->country = $request->country;
        if ($image = $request->file('photo')) {
            $destinationPath = 'image/';
            $profileImage = "profile_photo_$user->id" . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $user->photo = "$profileImage";
        }

        $user->save();
        return redirect('/profile');
    }
}
