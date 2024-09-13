<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Item extends Model
{
    use HasFactory,HasApiTokens, Notifiable;
    protected $table = 'items';

    protected $fillable = [
        'created_by', 'item_name', // Include 'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define any relationships here if needed
    public function creator()
    {
        return $this->belongsTo(userslogin::class, 'created_by');
    }
}
