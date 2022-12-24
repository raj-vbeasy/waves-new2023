@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Song Assets</h4>

            <p>“Please make sure the minimum upload quality is a Wav 44.1 kHz 16 bit (64kbps/channel) stereo”</p>

            
        </div>
    </div>

    <form method="POST" action="{{ route('song-assets.update', $assets) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="song" class="control-label">Song Name <span class="text-danger">*</span></label>
                    <input id="song" class="form-control" type="text" value="{{ $assets->song->name }}" disabled>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="full_track" class="control-label">Full track</label>
                    <input id="full_track" name="full_track" class="form-control" type="file">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="instrumental" class="control-label">Instrumental</label>
                    <input id="instrumental" name="instrumental" class="form-control" type="file">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="clean" class="control-label">Clean</label>
                    <input id="clean" name="clean" class="form-control" type="file">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="steam" class="control-label">Stems</label>
                    <input id="steam" name="steam" class="form-control" type="file">
                </div>
            </div>
        </div>
        <div class="m-t-20 text-center">
            <button type="submit" class="btn btn-default">Update</button>
        </div>
    </form>
@endsection