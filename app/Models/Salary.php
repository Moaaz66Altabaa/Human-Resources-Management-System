<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['net' , 'user_id' , 'overtime' , 'hra' , 'conveyance' , 'la' , 'fa' , 'total'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
