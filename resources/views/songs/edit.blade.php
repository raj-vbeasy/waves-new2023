@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Edit Song</h4>
        </div>
    </div>

    <form method="POST" action="{{ route('songs.update', $song->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="song" class="control-label">Song <span class="text-danger">*</span></label>
                    <input id="song" name="song" class="form-control" type="text" value="{{ old('song', $song->name) }}">
                </div>
            </div>
        </div>
        <div class="m-t-20 text-center">
            <button class="btn btn-default">Update</button>
        </div>
    </form>
@endsection