<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Tutor extends Model
{
    use HasFactory, Notifiable;

    public $fillable = [ 'category_id', 'language', 'description', 'price','image_public_id','experience',  'status','skill','title' ,'user_id'];

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

    public function proposal(){
        return $this->hasMany(Proposal::class);
    }
    

    public function educations(){
        return $this->hasMany(Education::class);
    }

    protected $casts = [
        'category_id' => 'array',
        'skill' => 'array',
    ];

    // protected function data(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // } 
}
