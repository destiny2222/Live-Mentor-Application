<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BookSession extends Model
{
    use HasFactory, Notifiable;

    public $fillable = [
        'book_session',
        'book_session_price',
        'book_session_time_zone',
        'minutes',
        'book_session_date',
        'book_session_time',
        'book_session_payment_status',
        'user_id',
        'status',
        'message',
        'mentor_id',
        'zoom_meeting_id',
        'zoom_meeting_password',
        'zoom_meeting_start_time',
        'zoom_meeting_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    
}
