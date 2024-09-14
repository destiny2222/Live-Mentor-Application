<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSession extends Model
{
    use HasFactory;

    public $fillable = [ 
        'title',
        'start_time',
        'end_time',
        'location',
        'description',
        'topic_expertise',
        'interest_areas',
        'max_participants',
        'price',
        'status',
        'image',
        'user_id',
    ];

    public function user(){
        return $this->belongTo(User::class);
    }
}
