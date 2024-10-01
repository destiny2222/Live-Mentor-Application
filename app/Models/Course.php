<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    public $fillable = [ 'image', 'title', 'description','author', 'level', 'price', 'status','slug' ,'category_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSLugAttribute(): string
    {
        return Str::slug($this->title);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function syllabus()
    {
        return $this->hasMany(Syllabus::class);
    }

    
}
