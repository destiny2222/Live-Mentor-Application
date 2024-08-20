<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'phone',
        'gender',
        'city',
        'country',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */



     public function tutor(){
        return $this->hasOne(Tutor::class);
     }

    public function checkTutorStatus(){
        if($this->role == 'tutor'){
            if ($this->tutor    && $this->tutor->status == null) return false;
            return true;
        }
    }
public function checkTutorActiveStatus()
{
    if($this->role == 'tutor'){
        if ($this->tutor) return $this->tutor->status === 0;
        return false;
    }
}

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
