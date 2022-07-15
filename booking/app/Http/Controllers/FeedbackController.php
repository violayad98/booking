<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
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

        $feedback =Feedback::select('feedback.*')->leftJoin('reservations','reservations.id','=','feedback.reservation_id')->where('reservations.user_id',Auth::user()->id)->get();
        return view('feedback.index',['feedback'=> $feedback]);

    }
}
