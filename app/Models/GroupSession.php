<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'invitation_token',
        'status',
        'zoom_meeting_link',
        'image',
        'user_id',
        'is_approved'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function getRouteKeyName()
    {
        return 'invitation_token';
    }

    public function getInvitationTokenAttribute(): string
    {
        return Str::slug($this->title);
    }


    protected $casts = [
        'interest_areas' => 'array'
    ];

}
