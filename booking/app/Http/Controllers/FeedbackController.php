<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Feedback;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $feedback = Feedback::select('feedback.*')
            ->leftJoin('reservations', 'reservations.id', '=', 'feedback.reservation_id')
            ->where('reservations.user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('feedback.index', ['feedback' => $feedback]);

    }

    public function create($id)
    {

        return view('feedback.create', ['id' => $id]);

    }

    public
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'reservation_id' => 'required',
        ]);
        $reservation=Reservation::findorfail($request->get('reservation_id'));
        if ($reservation->user->id == Auth::user()->id) {
            $feedback = new Feedback();

            $feedback->reservation_id = $request->get('reservation_id');
            $feedback->name = $request->get('name');
            $feedback->grade = $request->get('grade');
            $feedback->description = $request->get('description');

            $feedback->save();
        }
        //$property=Property::findoffail($reservation->category->property->id);

        $grade=DB::table('feedback')
            ->leftJoin('reservations', 'reservations.id', '=', 'feedback.reservation_id')
            ->leftJoin('categories', 'reservations.category_id', '=', 'categories.id')
            ->where('property_id', $reservation->category->property->id)
            ->avg('grade');
        $property=$reservation->category->property;
        $property->grade=$grade;
        $property->save();



        return redirect()->route('feedback');

    }
    public function property($id)
    {
        $feedback=Feedback::select('feedback.*')->
            leftJoin('reservations', 'reservations.id', '=', 'feedback.reservation_id')
            ->leftJoin('categories', 'reservations.category_id', '=', 'categories.id')
            ->where('property_id',$id)
            ->get();
        return view('feedback.index', ['feedback' => $feedback]);

    }
}
