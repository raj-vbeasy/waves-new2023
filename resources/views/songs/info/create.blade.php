@extends('layouts.app')

@push('post-css')
    <style>
        .panel-group .panel {
            border-radius: 0;
            box-shadow: none;
            border-color: #EEEEEE;
        }
        .panel-default > .panel-heading {
            padding: 0;
            border-radius: 0;
            color: #212121;
            background-color: #FAFAFA;
            border-color: #EEEEEE;
        }
        .panel-title {
            font-size: 14px;
        }

        .panel-title > a {
            display: block;
            padding: 15px;
            text-decoration: none;
        }
        .more-less {
            float: right;
            color: #212121;
        }
        .panel-default > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #EEEEEE;
        }
        .bg-gray {
            background-color: #eee;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Splits</h4>
        </div>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach($songs as $song)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading-{{ $song->id }}">
                    <h4 class="panel-title">
                        <a role="button"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapse-{{ $song->id }}"
                           aria-expanded="true"
                           aria-controls="collapse-{{ $song->id }}">
                            <i class="more-less glyphicon glyphicon-plus"></i>
                            {{ $song->name }}
                        </a>
                    </h4>
                </div>
                <div id="collapse-{{ $song->id }}"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="heading-{{ $song->id }}">
                    <div class="panel-body">
                        <form method="POST"
                              id="form-info-{{ $song->id }}"
                              action="{{ $song->info ? route('song-info.update', $song->info) : route('song-info.store') }}" onsubmit="return validateForm(this)">
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                            <input type="hidden" name="total_publishing_split" value="0">
                            <input type="hidden" name="total_master_split" value="0">
                            @if($song->info)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6 publishing-splits">
                                    <h4>Publishing Splits (must equal 100%)</h4>
                                    @if($song->info)
                                        @foreach($song->info->publishing_splits as $publishingSplit)
                                            <div class="form-group">
                                                <label for="publishing_splits_name_1" class="control-label">Name</label>
                                                <input id="publishing_splits_name_1"
                                                       required
                                                       name="publishing_splits[{{ $loop->iteration }}][name]"
                                                       class="form-control bg-gray"
                                                       value="{{ $publishingSplit->name }}"
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="publishing_splits_email_1" class="control-label">Email</label>
                                                <input id="publishing_splits_email_1"
                                                       required
                                                       name="publishing_splits[{{ $loop->iteration }}][email]"
                                                       class="form-control bg-gray"
                                                       value="{{ $publishingSplit->email }}"
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="publishing_splits_number_1" class="control-label">Split %</label>
                                                <input id="publishing_splits_number_1"
                                                       required
                                                       name="publishing_splits[{{ $loop->iteration }}][number]"
                                                       class="form-control bg-gray"
                                                       type="number"
                                                       value="{{ $publishingSplit->number }}"
                                                       max="100"
                                                       step="0.1"
                                                       min="0">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="form-group">
                                            <label for="publishing_splits_name_1" class="control-label">Name</label>
                                            <input id="publishing_splits_name_1" required name="publishing_splits[0][name]" class="form-control" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="publishing_splits_email_1" class="control-label">Email</label>
                                            <input id="publishing_splits_email_1" required name="publishing_splits[0][email]" class="form-control" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="publishing_splits_number_1" class="control-label">Split %</label>
                                            <input id="publishing_splits_number_1" required name="publishing_splits[0][number]" class="form-control" type="number" max="100" step="0.1" min="0">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 master-splits">
                                    <h4>Master Splits (must equal 100%)</h4>
                                    @if($song->info)
                                        @foreach($song->info->master_splits as $masterSplit)
                                            <div class="form-group">
                                                <label for="master_splits_name_1" class="control-label">Name</label>
                                                <input id="master_splits_name_1"
                                                       required
                                                       name="master_splits[{{ $loop->iteration }}][name]"
                                                       value="{{ $masterSplit->name }}"
                                                       class="form-control bg-gray"
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="master_splits_email_1" class="control-label">Email</label>
                                                <input id="master_splits_email_1"
                                                       required
                                                       name="master_splits[{{ $loop->iteration }}][email]"
                                                       class="form-control bg-gray"
                                                       value="{{ $masterSplit->email }}"
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="master_splits_number_1" class="control-label">Split %</label>
                                                <input id="master_splits_number_1"
                                                       required
                                                       name="master_splits[{{ $loop->iteration }}][number]"
                                                       class="form-control bg-gray"
                                                       type="number"
                                                       value="{{ $masterSplit->number }}"
                                                       max="100"
                                                       step="0.1"
                                                       min="0">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="form-group">
                                            <label for="master_splits_name_1" class="control-label">Name</label>
                                            <input id="master_splits_name_1" required name="master_splits[0][name]" class="form-control" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="master_splits_email_1" class="control-label">Email</label>
                                            <input id="master_splits_email_1" required name="master_splits[0][email]" class="form-control" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="master_splits_number_1" class="control-label">Split %</label>
                                            <input id="master_splits_number_1" required name="master_splits[0][number]" class="form-control" type="number" max="100" step="0.1" min="0">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="javascript:void(0)" class="btn btn-outline-success add_input"><i class="fa fa-plus-square"></i></a>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-default">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="m-t-20 text-center">
            <a style="margin-left: 10px;" href="{{ url('song-assets/create') }}" class="btn btn-default">Next</a>
        </div>
    </div>
@endsection

@push('post-js')
    <script>
        $(document).ready(function () {
	        function toggleIcon(e) {
		        $(e.target)
			        .prev('.panel-heading')
			        .find(".more-less")
			        .toggleClass('glyphicon-plus glyphicon-minus');
	        }
	        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
	        $('.panel-group').on('shown.bs.collapse', toggleIcon);
        });

        $(document).on('click', '.add_input', function() {
        	let publishingSplitsLength = $(this).parents('form').find('.publishing-splits').length;
        	publishingSplitsLength++;
	        $(this).parents('form').find('.publishing-splits').append(
	        	'<hr>' +
	        	'<div class="form-group">' +
                    '<label for="publishing_splits_name_'+publishingSplitsLength+'" class="control-label">Name</label>' +
		            '<input id="publishing_splits_name_'+publishingSplitsLength+'" required name="publishing_splits['+publishingSplitsLength+'][name]" class="form-control" type="text" value="n/a">' +
		        '</div>' +
                '<div class="form-group">' +
                    '<label for="publishing_splits_email_'+publishingSplitsLength+'" class="control-label">Email</label>' +
                    '<input id="publishing_splits_email_'+publishingSplitsLength+'" required name="publishing_splits['+publishingSplitsLength+'][email]" class="form-control" type="text" value="n/a">' +
                '</div>' +
		        '<div class="form-group">' +
		            '<label for="publishing_splits_number_'+publishingSplitsLength+'" class="control-label">Split %</label>' +
		            '<input id="publishing_splits_number_'+publishingSplitsLength+'" required name="publishing_splits['+publishingSplitsLength+'][number]" class="form-control" type="number" max="100" step="0.1" min="0" value="0">' +
		        '</div>'
	        );
	        let masterSplitsLength = $(this).parents('form').find('.master-splits').length;
	        masterSplitsLength++;

	        $(this).parents('form').find('.master-splits').append(
		        '<hr>' +
	        	'<div class="form-group">' +
		            '<label for="master_splits_name_'+masterSplitsLength+'" class="control-label">Name</label>' +
		            '<input id="master_splits_name_'+masterSplitsLength+'" required name="master_splits['+masterSplitsLength+'][name]"  class="form-control" type="text" value="n/a">' +
		        '</div>' +
                '<div class="form-group">' +
                    '<label for="master_splits_email_'+masterSplitsLength+'" class="control-label">Email</label>' +
                    '<input id="master_splits_email_'+masterSplitsLength+'" required name="master_splits['+masterSplitsLength+'][email]"  class="form-control" type="text" value="n/a">' +
                '</div>' +
		        '<div class="form-group">' +
		            '<label for="master_splits_number_'+masterSplitsLength+'" class="control-label">Split %</label>' +
		            '<input id="master_splits_number_'+masterSplitsLength+'" required name="master_splits['+masterSplitsLength+'][number]" class="form-control" type="number" max="100" min="0" step="0.1" value="0">' +
		        '</div>'
            );
        });

        function validateForm(obj) {
        	obj = $(obj);
        	let pSplits = 0;
        	obj.find('input[id^="publishing_splits_number_"]').each(function () {
        		pSplits = pSplits + Number($(this).val());
            });

        	let mSplits = 0;
	        obj.find('input[id^="master_splits_number_"]').each(function () {
		        mSplits = mSplits + Number($(this).val());
	        });

	        if ((pSplits !== 100) && (mSplits) !== 100) {
		        alert('Publishing and Master splits should be 100%');
		        return false;
            } else {
		        if (pSplits !== 100) {
			        alert('Publishing splits should be 100%');
			        return false;
		        }
		        if (mSplits !== 100) {
			        alert('Master splits should be 100%');
			        return false;
		        }
            }
        	return true;
        }
    </script>
@endpush