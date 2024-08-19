<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syllabus extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','tutor_id', 'description', 'user_id'];

    public function tutors(){
        return $this->belongsTo(Tutor::class);
    }
}
