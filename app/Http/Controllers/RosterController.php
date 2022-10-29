<?php

namespace App\Http\Controllers;

use App\Exports\RosterExport;
use App\Models\Roster;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use LSS\Array2XML;
use Maatwebsite\Excel\Facades\Excel;

class RosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        $position = $request->get('position');
        $team = $request->get('team');
        $player = $request->get('player');

        list ($teams, $positions) = $this->initializeFilters();

        $rosters = Roster::query()
            ->has('team')
            ->has('playerTotals')
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

        $data = array(
            'filter' => [
                'type' => $type,
                'position' => $position,
                'team' => $team,
                'player' => $player
            ],
            'teams' => $teams,
            'positions' => $positions,
            'rosters' => $rosters
        );

        return view('rosters')->with('data', $data);
    }

    public function initializeFilters () {
        $teams = Team::query()
            ->get();

        $positions = Roster::query()
            ->distinct('pos')
            ->pluck('pos');

        return [$teams, $positions];
    }

    public function printRoster (Request $request) {
        $format = $request->get('format');

        $data = (new RosterExport($request));
        if (!$format || $format === 'csv') {
            return Excel::download($data, 'rosters.csv');
        } elseif ($format === 'json') {
            $filename = 'rosters.json';
            $handle = fopen($filename, 'w+');
            fputs($handle, $data->collection()->toJson(JSON_PRETTY_PRINT));
            fclose($handle);
            $headers = array('Content-type'=> 'application/json');
            return response()->download($filename, $filename, $headers);
        } elseif ($format === 'xml') {
            $xml = Array2XML::createXML('rosters', $data->xml());
            $filename = 'rosters.xml';
            $handle = fopen($filename, 'w+');
            fputs($handle, $xml->saveXML());
            fclose($handle);
            $headers = array('Content-type'=> 'application/xml');
            return response()->download($filename, $filename, $headers);
        }
    }
}
