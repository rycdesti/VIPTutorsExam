<?php

namespace App\Exports;

use App\Models\Roster;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RosterExport implements FromCollection, WithHeadings
{
    public function __construct($request)
    {
        $this->request = $request;

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $type = $this->request->get('type');
        $position = $this->request->get('position');
        $team = $this->request->get('team');
        $player = $this->request->get('player');

        $rosters = Roster::query()
            ->when($type === 'playerstats', function ($query) {
                $query->has('playerTotals');
            })
            ->when($team, function($query) use ($team) {
                $query->where('team_code', $team);
            })
            ->when($position, function($query) use ($position) {
                $query->where('pos', $position);
            })
            ->when($player, function($query) use ($player) {
                $query->where('name', 'like', '%'.$player.'%');
            })
            ->get();

        if ($type === 'playerstats') {
            $rosters = $rosters->pluck('playerTotals', 'name');
        }

        return $rosters;
    }

    public function xml()
    {
        $type = $this->request->get('type');
        $data = $this->collection()->toArray();
        $xml = '';

        foreach ($data as $key => $items) {
            $xml .= '<Player>';
            if ($items) {
                if ($type === 'playerstats') {
                    $xml .= '<ColName>' . $key . '</ColName>';
                }
                foreach ($items as $item => $value) {
                    $tag = str_replace(' ', '', ucwords(str_replace('_', ' ', $item)));
                    $xml .= '<Col' . $tag . '>' . htmlspecialchars($value) . '</Col' . $tag . '>';
                }
            }

            $xml .= '</Player>';
        }

        return [
            'title' => 'Rosters',
            'body' => [
                '@xml' => $xml,
            ],
        ];
    }

    public function headings(): array
    {
        $heading = [
            'players' => [
                'Player ID',
                'Team',
                'Number',
                'Player Name',
                'Position',
                'Height',
                'Weight',
                'Date of Birth',
                'Nationality',
                'Years of Experience',
                'College'
            ],
            'playerstats' => [
                'Player ID',
                'Age',
                'Games',
                'Games Started',
                'Minutes Played',
                'Field Goals',
                'Field Goals Attempted',
                '3 Points',
                '3 Points Attempted',
                '2 Points',
                '2 Points Attempted',
                'Free Throws',
                'Free Throws Attempted',
                'Offensive Rebounds',
                'Defensive Rebounds',
                'Assists',
                'Steals',
                'Blocks',
                'Turnovers',
                'Personal Fouls'
            ]
        ];

        return $heading[$this->request->get('type')];
    }
}
