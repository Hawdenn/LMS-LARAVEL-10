<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = [
        'name',
        'title',
        'description',
        'photo',
        'file',
        'user_id',
        'status',
    ];
    // use HasFactory;
    // protected $table = 'courses';
    // protected $guarded = [];
}
