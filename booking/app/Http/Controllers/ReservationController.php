<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Auth::user()->reservations;
        return view('reservation.index',['reservations'=> $reservations]);
    }
    public function list()
    {
        $reservations = Reservation::select('reservations.*')->leftJoin('categories','categories.id','=','reservations.category_id')
            ->leftJoin('properties','categories.property_id','=','properties.id')->where('properties.owner_id',Auth::user()->id)
            ->orderBy('status', 'asc')
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
    public function create()
    {
        //
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
