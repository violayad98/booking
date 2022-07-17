<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'name', 'city', 'street',
        'building', 'apt',
    ];

    public function get_owner()
    {
        return $this - belongsTo(User::class, 'id', 'owner_id');
    }

    public function categories()
    {

        return $this->hasMany(Category::class, 'property_id', 'id');
    }

    public function city_name()
    {

        return $this->hasOne(City::class, 'id', 'city');
    }

    public function get_facilities()
    {
        $res = [];
        $facilities = DB::table('facilities_to_property')->select('*')->
        join('facilities', 'facilities.id', "=", 'facilities_to_property.facility_id')
            ->where('property_id', $this->id)->get();
        foreach ($facilities as $fac) {
            $res[]=$fac->facility_id;
        }
        return $res;
    }
}
