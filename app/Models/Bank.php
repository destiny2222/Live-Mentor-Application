<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public $fillable = [
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
