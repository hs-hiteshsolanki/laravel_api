<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
        // The table associated with the model (optional if using Laravel's convention)
        protected $table = 'parties';

        // The attributes that are mass assignable
        protected $fillable = [
            'party_name',
            'created_by', // This assumes you want to track who created the party
        ];

        // Define any relationships here if needed
        public function transactions()
        {
            return $this->hasMany(Transaction::class, 'party_id');
        }
}
