<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Artist extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'prefix', 'fname', 'lname', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}