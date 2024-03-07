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
}
