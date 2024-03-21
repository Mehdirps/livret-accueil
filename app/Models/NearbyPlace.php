<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyPlace extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'description', 'place_group_id'];

    public function placeGroup()
    {
        return $this->belongsTo(PlaceGroup::class);
    }
}
