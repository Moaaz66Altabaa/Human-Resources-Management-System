<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'status' , 'check_in' , 'check_out'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
