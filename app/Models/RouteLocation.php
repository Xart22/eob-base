<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteLocation extends Model
{
    use HasFactory;
    protected $table = 'route_location';
    protected $guarded = [];

    public function getRoute()
    {
        return $this->belongsTo(Route::class);
    }

    public function getLocation()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
}
