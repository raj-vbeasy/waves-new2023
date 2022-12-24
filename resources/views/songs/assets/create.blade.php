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
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Song Assets   </h4>

            <p>“Please make sure the minimum upload quality is a Wav 44.1 kHz 16 bit (64kbps/channel) stereo”</p>
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
                              id="form-assets-{{ $song->id }}"
                              action="{{ $song->assets ? route('song-assets.update', $song->assets) : route('song-assets.store') }}"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                            @if($song->assets)
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="full_track_{{ $loop->iteration }}" class="control-label">Full track</label>
                                        <input id="full_track_{{ $loop->iteration }}" name="full_track" class="form-control" type="file" accept=".wav">
                                        <div class="progress hide">
                                            <div class="progress-bar"
                                                 role="progressbar"
                                                 aria-valuenow="0"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width:0"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="instrumental_{{ $loop->iteration }}" class="control-label">Instrumental</label>
                                        <input id="instrumental_{{ $loop->iteration }}" name="instrumental" class="form-control" type="file" accept=".wav">
                                        <div class="progress hide">
                                            <div class="progress-bar"
                                                 role="progressbar"
                                                 aria-valuenow="0"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width:0"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="clean_{{ $loop->iteration }}" class="control-label">Clean</label>
                                        <input id="clean_{{ $loop->iteration }}" name="clean" class="form-control" type="file" accept=".wav">
                                        <div class="progress hide">
                                            <div class="progress-bar"
                                                 role="progressbar"
                                                 aria-valuenow="0"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width:0"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="steam_{{ $loop->iteration }}" class="control-label">Stems</label>
                                        <input id="steam_{{ $loop->iteration }}" name="steam" class="form-control" type="file" accept=".wav">
                                        <div class="progress hide">
                                            <div class="progress-bar"
                                                 role="progressbar"
                                                 aria-valuenow="0"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width:0"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="m-t-20 text-center">
            <a style="margin-left: 10px;" href="{{ url('promo-assets') }}" class="btn btn-default">Next</a>
        </div>
    </div>
@endsection

@push('post-js')
    <script>
      let isFileUploading = false;
      let panelHeading = $('.panel-group');
      $(document).ready(function () {
        function toggleIcon(e) {
          $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
        }
        panelHeading.on('hidden.bs.collapse', toggleIcon);
        panelHeading.on('shown.bs.collapse', toggleIcon);
      });

      $(window).bind('beforeunload',function(){
        if (isFileUploading === true) {
          return 'File uploading, are you sure you want to leave?';
        }
      });

      $(document).on('change', 'input[type="file"]', function (e) {
        let progressDiv = $(this).siblings('.progress');
        let progressBar = progressDiv.find('.progress-bar');
        let formObj = $(this).parents('form');
        let currentFileInput = $(this);

        let formData = new FormData();

        formData.append(currentFileInput.attr('name'), this.files[0]);
        let hiddenInputs = formObj.find('input[type="hidden"]');
        for (let i = 0; i < hiddenInputs.length; i++) {
          formData.append(hiddenInputs[i].getAttribute('name'), hiddenInputs[i].value);
        }

        let percentComplete = 0;
        $.ajax({
          xhr: function() {
            let xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                percentComplete = ((evt.loaded / evt.total) * 100);
                progressBar.css('width', percentComplete + '%');
                progressBar.attr('aria-valuenow', percentComplete);
                if (percentComplete === 100) {
                  progressBar.text('Please wait, processing file...');
                } else {
                  progressBar.text(parseInt(percentComplete)+'% uploaded ( In Progress )');
                }
              }
            }, false);
            return xhr;
          },
          type: formObj.attr('method'),
          url: formObj.attr('action'),
          data: formData,
          contentType: false,
          cache: false,
          processData:false,
          beforeSend: function(){
            isFileUploading = true;
            progressDiv.removeClass('hide');
            progressBar.removeClass('progress-bar-success');
            progressBar.removeClass('progress-bar-warning');
            progressBar.addClass('progress-bar-info');
            console.log('upload about to start');
          },
          error:function(){
            isFileUploading = false;
            currentFileInput.val('');
            progressBar.removeClass('progress-bar-success');
            progressBar.removeClass('progress-bar-info');
            progressBar.addClass('progress-bar-warning');
            console.log('error in upload');
            alert('Error in upload');
          },
          success: function(resp){
            isFileUploading = false;
            currentFileInput.val('');
            progressBar.text(percentComplete+'% ( Song Uploaded )');
            progressBar.removeClass('progress-bar-warning');
            progressBar.removeClass('progress-bar-info');
            progressBar.addClass('progress-bar-success');
            console.log('upload done, in response');
            alert('File uploaded successfully!');
          }
        });
      });
    </script>
@endpush