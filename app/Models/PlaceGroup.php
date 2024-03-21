<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'livret_id'];

    public function livret()
    {
        return $this->belongsTo(Livret::class);
    }

    public function nearbyPlaces()
    {
        return $this->hasMany(NearbyPlace::class);
    }
}
