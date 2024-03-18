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
        return $this->hasOne(ModuleWifi::class);
    }

    public function digicode()
    {
        return $this->hasOne(ModuleDigicode::class);
    }

    public function endInfos()
    {
        return $this->hasOne(ModuleEndInfos::class);
    }

    public function homeInfos()
    {
        return $this->hasOne(ModuleHome::class);
    }

    public function utilsPhone()
    {
        return $this->hasMany(ModuleUtilsPhone::class);
    }

    public function startInfos()
    {
        return $this->hasMany(ModuleStartInfos::class);
    }

    public function utilsInfos()
    {
        return $this->hasMany(ModuleUtilsInfos::class);
    }

}
