<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        "nip",
        "username",
        "email",
        "password",
        'gender',
        'rank',
        'grade',
        'job_tier',
        'main_position',
        'additional_position',
        "role"
    ];
    public $timestamps = false;
}
