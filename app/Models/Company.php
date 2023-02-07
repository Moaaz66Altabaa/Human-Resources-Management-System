<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name' , 'tel_number' , 'address' , 'description' , 'start_time' , 'finish_time'];

    use HasFactory;
}
