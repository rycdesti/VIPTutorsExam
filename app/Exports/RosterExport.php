<?php

namespace App\Exports;

use App\Models\Roster;
use Maatwebsite\Excel\Concerns\FromCollection;

class RosterExport implements FromCollection
{
    public function __construct($team)
    {
        $this->team = $team;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $team = $this->team;
        return  Roster::query()
            ->with('playerTotals')
            ->when($team, function($query) use ($team) {
                $query->where('team_code', $team);
            })
            ->get();
    }
}
