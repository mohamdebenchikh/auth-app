<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $fillable = [
        'name','email','photo','cover','bio','phone','birthday','location','job_title','gender','password'
    ];

}