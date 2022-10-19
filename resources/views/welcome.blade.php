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
    <table class="table-auto">
        <thead>
        <tr>
            <th>Team</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
            <tr>
                <td>{{ $team['name'] }}</td>
                <td><a href="/api/roster/{{$team['code']}}">View Roster</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>
