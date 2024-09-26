<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Tutor extends Model
{
    use HasFactory, Notifiable;

    public $fillable = ['category_id', 'language', 'description', 'availability', 'price', 'image_public_id', 'is_approved', 'experience', 'status', 'skill', 'title', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    public function proposal()
    {
        return $this->hasMany(Proposal::class);
    }

    // count the number of experience
    public function getExperienceAttribute($value)
    {
        return $value ? $value : 0;
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    protected $casts = [
        'category_id' => 'array',
        'skill' => 'array',
        'availability' => 'array',
    ];


}
