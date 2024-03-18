<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleStartInfos extends Model
{
    use HasFactory;

    protected $table = 'module_start_infos';

    protected $fillable = [
        'name',
        'text'
    ];
}
