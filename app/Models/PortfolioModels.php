<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];
}

class Project extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tools' => 'array',
        'methodology' => 'array',
        'findings' => 'array',
    ];
}

class Skill extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'items' => 'array',
    ];
}

class Experience extends Model
{
    protected $guarded = ['id'];
}

class Certificate extends Model
{
    protected $guarded = ['id'];
}

class Post extends Model
{
    protected $guarded = ['id'];
}

class Message extends Model
{
    protected $guarded = ['id'];
}
