<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function backgrounds()
    {
        return $this->hasMany(Background::class);
    }
}
