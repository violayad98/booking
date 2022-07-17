<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Feedback;
use App\Models\Property;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $data = ['city' => City::findorfail($request->city)->name,
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
        return view('search.index', ['res' => $data]);

    }

    public function filter(Request $request)
    {

        $validatedData = $request->validate([
            'city' => 'required',
            'date_in' => 'required',
            'date_out' => 'required',
            'person' => 'required',

        ]);
        $filter = $request->filter;
        //$startDate = Carbon::parse($request->date_in);
        $diff = Carbon::parse($request->date_in)->diffInDays(Carbon::parse($request->date_out));
        $free = DB::table('desk_of_days')
            ->select(DB::raw('count(*) as count_free_day, category_id'))
            ->leftJoin('categories', 'categories.id', 'desk_of_days.category_id')
            ->leftJoin('properties', 'properties.id', 'categories.property_id')
            ->where('free_room', '>', '0')
            ->where('properties.city', $request->city)
            ->whereBetween('day', [Carbon::parse($request->date_in), Carbon::parse($request->date_out)->subDays(1)])
            ->groupBy('category_id')
            ->get();
        $categories_arr = [];
        foreach ($free as $val) {
            if ($val->count_free_day >= $diff) {
                $categories_arr[] = $val->category_id;

            }
        }
        //print_r($filter);
        $res = Property::select('properties.*', 'categories.price_per_night', 'categories.property_id', 'categories.stars')
            ->crossJoin('categories', 'categories.property_id', 'properties.id')->groupBy('categories.property_id')
            ->havingRaw('MIN(categories.price_per_night)')
            ->where('categories.person_max', '>=', $request->person)
            ->whereIn('categories.id', $categories_arr)
            ->when(count($filter['property_type']), static function ($q) use ($filter) {
                return $q->whereIn('categories.property_type', $filter['property_type']);
            })
            ->when(count($filter['meal_type']), static function ($q) use ($filter) {
                return $q->whereIn('categories.meal_type', $filter['meal_type']);
            })
            ->when(count($filter['bed_type']), static function ($q) use ($filter) {
                return $q->whereIn('categories.bed_type', $filter['bed_type']);
            })
            ->when(count($filter['stars']), static function ($q) use ($filter) {
                return $q->whereIn('categories.stars', $filter['stars']);
            })
            ->when($filter['grade'] != '', static function ($q) use ($filter) {
                return $q->where('stars', '>', $filter['grade']);
            })
            ->when($filter['sort'] != '', static function ($q) use ($filter) {
                if ($filter['sort'] == '1') {
                    return $q->orderBy('price_per_night', 'ASC');

                } elseif ($filter['sort'] == '2') {
                    return $q->orderBy('price_per_night', 'DESC');
                } elseif ($filter['sort'] == '3') {
                    return $q->orderBy('stars', 'DESC');
                } elseif ($filter['sort'] == '4') {
                    return $q->orderBy('grade', 'DESC');
                }
            })
            ->get();
        /* foreach ($res as $value){
             print_r($value->property_id.'  ');
         }*/


        $data = [];
        //return view('search.index',['res' => $data]);

        return SearchResource::collection($res);
    }

    public function show($id, $date_in, $date_out, $person)
    {
        $diff = Carbon::parse($date_in)->diffInDays(Carbon::parse($date_out));
        $request = ['date_in' => $date_in,
            'date_out' => $date_out,
            'person' => $person,
            'diff'=>$diff
        ];
        $property = Property::findorfail($id);
        $category = $property->categories;


        $categories_arr = [];
        foreach ($category as $val) {
            $categories_arr[$val->id] = $val->id;
        }
        $free = DB::table('desk_of_days')
            ->select(DB::raw('count(*) as count_free_day, category_id'))
            ->leftJoin('categories', 'categories.id', 'desk_of_days.category_id')
            ->where('categories.person_max', '>=', $person)
            ->where('free_room', '>', '0')
            ->whereIn('category_id', $categories_arr)
            ->whereBetween('day', [Carbon::parse($date_in), Carbon::parse($date_out)->subDays(1)])
            ->groupBy('category_id')
            ->get();
        unset ($categories_arr);
        $categories_arr = [];
        foreach ($free as $cat) {
            if ($cat->count_free_day == $diff) {
                $categories_arr[] = $cat->category_id;
            }
        }
        $categories = Category::whereIn('id', $categories_arr)->get();
        $feedback = Feedback::select('feedback.*')->
        leftJoin('reservations', 'reservations.id', '=', 'feedback.reservation_id')
            ->leftJoin('categories', 'reservations.category_id', '=', 'categories.id')
            ->where('property_id', $id)
            ->get();
        return view('search.show', ['property' => $property, 'categories' => $categories, 'feedback' => $feedback, 'request' =>$request]);

    }
}
