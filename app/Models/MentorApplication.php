<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorApplication extends Model
{
    use HasFactory;

    public $fillable = [
        'session_title',
        'session_time',
        'session_price',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        // 'session_time' => 'datetime',
        'session_title'=>'array',
        // 'session_price'=>'array'
    ];

}
