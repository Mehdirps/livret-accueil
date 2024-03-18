<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleEndInfos extends Model
{
    use HasFactory;

    protected $table = 'module_end_infos';

    protected $fillable = [
        'name',
        'text'
    ];
}
