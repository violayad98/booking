<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {
        $category = Category::select('categories.*')->leftjoin('properties', 'properties.id', '=', 'categories.property_id')->where('property_id', $property_id)->where('owner_id', Auth::user()->id)->get();
        foreach ($category as $cat) {
            $cat->photo = $cat->get_photo();
        }

        return view('category.index', ['category' => $category, 'property_id' => $property_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create($property_id)
    {
        $property_types = DB::table('property_types')->get();
        $meal_types = DB::table('meal_types')->get();
        $bed_types = DB::table('bed_types')->get();

        return view('category.create', ['property_id' => $property_id, 'property_types' => $property_types, 'meal_types' => $meal_types, 'bed_types' => $bed_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'property_id' => 'required',
                'room_count' => 'required',
                'count' => 'required',
                'person_max' => 'required',
                'size' => 'required',
                'price_per_night' => 'required',
                'property_type' => 'required',
                'bed_type' => 'required',
                'meal_type' => 'required',
                'stars' => 'required',
                'description' => 'required',
                'photo' => 'required'
            ]);
            $category = new Category();

            $category->name = $request->get('name');
            $category->property_id = $request->get('property_id');
            $category->room_count = $request->get('room_count');
            $category->count = $request->get('count');
            $category->person_max = $request->get('person_max');
            $category->size = $request->get('size');
            $category->price_per_night = $request->get('price_per_night');
            $category->property_type = $request->get('property_type');
            $category->bed_type = $request->get('bed_type');
            $category->meal_type = $request->get('meal_type');
            $category->stars = $request->get('stars');
            $category->description = $request->get('description');

            $category->save();

            /* if ($image = $request->file('photo')) {
                 $destinationPath = 'image/';
                 $profileImage = date('Y-m-d-H-m-s') . "." . $image->getClientOriginalExtension();
                 $image->move($destinationPath, $profileImage);
                 $property->photo = "$profileImage";
             }*/
            if ($request->hasfile('photo')) {
                foreach ($request->file('photo') as $file) {
                    $destinationPath = 'image/';
                    $Image = date('Y-m-d-H-m-s') . rand() . "." . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $Image);
                    DB::table('photo_to_category')->insert([
                        'category_id' => $category->id,
                        'photo_path' => $Image
                    ]);
                }
            }

            return redirect()->route('category.index', ['id' => $request->get('property_id')])
                ;

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $category = Category::findorfail($id);
        if ($category->get_owner() == Auth::user()->id) {

        $property_types = DB::table('property_types')->get();
        $meal_types = DB::table('meal_types')->get();
        $bed_types = DB::table('bed_types')->get();

        return view('category.show', ['category' => $category, 'property_types' => $property_types, 'meal_types' => $meal_types, 'bed_types' => $bed_types]);
    }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'room_count' => 'required',
            'count' => 'required',
            'person_max' => 'required',
            'size' => 'required',
            'price_per_night' => 'required',
            'property_type' => 'required',
            'bed_type' => 'required',
            'meal_type' => 'required',
            'stars' => 'required',
            'description' => 'required',
        ]);
        Category::whereId($id)->update($validatedData);
        return redirect()->route('category.index', ['id' => $request->property_id])
            ->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function photo($id)
    {
        $category = Category::findorfail($id);
        if($category->get_owner()==Auth::user()->id){
        $photos = $category->get_photo();
        return view('category.photo', ['photos' => $photos, 'category' => $category]);
    }else{
            return redirect()->route('property.index');


        }
    }
    function photo_add(Request $request, $id)
    {
        if ($request->hasfile('photo')) {
            foreach ($request->file('photo') as $file) {
                $destinationPath = 'image/';
                $Image = date('Y-m-d-H-m-s') . rand() . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $Image);
                DB::table('photo_to_category')->insert([
                    'category_id' => $id,
                    'photo_path' => $Image
                ]);
            }
        }

        return redirect()->route('category.photo', ['id' => $id])
            ->with('success', 'category successfully');
        /*$category = Category::findorfail($id);
        $photos=$category->get_photo();
        return view('category.photo', ['photos'=>$photos,'property_id'=>$category->property_id,'category'=>$category->id]);*/

    }
    function photo_delete($path,$category_id)
    {
        $category=Category::findorfail($category_id);

        if ($category->get_owner() == Auth::user()->id) {

        if (DB::table('photo_to_category')->where('photo_path', $path)->delete()) {
            unlink(public_path('image\\' . $path));
            return redirect()->route('category.photo', ['id' => $category_id])->with('success', 'The image has been successfully deleted!');
        } else {
            return redirect()->route('category.photo', ['id' => $category_id])->with('error', 'Please try again!');
        }
    }
        return redirect()->route('property.index')->with('error', 'Please try again!');
    }



    public
    function destroy($id, $property_id)
    {
        if(Property::findorfail($property_id)->owner_id==Auth::user()->id) {
        if (Category::destroy($id)) {
            return redirect()->route('category.index', ['id' => $property_id])->with('success', 'The image has been successfully deleted!');
        } else {
            return redirect()->route('category.index', ['id' => $property_id])->with('error', 'Please try again!');
        }
    }return redirect()->route('category.index', ['id' => $property_id])->with('error', 'Please try again!');}
}
