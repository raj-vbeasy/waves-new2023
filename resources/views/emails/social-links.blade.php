<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <style>{{ file_get_contents(public_path('assets/css/bootstrap.min.css')) }}</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">{{ config('app.name') }}</h1>
        </div>
        <div class="col-md-12">
            <hr>
            <table>
                <tr>
                    <td>
                        <strong>Facebook: </strong>
                    </td>
                    <td>{{ $socialLinks->facebook }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Twitter: </strong>
                    </td>
                    <td>{{ $socialLinks->twitter }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Instagram: </strong>
                    </td>
                    <td>{{ $socialLinks->instagram }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Website: </strong>
                    </td>
                    <td>{{ $socialLinks->website }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Spotify: </strong>
                    </td>
                    <td>{{ $socialLinks->spotify }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Apple Music: </strong>
                    </td>
                    <td>
                        {{ $socialLinks->applie_music }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>SoundCloud: </strong>
                    </td>
                    <td>
                        {{ $socialLinks->sound_cloud }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>