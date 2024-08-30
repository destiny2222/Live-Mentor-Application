<?php

namespace App\Models;

use App\Models\Tutor;
use App\Models\Proposal;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'last_seen',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

     public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    
    public function reviewCount()
    {
        return $this->reviews()->count();
    }
    

     public function proposals()
     {
         return $this->hasMany(Proposal::class);
     }
 
     public function tutor()
     {
         return $this->hasOne(Tutor::class);
     }
     public function mentor()
     {
        return $this->hasOne(Mentor::class);
     }

     public function experiences()
     {
         return $this->hasMany(Experience::class);
     }

     // calculating the total number of experiences
     public function getExperiencesCountAttribute()
     {
        return $this->experiences()->count();
     }

    public function checkTutorStatus(){
        if($this->role == 'tutor'){
            if ($this->tutor    && $this->tutor->status == null) return false;
            return true;
        }
    }
    public function checkMentorStatus(){
        if($this->role == 'mentor'){
            if ($this->mentor    && $this->mentor->status == null) return false;
            return true;
        }
    }


    public function checkMentorActiveStatus()
    {
        if($this->role == 'mentor'){
            if ($this->mentor) return $this->mentor->status === 0;
            return false;
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
