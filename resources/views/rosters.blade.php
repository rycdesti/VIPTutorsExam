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
    <form method="GET" action="{{ url('/api/rosters') }}">
        <div class="col-md-2">
            <div class="form-group">
                <label for="id" style="font-weight: bold">Team:</label>
                <select class="form-control" name="team" id="team" onchange="this.form.submit()">
                    <option value="">Display All</option>
                    @foreach($data['teams'] as $team)
                    <option value="{{$team['code']}}" {{ $team['code'] == $data['teamSelected'] ? 'selected' : '' }}>{{$team['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div><button type="submit" class="btn btn-primary" formaction="{{ url('api/printRoster') }}">Print</button></div>
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
            @php($playerTotals = $roster['playerTotals'])
            <tr>
                <td>{{ $roster['name'] }}</td>
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
                    <div>GAmes Started: {{ $playerTotals['games_started'] }}</div>
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
