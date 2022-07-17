<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
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
    public function meal()
    {
        $meal_types = DB::table('meal_types')->get();

        return CityResource::collection($meal_types);
        }
    public function property()
    {
        $property_types = DB::table('property_types')->get();

        return CityResource::collection($property_types);
    }
    public function bed()
    {

        $bed_types = DB::table('bed_types')->get();
        return CityResource::collection($bed_types);
    }

    public function facilities()
    {

        $facilities_types = DB::table('facilities')->get();
        return CityResource::collection($facilities_types);
    }
}
