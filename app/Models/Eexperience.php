<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eexperience extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'title',
        'company',
        'start_date',
        'end_date',
        'description',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tutor(){
        return $this->belongsTo(Tutor::class);
    }

    // public function getStartDateAttribute($value)
    // {
    //     return date('Y-m-d', strtotime($value));
    // }

    // public function getEndDateAttribute($value)
    // {
    //     return date('Y-m-d', strtotime($value));
    // }


}
