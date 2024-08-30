<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
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
    public function mentor(){
        return $this->belongsTo(Tutor::class);
    }

    protected $casts = [
        'title' => 'array',
        'degree' => 'array',
        'company' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'description' => 'array',
    ];
}
