<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'title',
        'message',
    ];

    public function livret()
    {
        return $this->belongsTo(Livret::class);
    }
}
