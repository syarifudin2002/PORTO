<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = ['id'];

    protected $casts = [
        'tools' => 'array',
        'methodology' => 'array',
        'findings' => 'array',
    ];
}
