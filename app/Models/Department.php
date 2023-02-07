<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'tel_number'];

    public function users(){
        return $this->hasMany(User::class );
    }


    public function jobs(){
        return $this->hasMany(Job::class );
    }
}
