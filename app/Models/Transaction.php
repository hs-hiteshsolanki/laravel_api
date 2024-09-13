<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Transaction extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    // protected $table ='items';
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'party_id',
        'item',
        'weight',
        'less',
        'add',
        'net_wt',
        'touch',
        'wastage',
        'fine',
        'date',
        'note',
        'type'
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id'); // Assuming 'item_id' is the foreign key
    }
}
