<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',  'property_id', 'check-in', 'check-out',
        'person', 'barcode', 'amount', 'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
    public function property()
    {
        return $this-belongsTo(Property::class, 'id', 'property_id');
    }
}
