@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Promos Assets</h4>
        </div>
    </div>

    <form method="POST" action="{{ route('save-promo-assets') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="bio" class="control-label">
                        Bio
                        @if(false && !empty($assets))
                            {!! $assets->bio ? '<a target="_blank" href="https://drive.google.com/open?id='.$assets->bio.'">(Drive Link)</a>' : '' !!}
                        @endif
                    </label>
                    <input id="bio" name="bio" class="form-control" type="file">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="one_sheet" class="control-label">
                        One Sheet
                        @if(false && !empty($assets))
                            {!! $assets->one_sheet ? '<a target="_blank" href="https://drive.google.com/open?id='.$assets->one_sheet.'">(Drive Link)</a>' : '' !!}
                        @endif
                    </label>
                    <input id="one_sheet" name="one_sheet" class="form-control" type="file">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="promo_pics" class="control-label">
                        Promo Pics
                        @if(false && !empty($assets))
                            @if(!empty($assets->promo_pics))
                                @foreach($assets->promo_pics as $promoPic)
                                    @if($loop->first)(@endif
                                    <a target="_blank" href="https://drive.google.com/open?id={{ $promoPic }}">
                                        Drive Link {{ $loop->last ? '' : ',' }}
                                    </a>
                                    @if($loop->last))@endif
                                @endforeach
                            @endif
                        @endif
                    </label>
                    <input id="promo_pics" name="promo_pics[]" class="form-control" multiple type="file">
                </div>
            </div>
        </div>
        <div class="m-t-20 text-center">
            <button type="submit" class="btn btn-default">Update</button>
            <a style="margin-left: 10px;" href="{{ url('social-links') }}" class="btn btn-default">Next</a>
        </div>
    </form>
@endsection