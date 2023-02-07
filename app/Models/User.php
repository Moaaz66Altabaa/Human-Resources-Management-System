<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_id',
        'is_admin',
        'first_name',
        'last_name',
        'father_name',
        'mobile_number',
        'hours_per_month',
        'address',
        'marital_status',
        'hometown',
        'nationality',
        'gender',
        'birth_date',
        'image_path',
        'number_of_children',
        'emergency_name',
        'emergency_relation',
        'emergency_number',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class , 'department_id' );
    }

    public function job(){
        return $this->belongsTo(Job::class , 'job_id');
    }

    public function salary(){
        return $this->hasOne(Salary::class);
    }

    public function attendence(){
        return $this->hasMany(Attendence::class);
    }

    public function leaves(){
        return $this->belongsToMany(Leave::class)->withPivot('id' ,'days' , 'from' , 'to' , 'status' , 'reason')->withTimestamps();
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function overtimes(){
        return $this->hasMany(Overtime::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }

}
