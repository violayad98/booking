<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = Auth::user()->property;
        return view('property.index',['property'=> $property]);
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
        $property = Property::findorfail($id);
        return view('property.show',['property'=> $property]);
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
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'street' => 'required',
            'building' => 'required',
            'apt' => 'required',
            'description' => 'required',
        ]);
        $property = Property::findorfail($id);
        if ($image = $request->file('photo')) {
            $destinationPath = 'image/';
            $profileImage = "property_photo_$property->id" . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $property->photo = "$profileImage";
        }


        $property->name = $request->get('name');
        $property->city = $request->get('city');
        $property->street = $request->get('street');
        $property->building = $request->get('building');
        $property->apt = $request->get('apt');
        $property->description = $request->get('description');
        $property->save();

        return redirect()->route('property.index')
            ->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "111";
    }
}
