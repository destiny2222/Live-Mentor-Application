<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'tutor_id',
        'school',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    protected $casts = [
        'school' => 'array',
        'degree' => 'array',
        'field_of_study' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'description' => 'array',
    ];
}
