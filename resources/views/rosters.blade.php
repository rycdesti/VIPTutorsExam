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

    <form method="GET" action="{{ url('api/filterRoster') }}" style="margin: 1rem" id="search-form" name="search-form">
        @php($filter = $data['filter'])
        <div>
            <div>
                <label for="type" style="font-weight: bold">Type:</label>
                <select name="type" id="type">
                    <option value="players" {{ $filter['type'] === 'players' ? 'selected' : '' }}>Players</option>
                    <option value="playerstats" {{ $filter['type'] === 'playerstats' ? 'selected' : '' }}>Player Stats</option>
                </select>
            </div>
            <div>
                <label for="position" style="font-weight: bold">Position:</label>
                <select name="position" id="position">
                    <option value="">Display All</option>
                    @foreach($data['positions'] as $position)
                    <option value="{{$position}}" {{ $position == $filter['position'] ? 'selected' : '' }}>{{$position}}</option>
                    @endforeach

                </select>
            </div>
            <div>
                <label for="team" style="font-weight: bold">Team:</label>
                <select name="team" id="team">
                    <option value="">Display All</option>
                    @foreach($data['teams'] as $team)
                    <option value="{{$team['code']}}" {{ $team['code'] == $filter['team'] ? 'selected' : '' }}>{{$team['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="player" style="font-weight: bold">Player:</label>
                <input type="text" name="player" id="player" style="border: 1px solid lightgray;" value="{{ $filter['player'] }}"/>
            </div>
        </div>
        <style>
            button {
                border: 1px solid lightgray;
                padding: 4px;
                width: 5rem;
                border-radius: 0.2rem;
                color: white;
                background: dodgerblue !important;
                margin-top: 5px;
            }
        </style>
        <div>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>

        <div style="margin-top: 1rem">
            <label for="format" style="font-weight: bold">Export Type:</label>
            <select name="format" id="format">
                <option value=""></option>
                <option value="csv">CSV</option>
                <option value="xml">XML</option>
                <option value="json">JSON</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" formaction="{{ url('api/exportRoster') }}">Export</button>
        </div>
    </form>

    <table class="table-auto" style="border-spacing: 1rem">
        <thead>
        <style>
            table {
                border-collapse: separate;
                border-spacing: 10px 0;
            }
            th {
                background-color: gray;
                color: white;
            }
            th,
            td {
                border-radius: 0.2rem;
                width: auto;
                border: 1px solid black;
                padding: 5px;
            }
            h2 {
                color: #4287f5;
            }
        </style>
        <tr>
            <th>Player Name</th>
            <th>Team</th>
            <th>Number</th>
            <th>Position</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Date of Birth</th>
            <th>Nationality</th>
            <th>Years of Experience</th>
            <th>College</th>
            <th>Other Information</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['rosters'] as $roster)
            @php($team = $roster['team'])
            @php($playerTotals = $roster['playerTotals'])
            <tr>
                <td>{{ $roster['name'] }}</td>
                <td>{{ $team['name'] }}</td>
                <td>{{ $roster['number'] }}</td>
                <td>{{ $roster['pos'] }}</td>
                <td>{{ $roster['height'] }}</td>
                <td>{{ $roster['weight'] }}</td>
                <td>{{ date('j F, Y', strtotime($roster->dob)) }}</td>
                <td>{{ $roster['nationality'] }}
                <td>{{ $roster['years_exp'] }}</td>
                <td>{{ $roster['college'] }}</td>
                <td style="align-content: start">
                    <div>Age: {{ $playerTotals['age'] }}</div>
                    <div>Games: {{ $playerTotals['games'] }}</div>
                    <div>Games Started: {{ $playerTotals['games_started'] }}</div>
                    <div>Minutes Played: {{ $playerTotals['minutes_played'] }}</div>
                    <div>Field Goals: {{ $playerTotals['field_goals'] }}</div>
                    <div>Field Goals Attempted: {{ $playerTotals['field_goals_attempted'] }}</div>
                    <br>
                    <a style="color: dodgerblue" href="/api/playerTotals/{{$roster['id']}}">View More</a>
                </td>
{{--                <td><a href="/api/roster/{{$team['code']}}">View Roster</a></td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>

<script type="text/javascript">
    $("#search-form").submit(function(){
        $("input").each(function(index, input){
            if($(input).val() === "") {
                $(input).remove();
            }
        });
    });
</script>
