<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    use HasFactory;

    public $fillable = [ 
        'project_id',
        'private_key_id',
        'private_key',
        'client_email',
        'client_id',
        'client_x509_cert_url'
    ];
}
