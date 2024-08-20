<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'company',
        'date',
        'date_end',
        'description',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }


}
