@extends('layouts.app')

@push('pre-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
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
                        <th class="publishing">Split %</th>
                        <th class="publishing">Name</th>
                        <th class="publishing">Split %</th>
                        <th class="master">Name</th>
                        <th class="master">Split %</th>
                        <th class="master">Name</th>
                        <th class="master">Split %</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($songInfo as $info)
                        <tr>
                            <th class="publishing">Name</th>
                            <th class="publishing">Split %</th>
                            <th class="publishing">Name</th>
                            <th class="publishing">Split %</th>
                            <th class="master">Name</th>
                            <th class="master">Split %</th>
                            <th class="master">Name</th>
                            <th class="master">Split %</th>
                        </tr>
                        <tr>
                            <td>song Name 1</td>
                            <td>abc</td>
                            <td>50</td>
                            <td>xyz</td>
                            <td>90</td>
                            <td>pqr</td>
                            <td>80</td>
                            <td>stu</td>
                            <td>90</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" data-toggle="modal" data-target="#edit_song"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#delete_song"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
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