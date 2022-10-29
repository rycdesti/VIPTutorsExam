<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTotals extends Model
{
    use HasFactory;

    public $casts = [
        'player_id' => 'string',
        'age' => 'integer',
        'games' => 'integer',
        'games_started' => 'integer',
        'minutes_played' => 'integer',
        'field_goals' => 'integer',
        'field_goals_attempted' => 'integer',
        '3pt' => 'integer',
        '3pt_attempted' => 'integer',
        '2pt' => 'integer',
        '2pt_attempted' => 'integer',
        'free_throws' => 'integer',
        'free_throws_attempted' => 'integer',
        'offensive_rebounds' => 'integer',
        'defensive_rebounds' => 'integer',
        'assists' => 'integer',
        'steals' => 'integer',
        'blocks' => 'integer',
        'turnovers' => 'integer',
        'personal_fouls' => 'integer'
    ];

    public function roster()
    {
        return $this->belongsTo(Roster::class, 'id', 'player_id');
    }
}
