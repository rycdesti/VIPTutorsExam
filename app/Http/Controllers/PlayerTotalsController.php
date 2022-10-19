<?php

namespace App\Http\Controllers;

use App\Models\PlayerTotals;
use App\Models\Roster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlayerTotalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *
     * @param  \App\Models\PlayerTotals  $playerTotals
     */
    public function show($playerId)
    {
        $roster = Roster::query()
            ->with('playerTotals')
            ->where('id', $playerId)
            ->first();

        return view('playerTotals')->with('roster', $roster);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlayerTotals  $playerTotals
     * @return \Illuminate\Http\Response
     */
    public function edit(PlayerTotals $playerTotals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlayerTotals  $playerTotals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayerTotals $playerTotals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlayerTotals  $playerTotals
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayerTotals $playerTotals)
    {
        //
    }
}
