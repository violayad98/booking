<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'property_id',  'name', 'room_count', 'count',
        'person_max', 'size', 'price_per_night', 'property_type','bed_type','meal_type','stars','grade','description',
    ];
    public function property()
    {
        return $this-belongsTo(Property::class, 'id', 'property_id');
    }
    public function get_photo()
    {
       return DB::table('photo_to_category')->where('category_id',$this->id)->get();
    }
    public function get_meal_type()
    {
        return DB::table('meal_types')->where('id',$this->meal_type)->first();
    }
    public function get_property_type()
    {
        return DB::table('property_types')->where('id',$this->property_type)->first();
    }
    public function get_bed_type()
    {
        return DB::table('bed_types')->where('id',$this->bed_type)->first();
    }
}
