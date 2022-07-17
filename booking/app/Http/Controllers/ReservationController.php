<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DatePeriod;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Auth::user()->reservations->sortBy('status')->sortByDesc('check_in');
        return view('reservation.index',['reservations'=> $reservations]);
    }
    public function list()
    {
        $reservations = Reservation::select('reservations.*')->leftJoin('categories','categories.id','=','reservations.category_id')
            ->leftJoin('properties','categories.property_id','=','properties.id')->where('properties.owner_id',Auth::user()->id)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('reservation.list',['reservations'=> $reservations]);
    }
    public function confirm($id)
    {
        $reservation = Reservation::findorfail($id);

        if ($reservation->category->property->owner_id == Auth::user()->id) {

            $reservation->status='2';
            $reservation->save();
        }
        return redirect()->route('reservations.list');
    }
    public function end($id)
    {
        $reservation = Reservation::findorfail($id);

        if ($reservation->category->property->owner_id == Auth::user()->id) {

            $reservation->status='3';
            $reservation->save();
        }
        return redirect()->route('reservations.list');
    }
    public function cancel_owner($id)
    {
        $reservation = Reservation::findorfail($id);

        if ($reservation->category->property->owner_id == Auth::user()->id) {

            $reservation->status='6';
            $reservation->save();
        }
        return redirect()->route('reservations.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $date_in, $date_out, $person)
    {
        $diff = Carbon::parse($date_in)->diffInDays(Carbon::parse($date_out));
        $category=Category::findorfail($id);
        $reservation= new Reservation();

        $reservation->user_id = Auth::user()->id;
        $reservation->category_id = $id;
        $reservation->check_in = $date_in;
        $reservation->check_out = $date_out;
        $reservation->amount = $category->price_per_night*$diff;
        $reservation->status ='1';
        $reservation->person = $person;
        $reservation->save();

        $period = new DatePeriod( Carbon::parse($date_in), CarbonInterval::days(),  Carbon::parse($date_out));

        foreach ($period as $day){
            $free=DB::table('desk_of_days')->select('free_room')
                ->where('day',$day)
                ->where('category_id',$id)->first();
            $val=$free->free_room-1;
            $free1=DB::table('desk_of_days')
                ->where('day',$day)
                ->where('category_id',$id)->update(['free_room'=>$val]);
        }
        return redirect()->route('reservations')
            ->with('success', 'updated successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findorfail($id);
        if ($reservation->user_id == Auth::user()->id) {
            return view('reservation.show', ['reservation' => $reservation]);
        }else{
            return redirect()->route('reservations');
        }
    }
    public function cancel($id)
    {
        $reservation = Reservation::findorfail($id);

        if ($reservation->user_id == Auth::user()->id) {

            $reservation->status='6';
            $reservation->save();
        }
            return redirect()->route('reservations');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
