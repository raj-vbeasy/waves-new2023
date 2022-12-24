@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Song Info</h4>
        </div>
    </div>

    <form method="POST" action="{{ route('song-info.update', $songInfo) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="song_id" class="control-label">Song Name <span class="text-danger">*</span></label>
                    <input id="song_id" name="song_id" value="{{ $songInfo->song->name }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Publishing Splits (must equal 100%)</h4>
                <div class="form-group">
                    <label for="publishing_splits_name_1" class="control-label">Name</label>
                    <input id="publishing_splits_name_1" name="publishing_splits[name_1]" class="form-control" type="text" value="{{ $songInfo->publishing_splits->name_1 }}">
                </div>
                <div class="form-group">
                    <label for="publishing_splits_email_1" class="control-label">Email</label>
                    <input id="publishing_splits_email_1" name="publishing_splits[email_1]" class="form-control" type="text" value="{{ $songInfo->publishing_splits->email_1 }}">
                </div>
                <div class="form-group">
                    <label for="publishing_splits_number_1" class="control-label">Split %</label>
                    <input id="publishing_splits_number_1" name="publishing_splits[number_1]" class="form-control" type="number" max="100" min="1" value="{{ $songInfo->publishing_splits->number_1 }}">
                </div>
                <div class="form-group">
                    <label for="publishing_splits_name_2" class="control-label">Name</label>
                    <input id="publishing_splits_name_2" name="publishing_splits[name_2]" class="form-control" type="text" value="{{ $songInfo->publishing_splits->name_2 }}">
                </div>
                <div class="form-group">
                    <label for="publishing_splits_email_2" class="control-label">Email</label>
                    <input id="publishing_splits_email_2" name="publishing_splits[email_2]" class="form-control" type="text" value="{{ $songInfo->publishing_splits->email_2 }}">
                </div>
                <div class="form-group">
                    <label for="publishing_splits_number_2" class="control-label">Split %</label>
                    <input id="publishing_splits_number_2" name="publishing_splits[number_2]" class="form-control" type="number" max="100" min="1" value="{{ $songInfo->publishing_splits->number_2 }}">
                </div>
            </div>
            <div class="col-md-6">
                <h4>Master Splits (must equal 100%)</h4>
                <div class="form-group">
                    <label for="master_splits_name_1" class="control-label">Name</label>
                    <input id="master_splits_name_1" name="master_splits[name_1]" class="form-control" type="text" value="{{ $songInfo->master_splits->name_1 }}">
                </div>
                <div class="form-group">
                    <label for="master_splits_email_1" class="control-label">Email</label>
                    <input id="master_splits_email_1" name="master_splits[email_1]" class="form-control" type="text" value="{{ $songInfo->master_splits->email_1 }}">
                </div>
                <div class="form-group">
                    <label for="master_splits_number_1" class="control-label">Split %</label>
                    <input id="master_splits_number_1" name="master_splits[number_1]" class="form-control" type="number" max="100" min="1" value="{{ $songInfo->master_splits->number_1 }}">
                </div>
                <div class="form-group">
                    <label for="master_splits_name_2" class="control-label">Name</label>
                    <input id="master_splits_name_2" name="master_splits[name_2]" class="form-control" type="text" value="{{ $songInfo->master_splits->name_2 }}">
                </div>
                <div class="form-group">
                    <label for="master_splits_email_2" class="control-label">Email</label>
                    <input id="master_splits_email_2" name="master_splits[email_2]" class="form-control" type="text" value="{{ $songInfo->master_splits->email_2 }}">
                </div>
                <div class="form-group">
                    <label for="master_splits_number_2" class="control-label">Split %</label>
                    <input id="master_splits_number_2" name="master_splits[number_2]" class="form-control" type="number" max="100" min="1" value="{{ $songInfo->master_splits->number_2 }}">
                </div>
            </div>
        </div>
        <div class="m-t-20 text-center">
            <button type="submit" class="btn btn-default">Update</button>
        </div>
    </form>
@endsection