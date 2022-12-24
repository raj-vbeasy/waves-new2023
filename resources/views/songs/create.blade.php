@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-2 col-xs-3">
            <h4 class="page-title">
                Add Songs <a href="javascript:void(0)" id="add_input"><i style="float: right" class="fa fa-plus-square"></i></a></h4>
        </div>
    </div>

    @foreach($songs as $song)
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="song_{{ $loop->iteration }}" class="control-label">Song {{ $loop->iteration }} <span class="text-danger">*</span></label>
                <input id="song_{{ $loop->iteration }}" value="{{ $song->name }}" class="form-control" type="text" disabled readonly>
            </div>
        </div>
    </div>
    @endforeach

    <form method="POST" action="{{ route('songs.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12" id="input-container">
                <div class="form-group">
                    <label for="song_{{ $nextSongNum }}" class="control-label">Song {{ $nextSongNum }} <span class="text-danger">*</span></label>
                    <input id="song_{{ $nextSongNum }}" name="songs[]" class="form-control" type="text">
                </div>
            </div>
        </div>
        <div class="m-t-20 text-center">
            <button class="btn btn-default">Submit</button>
            <a style="margin-left: 10px;" href="{{ url('song-info/create') }}" class="btn btn-default">Next</a>
        </div>
    </form>
@endsection

@push('post-js')
    <script>
        let nextSongNum = '{{ $nextSongNum + 1 }}';
	    $(document).on('click', '#add_input', function() {
		    $('#input-container').append(
                '<div class="form-group">' +
                    '<label for="song_'+nextSongNum+'" class="control-label">Song '+nextSongNum+'</label>' +
                    '<input id="song_'+nextSongNum+'" name="songs[]" class="form-control" type="text">' +
				'</div>'
            );
		    nextSongNum++;
	    })
    </script>
@endpush