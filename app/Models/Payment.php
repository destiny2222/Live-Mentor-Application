<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $fillable = [ 
        'course_id', 'user_id','amount','payment_date','payment_method','payment_status'
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
