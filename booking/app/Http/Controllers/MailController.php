<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\EmailConfirm;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function send()
    {
        $user = Auth::user();

        Mail::to($user->email)->send(new EmailConfirm($user));
        return redirect('/profile');
    }
    public function confirm($id)
    {
        $user= User::findorfail($id);
        $user->email_verified_at = Carbon::now()->timestamp;
        $user->save();
        return redirect('/');
       // Mail::to("viola.yad@gmail.com")->send(new EmailConfirm($user));
    }
}
