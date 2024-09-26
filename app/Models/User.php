<?php

namespace App\Models;

use App\Models\Awards;
use App\Models\Bank;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Mentor;
use App\Models\Proposal;
use App\Models\Review;
use App\Models\Tutor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

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
        'provider_name',
        'provider_id',
        'provider_token',
        'city',
        'country',
        'language',
        'username',
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

    public function bank()
    {
        return $this->hasOne(Bank::class);
    }

    public function mentorSession(){
        return $this->hasMany(MentorApplication::class);
    }

    public function countMentorSession(){
        return $this->mentorSession()->count();
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    
    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    // calculates 
    

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
     public function education()
     {
         return $this->hasMany(Education::class);
     }

     public function certification()
     {
        return $this->hasMany(Awards::class);
     }


     public static function generateUniqueUsername($name)
    {
        $username = Str::slug($name);
        $originalUsername = $username;
        $counter = 1;

        while (self::where('username', $username)->exists()) {
            $username = $originalUsername . '-' . $counter;
            $counter++;
        }

        return $username;
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

public function checkMentorStatus()
{
    if ($this->role == 'mentor') {
        if ($this->mentor) return  $this->mentor->is_approved === null;
        return true;
    }
}

public function checkMentorActiveStatus()
{
    if ($this->role == 'mentor' && $this->mentor) {
        return $this->mentor->is_approved === 0;
    }
    return false;
}

public function isMentorApproved()
{
    if ($this->role == 'mentor' && $this->mentor && $this->mentor->is_approved === 1) {
        if (!session('mentor_approval_shown')) {
            session(['mentor_approval_shown' => true]);
            return true;
        }
    }
    return false;
}




    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
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

    public function setProviderTokenAttribute($value){
        return $this->attributes['provider_token'] = Crypt::encryptString($value);
    }
    
    public function getProviderTokenAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
