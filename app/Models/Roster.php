<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;

    public $table = 'roster';

    public $casts = [
        'id' => 'string',
        'college' => 'string',
        'dob' => 'string',
        'height' => 'string',
        'name' => 'string',
        'nationality' => 'string',
        'number' => 'integer',
        'pos' => 'string',
        'team_code' => 'string',
        'weight' => 'integer',
        'years_exp' => 'integer'
    ];

    public function playerTotals()
    {
        return $this->hasOne(PlayerTotals::class, 'player_id', 'id');
    }
}
