<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class userslogin extends Model
{

    use HasFactory,HasApiTokens, Notifiable;
  
    protected $table = 'userslogin';
    protected $fillable = ['mobile_number', 'otp','otp_expires_at', 'is_number_verify', 'api_token'];
}
