<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivretView extends Model
{
    use HasFactory;

    protected $fillable = ['livret_id', 'viewed_at'];

    public function livret()
    {
        return $this->belongsTo(Livret::class);
    }
}
