<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'department_id'];

    public function users(){
        return $this->hasMany(User::class );
    }

    public function department(){
        return $this->belongsTo(Department::class );
    }
}
