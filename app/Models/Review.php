<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $fillable =  [ 
        'rating',
        'tutor_id',
        'user_id',
        'comment',
        'name',
        'email',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function tutor(){
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
    
}
