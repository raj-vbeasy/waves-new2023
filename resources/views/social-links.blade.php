@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Social Links</h4>
        </div>
    </div>

    <form method="POST" action="{{ route('save-social-links') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="facebook" class="control-label">Facebook</label>
                    <input id="facebook" name="facebook" class="form-control" type="text" value="{{ old('facebook', $socialLinks ? $socialLinks->facebook : '') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="twitter" class="control-label">Twitter</label>
                    <input id="twitter" name="twitter" class="form-control" type="text" value="{{ old('twitter', $socialLinks ? $socialLinks->twitter : '') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="instagram" class="control-label">Instagram</label>
                    <input id="instagram" name="instagram" class="form-control" type="text" value="{{ old('instagram', $socialLinks ? $socialLinks->instagram : '') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="website" class="control-label">Website</label>
                    <input id="website" name="website" class="form-control" type="text" value="{{ old('website', $socialLinks ? $socialLinks->website : '') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="spotify" class="control-label">Spotify</label>
                    <input id="spotify" name="spotify" class="form-control" type="text" value="{{ old('spotify', $socialLinks ? $socialLinks->spotify : '') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="apple_music" class="control-label">Apple Music</label>
                    <input id="apple_music" name="apple_music" class="form-control" type="text" value="{{ old('apple_music', $socialLinks ? $socialLinks->apple_music : '') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="sound_cloud" class="control-label">SoundCloud</label>
                    <input id="sound_cloud" name="sound_cloud" class="form-control" type="text" value="{{ old('sound_cloud', $socialLinks ? $socialLinks->sound_cloud : '') }}">
                </div>
            </div>
        </div>
        <div class="m-t-20 text-center">
            <button type="submit" class="btn btn-default">Update</button>
        </div>
    </form>
@endsection