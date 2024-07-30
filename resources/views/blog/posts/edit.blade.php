@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')
<!-- summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    #nocat
    {
       color: red;
    }
</style>
@endsection


@section('index')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="">
                    <h3>{{ trans('multi-leng.formerror30')}}</h3>
                </div>
                <div class="card-body">
                    <form  id="formpost" method="post" action="{{ route('finalizar-edicion-publicacion-blog')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idpost" name="idpost" value="{{ Crypt::encrypt($post->id) }}">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label"><b>{{ trans('multi-leng.formerror29')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <input type="text" value="{{ $post->title }}" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="{{ trans('multi-leng.formerror29')}}" minlength="2" maxlength="70" required autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.admcat') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror31') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <select class="form-control @error('subcat') is-invalid @enderror" data-btn-class="btn-success btn-block" id="subcat" name="subcat[]" data-live-search="true" data-live-search-placeholder="{{ __('multi-leng.formerror12') }}" required autofocus>
                                   
                                    @foreach($catall as $category)
                                        @if($post->category_id == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                                @error('subcat')
                                <label id="subcat-error" class="error" for="subcat">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.formerror32') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror33') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <textarea type="text" class="form-control @error('summernote') is-invalid @enderror" name="summernote" id="summernote" placeholder="Enter Description" required="required" autofocus>{{ $post->body }}</textarea>
                                @error('summernote')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Tags</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror35') }}" data-html="true"></i></label>
                                <select class="form-control js-tags @error('tags') is-invalid @enderror" data-btn-class="btn-success btn-block" id="tags" name="tags[]" data-live-search="true" data-live-search-placeholder="{{ __('multi-leng.formerror12') }}" multiple>
                                    @foreach($arreglo as $row => $slice)
                                        <option value="{{ $arreglo[$row]['id'] }}" {{ $arreglo[$row]['tipo'] }}>{{ $arreglo[$row]['title'] }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img src="{{ $post->thumbnail ? asset('storage/blog/imagenes/'.$post->thumbnail) : asset('storage/logos/ust3.png') }}" style="width: 150px; height: auto;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.formerror36') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror37') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                                    id="thumbnail" accept=".png, .jpg, .jpeg">
                                @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('lang.editar')}}</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ trans('multi-leng.admcat')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalbody">
        ...
      </div>
      <div class="modal-footer" id="footerbody">
        
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="valavatar" name="valavatar">

@endsection

@section('extra-script')

    <!-- Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
            $('#subcat').extendSelect({
                // Search input placeholder:
                search: '{{ __('multi-leng.formerror12') }}',
                // Title if option not selected:
                notSelectedTitle: '{{ __("multi-leng.formerror10") }}',
                // Message if select list empty:
                empty: '{{ __("multi-leng.formerror11") }}',
                // Class to active element
                activeClass: 'active',
                // Class to disabled element
                disabledClass: 'disabled',
                // Custom error message for all selects (use placeholder %items)
                maxOptionMessage: 'Max %items elements',
                // Delay to hide message
                maxOptionMessageDelay: 2000,
                // Popover logic (resize or save height)
                popoverResize: true,
                // Auto resize dropdown by button width
                dropdownResize: true
            });
            let obj =  @json($arreglo);
            Object.keys(obj).forEach(key => {
                if(obj[key]['tipo'] == "selected")
                {
                    $("#tags").find('option[value="'+obj[key]['id']+'"]').prop("selected", true);
                }
                
            });
            $('#tags').extendSelect({
                // Search input placeholder:
                search: '{{ __('multi-leng.formerror12') }}',
                // Title if option not selected:
                notSelectedTitle: '{{ __("multi-leng.formerror34") }}',
                // Message if select list empty:
                empty: '{{ __("multi-leng.formerror11") }}',
                // Class to active element
                activeClass: 'active',
                // Class to disabled element
                disabledClass: 'disabled',
                // Custom error message for all selects (use placeholder %items)
                maxOptionMessage: 'Max %items elements',
                // Delay to hide message
                maxOptionMessageDelay: 2000,
                // Popover logic (resize or save height)
                popoverResize: true,
                // Auto resize dropdown by button width
                dropdownResize: true
            });
            
        });
        $('#summernote').summernote({
            placeholder: '{{ trans('multi-leng.formerror30')}}',
            tabsize: 2,
            fontNames: ['Arial', 'Arial Black', 'Calibri', 'Comic Sans MS', 'Courier New', 'Elephant', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman'],
            fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Calibri', 'Comic Sans MS', 'Courier New', 'Elephant', 'Impact', 'Tahoma', 'Times New Roman'],
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['height', ['height']],
                ['operation', ['undo', 'redo']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $( "#thumbnail" ).change(function() {
            var fileUpload = $(this)[0];
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
                if (regex.test(fileUpload.value.toLowerCase())) {
                    //Check whether HTML5 is supported.
                    if (typeof (fileUpload.files) != "undefined") {
                        //Initiate the FileReader object.
                        var reader = new FileReader();
                        //Read the contents of Image File.
                        reader.readAsDataURL(fileUpload.files[0]);
                        reader.onload = function (e) {
                            //Initiate the JavaScript Image object.
                            var image = new Image();
                            //Set the Base64 string return from FileReader as source.
                            image.src = e.target.result;
                            image.onload = function () {
                                //Determine the Height and Width.
                                var height = this.height;
                                var width = this.width;
                                if (height != 400 || width != 600) {
                                    alert("{{__('multi-leng.formerror38')}}");
                                    $( "#valavatar" ).val("{{__('multi-leng.formerror38')}}");
                                    $('#image-preview').attr('src', "{{ asset('storage/blog/imagenes/600x400.png') }}");
                                    $("#avatar").val('');
                                }
                                else{
                                    $( "#valavatar" ).val('');
                                    $('#image-preview').attr('src', e.target.result);
                                }
                            };
                        }
                    } else {
                        alert("{{__('lang.textprof2')}}");
                        $( "#valavatar" ).val("{{__('lang.textprof2')}}");
                        $('#cambiologo').attr('src', "{{ asset('storage/blog/imagenes/600x400.png') }}");
                        $("#avatar").val('');
                    }
                } else {
                    alert("{{__('lang.textprof3')}}");
                    $( "#valavatar" ).val("{{__('lang.textprof3')}}");
                    $('#cambiologo').attr('src', "{{ asset('storage/blog/imagenes/600x400.png') }}");
                    $("#avatar").val('');
                }
            });
        //image upload preview
        $("#formpost").submit(function(e){
            
            var error = "";
            if($.trim($("#title").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
            }
            if($.trim($("#valavatar").val())!= "")
            {
                error += $.trim($("#valavatar").val())+"<br>";
            }
            if($.trim($("#subcat").val()).length == 0)
            {
                error += "{{ __('multi-leng.formerror40') }}<br>";
            }
            if($.trim($("#summernote").val()).length == 0 || $.trim($("#summernote").val()) == "<br>")
            {
                error += "{{ __('multi-leng.formerror41') }}<br>";
            }
            if(error != "")
            {
                $.notify({
                        // options
                        title: '<h5><strong>{{ __("lang.perverestus") }}</strong></h5>',
                        message: '{{ __("multi-leng.formerror43") }}<br>'+
                                  error+
                                 '<br><br><br>',
                        icon: 'fa fa-exclamation-circle'
                    },{
                        // settings
                        element: 'body',
                        //position: null,
                        type: "success",
                        //allow_dismiss: true,
                        //newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        offset: 20,
                        spacing: 20,
                        z_index: 1031,
                        delay: 3300,
                        timer: 2000,
                        mouse_over: null,
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutRight'
                        },
                        onShow: null,
                        onShown: null,
                        onClose: null,
                        onClosed: null,
                        icon_type: 'class',
                    });
                return false;
            }
            else
            {
                return true;
            }
            
        });

    </script>
@endsection

