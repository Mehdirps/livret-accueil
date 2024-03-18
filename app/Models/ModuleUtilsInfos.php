<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleUtilsInfos extends Model
{
    use HasFactory;

    protected $table = 'module_utils_infos';

    protected $fillable = [
        'name',
        'subname',
        'text'
    ];
}
