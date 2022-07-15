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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function status_name()
    {
        return $this->hasOne(Status::class, 'id', 'status');
    }
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'reservation_id', 'id');
    }
}
