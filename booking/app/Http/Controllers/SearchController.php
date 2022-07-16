<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Property;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SearchResource;

class SearchController extends Controller
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
    public function index(Request $request)
    {

        $validatedData = $request->validate([
            'city' => 'required',
            'date_in' => 'required',
            'date_out' => 'required',
            'person' => 'required',

        ]);
        $data=['city' => City::findorfail($request->city)->name,
            'city_id' => $request->city,
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
            'person' => $request->person];

       /* //$startDate = Carbon::parse($request->date_in);
        $diff =  Carbon::parse($request->date_in)->diffInDays( Carbon::parse($request->date_out));
        $free=DB::table('desk_of_days')
            ->select(DB::raw('count(*) as count_free_day, category_id'))
            ->where('free_room','>','0')
            ->whereBetween('day',[ Carbon::parse($request->date_in), Carbon::parse($request->date_out)->subDays(1)])
            ->groupBy('category_id')
        ->get();
        foreach ($free as $val){
            if($val->count_free_day>=$diff){
                print_r($val);

            }
        }*/
        return view('search.index',['res' => $data]);

    }
    public function filter(Request $request)
    {

        $validatedData = $request->validate([
            'city' => 'required',
            'date_in' => 'required',
            'date_out' => 'required',
            'person' => 'required',

        ]);
        //$startDate = Carbon::parse($request->date_in);
        $diff =  Carbon::parse($request->date_in)->diffInDays( Carbon::parse($request->date_out));
        $free=DB::table('desk_of_days')
            ->select(DB::raw('count(*) as count_free_day, category_id'))
            ->leftJoin('categories','categories.id','desk_of_days.category_id')

            ->leftJoin('properties','properties.id','categories.property_id')
            ->where('free_room','>','0')

            ->where('properties.city',$request->city)
            ->whereBetween('day',[ Carbon::parse($request->date_in), Carbon::parse($request->date_out)->subDays(1)])
            ->groupBy('category_id')
            ->get();
        $categories_arr=[];
        foreach ($free as $val){
            if($val->count_free_day>=$diff){
                $categories_arr[]=$val->category_id;

            }
        }
        $res=Property::select('properties.*','categories.price_per_night','categories.property_id','categories.stars')
            ->crossJoin('categories','categories.property_id','properties.id')->groupBy('categories.property_id')
            ->havingRaw('MIN(categories.price_per_night)')
            ->whereIn('categories.id',$categories_arr)
            ->get();
       /* foreach ($res as $value){
            print_r($value->property_id.'  ');
        }*/


        $data=[];
        //return view('search.index',['res' => $data]);

        return SearchResource::collection($res);
    }
}
