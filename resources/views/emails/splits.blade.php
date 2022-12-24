<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <style>{{ file_get_contents(public_path('assets/css/bootstrap.min.css')) }}</style>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">{{ config('app.name') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5>Song Name: {{ $song->name }}</h5>
        </div>
        <div class="col-md-6">
            <h6>Publishing Splits</h6>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                </tr>
                @foreach($song->info->publishing_splits as $publishing_split)
                    <tr>
                        <td>{{ $publishing_split->name }}</td>
                        <td>{{ $publishing_split->email }}</td>
                        <td>{{ $publishing_split->number }}%</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-6">
            <h6>Master Splits</h6>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                </tr>
                @foreach($song->info->master_splits as $master_split)
                    <tr>
                        <td>{{ $master_split->name }}</td>
                        <td>{{ $master_split->email }}</td>
                        <td>{{ $master_split->number }}%</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</body>
</html>
