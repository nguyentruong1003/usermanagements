<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $guarded = ['*'];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'birthday',
        'sex',
        'address',
        'hobby',
        'level',
        'image'
    ];
}
