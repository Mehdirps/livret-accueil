<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'livret_id',
        'start_date',
        'end_date',
        'client_name',
        'status',
        'client_comment',
        'attachment_names',
    ];

    public function livret()
    {
        return $this->belongsTo(Livret::class);
    }
}
