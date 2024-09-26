<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'prefer',
        'status',
        'price',
        'language',
        'level',
        'time',
        'day',
        'user_id',
        'course_id',
        'end_time',
        'additional_information',
        'payment_status',
        'tutor_id',
        'zoom_meeting_id',
        'zoom_meeting_password',
        'zoom_meeting_url',
        'zoom_meeting_start_time',
        'is_approved',
    ];

    protected $casts = [ 
        'day' => 'array',
        // 'time' => 'time',
    ];


    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If the proposal belongs to a tutor, you may also have
    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
    

}
