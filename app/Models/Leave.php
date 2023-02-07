<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['name','is_paid','max_per_month'];
    protected $dates = ['from','to'];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('id' , 'days' , 'from' , 'to' , 'status' , 'reason')->withTimestamps();
    }
}
