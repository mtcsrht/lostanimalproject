<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', // Assuming 'userld' is a typo for 'user_id'
        'name',
        'chip_number',
        'gender',
        'color_id',
        'description',
        'image', // Assuming 'image' refers to the animal's image URL
    ];
}
