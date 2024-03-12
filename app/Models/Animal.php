<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId', // Assuming 'userld' is a typo for 'user_id'
        'name',
        'chipNumber',
        'gender',
        'colorId',
        'description',
        'image', // Assuming 'image' refers to the animal's image   URL
    ];
}
