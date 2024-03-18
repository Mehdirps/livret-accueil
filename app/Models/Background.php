<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'backgrounds_group_id'];

    public function backgroundGroup()
    {
        return $this->belongsTo(BackgroundGroup::class, 'backgrounds_group_id');
    }
}
