<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livret extends Model
{
    use HasFactory;

    protected $fillable = [
        'livret_name',
        'establishment_name',
        'establishment_address',
        'establishment_phone',
        'establishment_email',
        'establishment_website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wifi()
    {
        return $this->hasMany(ModuleWifi::class, 'livret');
    }

    public function digicode()
    {
        return $this->hasMany(ModuleDigicode::class, 'livret');
    }

    public function endInfos()
    {
        return $this->hasMany(ModuleEndInfos::class, 'livret');
    }

    public function homeInfos()
    {
        return $this->hasOne(ModuleHome::class, 'livret');
    }

    public function utilsPhone()
    {
        return $this->hasMany(ModuleUtilsPhone::class, 'livret');
    }

    public function startInfos()
    {
        return $this->hasMany(ModuleStartInfos::class, 'livret');
    }

    public function utilsInfos()
    {
        return $this->hasMany(ModuleUtilsInfos::class, 'livret');
    }

    public function placeGroups()
    {
        return $this->hasMany(PlaceGroup::class);
    }

    public function NearbyPlaces()
    {
        return $this->hasMany(NearbyPlace::class);
    }

}
