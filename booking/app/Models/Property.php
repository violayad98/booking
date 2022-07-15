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
        'owner_id',  'name', 'city', 'street',
        'building', 'apt',
    ];
    public function get_owner()
    {
        return $this-belongsTo(User::class, 'id', 'owner_id');
    }
    public function categories()
    {

        return $this->hasMany(Category::class, 'property_id', 'id');
    }
    public function city_name()
    {

        return $this->hasOne(City::class, 'id', 'city');
    }
    public function scopeAuthor($query){

        $user = Auth::user();


            return $query->where('user_id',$user->id);


    }
}
