<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    public $fillable = [ 
        'title',
        'about',
        'Skills',
        'year_experience',
        'experience',
        'education',
        'availability',
        'category_id',
        'status',
        'is_approved',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getSkillsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function getAvailabilityAttribute($value){
        return json_decode($value, true) ?? [];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // count the number of experience
    public function getExperienceAttribute($value){
        return $value ? $value : 0;
    }

    // expericence relationship
    public function experience(){
        return $this->hasMany(Experience::class);
    }

    protected $casts = [
        // 'category_id' => 'array',
        'Skills' => 'array',
        'availability'=> 'array',
    ];

}
