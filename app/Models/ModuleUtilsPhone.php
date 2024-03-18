<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleUtilsPhone extends Model
{
    use HasFactory;

    protected $table = 'module_utils_phone';

    protected $fillable = [
        'name',
        'number',
    ];
}
