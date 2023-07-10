<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $table = 'developers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    public $timestamps = true;

    protected $hidden = [
        'password',
    ];
}
