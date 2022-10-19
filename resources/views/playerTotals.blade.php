<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
{{--    {{ $teams }}--}}
   <div style="border: 0.5px; margin: 2rem">
       @php($playerTotals = $roster['playerTotals'])
       <div style="font-size: 2rem">{{ $roster['name'] }}</div>
       <div style="align-content: start">
           <div>Age: {{ $playerTotals['age'] }}</div>
           <div>Games: {{ $playerTotals['games'] }}</div>
           <div>GAmes Started: {{ $playerTotals['games_started'] }}</div>
           <div>Minutes Played: {{ $playerTotals['minutes_played'] }}</div>
           <div>Field Goals: {{ $playerTotals['field_goals'] }}</div>
           <div>Field Goals Attempted: {{ $playerTotals['field_goals_attempted'] }}</div>
           <div>3 Points: {{ $playerTotals['3pt'] }}</div>
           <div>3 Points Attempted: {{ $playerTotals['3pt_attempted'] }}</div>
           <div>2 Points: {{ $playerTotals['2pt'] }}</div>
           <div>2 Points Attempted: {{ $playerTotals['2pt_attempted'] }}</div>
           <div>Free Throws: {{ $playerTotals['free_throws'] }}</div>
           <div>Free Throws Attempted: {{ $playerTotals['free_throws_attempted'] }}</div>
           <div>Offensive Rebounds: {{ $playerTotals['offensive_rebounds'] }}</div>
           <div>Defensive Rebounds: {{ $playerTotals['defensive_rebounds'] }}</div>
           <div>Assists: {{ $playerTotals['assists'] }}</div>
           <div>Steals: {{ $playerTotals['steals'] }}</div>
           <div>Blocks: {{ $playerTotals['blocks'] }}</div>
           <div>Turnovers: {{ $playerTotals['turnovers'] }}</div>
           <div>Personal Fouls: {{ $playerTotals['personal_fouls'] }}</div>
       </div>
   </div>
    </body>
</html>
