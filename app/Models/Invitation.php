<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    public  $fillable = [
        'email',
        'invitation_code',
        'invitation_count',
        'user_id',
        'group_session_id',
        'is_invited',
        'payment_status',
        'amount',
        'reference'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function  groupsession(){
        return $this->belongsTo(GroupSession::class, 'group_session_id');
    }
}
