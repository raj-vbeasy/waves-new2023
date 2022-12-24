@extends('layouts.app')

@push('pre-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Songs Assets </h4>

            <p>“Please make sure the minimum upload quality is a Wav 44.1 kHz 16 bit (64kbps/channel) stereo”</p>p>

        </div>
        <div class="col-sm-8 col-xs-9 text-right m-b-20">
            <a href="{{ route('song-assets.create') }}" class="btn btn-primary rounded pull-right">
                <i class="fa fa-plus"></i> Add Song Assets
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable">
                    <thead>
                    <tr>
                        <th>Song</th>
                        <th>Full Track</th>
                        <th>Instrumental</th>
                        <th>Clean</th>
                        <th>Stems</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($songs as $song)
                        <tr>
                            <td>{{ $song->name }}</td>
                            <td>
                                <a href="{{ 'https://drive.google.com/open?id=' . $song->assets->full_track }}" target="_blank">Full Track</a>
                            </td>
                            <td>
                                <a href="{{ 'https://drive.google.com/open?id=' . $song->assets->instrumental }}" target="_blank">Instrumental</a>
                            </td>
                            <td>
                                <a href="{{ 'https://drive.google.com/open?id=' . $song->assets->clean }}" target="_blank">Clean</a>
                            </td>
                            <td>
                                <a href="{{ 'https://drive.google.com/open?id=' . $song->assets->steam }}" target="_blank">Stems</a>
                            </td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{ route('song-assets.edit', $song->assets->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

@push('pre-js')
<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
@endpush