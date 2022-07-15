<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

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
        $cities =City::all();

        return view('property.create',['cities'=>$cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'street' => 'required',
            'building' => 'required',
            'apt' => 'required',
            'description' => 'required',
            'photo'=> 'required'
        ]);
        $property= new Property();
        if ($image = $request->file('photo')) {
            $destinationPath = 'image/';
            $profileImage = date('Y-m-d-H-m-s') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $property->photo = "$profileImage";
        }
        $property->name = $request->get('name');
        $property->city = $request->get('city');
        $property->street = $request->get('street');
        $property->building = $request->get('building');
        $property->apt = $request->get('apt');
        $property->description = $request->get('description');
        $property->owner_id = Auth::user()->id;


        $property->save();
        return redirect()->route('property.index')
            ->with('success', 'updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        $cities =City::all();

        $property = Property::findorfail($id);
        if ($property->owner_id== Auth::user()->id) {
            return view('property.show', ['property' => $property,'cities'=>$cities]);
        }else{
            return redirect()->route('property.index');
        }
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
        if(Property::findorfail($id)->owner_id==Auth::user()->id) {
            if (Property::destroy($id)) {
                Category::where('property_id',$id)->delete();
                return redirect()->route('property.index')->with('success', 'The image has been successfully deleted!');
            } else {
                return redirect()->route('property.index')->with('error', 'Please try again!');
            }
        }    else{ return redirect()->route('property.index')->with('error', 'It is not your!');;

        }
    }
}
