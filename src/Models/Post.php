<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected string $table = 'posts';
    protected array $fillable = ['user_id','text'];
}