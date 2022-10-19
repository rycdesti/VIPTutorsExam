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
    <h1>Team: {{ $data['team']['name'] }}</h1>
    <table class="table-auto">
        <thead>
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
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['rosters'] as $roster)
            <tr>
                <td>{{ $roster['name'] }}</td>
                <td>{{ $roster['number'] }}</td>
                <td>{{ $roster['pos'] }}</td>
                <td>{{ $roster['height'] }}</td>
                <td>{{ $roster['weight'] }}</td>
                <td>{{ $roster['dob'] }}</td>
                <td>{{ $roster['nationality'] }}
                <td>{{ $roster['years_exp'] }}</td>
                <td>{{ $roster['college'] }}</td>
{{--                <td><a href="/api/roster/{{$team['code']}}">View Roster</a></td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>
