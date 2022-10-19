<?php

namespace App\Http\Controllers;

use App\Exports\RosterExport;
use App\Models\Roster;
use App\Models\Team;
use Illuminate\Http\Request;
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
        $team = $request->get('team');
        $teams = Team::query()
            ->get();
        $rosters = Roster::query()
            ->with('playerTotals')
            ->when($team, function($query) use ($team) {
                $query->where('team_code', $team);
            })
            ->get();
        $data = array(
            'teamSelected' => $team,
            'teams' => $teams,
            'rosters' => $rosters
        );
        return view('rosters')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.

     */
    public function show(Request $request)
    {
        Log::info($request);
//        $teams = Team::query()
//            ->get();
//        $rosters = Roster::query()
//            ->with('playerTotals')
//            ->when($filter, function($query) use ($filter){
//                $query->where('team_code', $filter);
//            })
//            ->get();
//        $data = array(
//            'teams' => $teams,
//            'rosters' => $rosters
//        );
//        return view('rosters')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function edit(Roster $roster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roster $roster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roster $roster)
    {
        //
    }

    public function printRoster (Request $request) {
        $team = $request->get('team');
        return Excel::download(new RosterExport($team), 'roster' . '-' . $team . '.csv');
    }
}
