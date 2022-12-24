@extends('layouts.app')

@push('pre-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
    <style type="text/css">
        .publishing,
        tr>td:nth-child(2),
        tr>td:nth-child(3),
        tr>td:nth-child(4),
        tr>td:nth-child(5),
        tr>td:nth-child(6),
        tr>td:nth-child(7) {
            background-color: #FAD7A0;
        }
        .master,
        tr>td:nth-child(8),
        tr>td:nth-child(9),
        tr>td:nth-child(10),
        tr>td:nth-child(11),
        tr>td:nth-child(12),
        tr>td:nth-child(13) {
            background-color: #A3E4D7;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Song Info</h4>
        </div>
        <div class="col-sm-8 col-xs-9 text-right m-b-20">
            <a href="{{ route('song-info.create') }}" class="btn btn-primary rounded pull-right">
                <i class="fa fa-plus"></i> Add Song Info
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable">
                    <thead>
                    <tr>
                        <th rowspan="2">Song</th>
                        <th colspan="4" class="publishing" style="border: solid 2px #000;">Publishing Splits (must equal 100%)</th>
                        <th colspan="4" class="master" style="border: solid 2px #000;">Master Splits (must equal 100%)</th>
                        <th rowspan="2" class="text-right">Action</th>
                    </tr>
                    <tr>
                        <th class="publishing">Name</th>
                        <th class="publishing">Email</th>
                        <th class="publishing">Split %</th>
                        <th class="publishing">Name</th>
                        <th class="publishing">Email</th>
                        <th class="publishing">Split %</th>
                        <th class="master">Name</th>
                        <th class="master">Email</th>
                        <th class="master">Split %</th>
                        <th class="master">Name</th>
                        <th class="master">Email</th>
                        <th class="master">Split %</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($songInfo as $info)
                        <tr>
                            <td>{{ $info->song->name }}</td>
                            <td>{{ $info->publishing_splits->name_1 }}</td>
                            <td>{{ $info->publishing_splits->email_1 }}</td>
                            <td>{{ $info->publishing_splits->number_1 }}</td>
                            <td>{{ $info->publishing_splits->name_2 }}</td>
                            <td>{{ $info->publishing_splits->email_2 }}</td>
                            <td>{{ $info->publishing_splits->number_2 }}</td>
                            <td>{{ $info->master_splits->name_1 }}</td>
                            <td>{{ $info->master_splits->email_1 }}</td>
                            <td>{{ $info->master_splits->number_1 }}</td>
                            <td>{{ $info->master_splits->name_2 }}</td>
                            <td>{{ $info->master_splits->email_2 }}</td>
                            <td>{{ $info->master_splits->number_2 }}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{ route('song-info.edit', $info->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
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