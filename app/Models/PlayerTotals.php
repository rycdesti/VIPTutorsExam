<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTotals extends Model
{
    use HasFactory;

    public $casts = [
        'player_id' => 'string',
        'age' => 'int',
        'games' => 'int',
        'games_started' => 'int',
        'minutes_played' => 'int',
        'field_goals' => 'int',
        'field_goals_attempted' => 'int',
        '3pt' => 'int',
        '3pt_attempted' => 'int',
        '2pt' => 'int',
        '2pt_attempted' => 'int',
        'free_throws' => 'int',
        'free_throws_attempted' => 'int',
        'offensive_rebounds' => 'int',
        'defensive_rebounds' => 'int',
        'assists' => 'int',
        'steals' => 'int',
        'blocks' => 'int',
        'turnovers' => 'int',
        'personal_fouls' => 'int'
    ];

    public function roster()
    {
        return $this->belongsTo(Roster::class, 'id', 'player_id');
    }
}
