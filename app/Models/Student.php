<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'name',
        'profile_image',
        'first_name',
        'middle_name',
        'last_name',
        'name_extension',
        'course',
        'sex',
        'address',
        'contact_number',
        'birthdate',
        'is_active',
    ];
    
}
