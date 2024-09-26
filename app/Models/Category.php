<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name', 'slug' ,'image'];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSLugAttribute(): string
    {
        return Str::slug($this->name);
    }


    public function course(){
        return $this->hasMany(Course::class);
    }

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class);
    }
    

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class);
    }

}
