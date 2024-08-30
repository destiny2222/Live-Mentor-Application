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
        'category_id',
        'status',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    

    // count the number of experience
    public function getExperienceAttribute($value){
        return $value ? $value : 0;
    }

    protected $casts = [
        // 'category_id' => 'array',
        'Skills' => 'array',
    ];

}
