<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',  'name', 'city', 'street',
        'building', 'apt',
    ];
    public function owner()
    {
        return $this-belongsTo(User::class, 'id', 'owner_id');
    }
    public function property()
    {

        return $this->hasMany(Reservation::class, 'property_id', 'id');
    }
}
