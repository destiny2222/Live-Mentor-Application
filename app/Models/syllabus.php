<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syllabus extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','duration', 'price', 'description', 'user_id'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
    
    public function course(){
        return $this->belongsTo(Course::class);
    }


    public $casts = [ 
        'description'=> 'array'
    ];
}
