<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleHome extends Model
{
    use HasFactory;

    protected $table = 'module_home';

    protected $fillable = [
        'name',
        'text'
    ];
}
