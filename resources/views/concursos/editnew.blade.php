@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')
<!-- summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<style>
    img.note-float-left
    {
        margin:20px;
    }
    img.note-float-right
    {
        margin:20px;
    }
    #nocat
    {
       color: red;
    }
    .datepick {
  width: 50%;
}
</style>
@endsection


@section('index')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="">
                    <h3>{{ trans('lang.editar')}} {{ trans('multi-leng.a1')}} (
                        @if($post->is_published == 2)
                        on-line
                        @endif
                        @if($post->is_published == 1)
                        {{ trans('multi-leng.a40')}}
                        @endif
                        @if($post->is_published == 0)
                        off-line
                        @endif
                        )
                    </h3>
                </div>
                <div class="card-body m-0 p-0">
                    @role('revisor')
                        <a href="{{ route('ver-publicaciones-blog') }}" class="btn btn-success btn-sm">
                            {{ trans('lang.volver')}}
                        </a>
                    @endrole
                    @role('admin')
                        <a href="{{ route('buscar-concursos-registrados-administradores') }}" class="btn btn-success btn-sm">
                            {{ trans('lang.volver')}}
                        </a>
                    @endrole
                </div>
                <div class="card-body">
                    @if(count($catall) == 0)
                    <h5 style="color:red;">{{ trans('multi-leng.a18')}}</h5><a class="btn btn-primary btn-sm" href="{{url('')}}/agregar-nuevas-categorias-concursos" role="button">{{ trans('multi-leng.formerror224')}}</a>
                    @else
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label"><b>{{ trans('multi-leng.formerror29')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <input type="text"  class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="{{ trans('multi-leng.formerror29')}}" value="{{ $post->title }}" minlength="2" maxlength="70" required autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.admcat') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a19') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <select class="form-control @error('subcat') is-invalid @enderror" data-btn-class="btn-success btn-block" id="subcat" name="subcat[]" data-live-search="true" data-live-search-placeholder="{{ __('multi-leng.formerror12') }}" required autofocus>
                                    @foreach($arreglocat as $category => $key)
                                        @if($arreglocat[$category]['id'] != 6)
                                        <option value="{{ $arreglocat[$category]['id'] }}" {{ $arreglocat[$category]['tipo']}}>
                                            {{ $arreglocat[$category]['title']}}
                                        </option>
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
                                @if($post->thumbnail == "")
                                <img src="{{ asset('storage/adjuntos/') }}/600x400.png" id="image-preview" style="max-height: 150px;">
                                @else
                                <img src="{{ asset('storage/adjuntos/') }}/{{ $post->thumbnail  }}" id="image-preview" style="max-height: 150px;">
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.formerror36') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a28') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                                    id="thumbnail" accept=".png, .jpg, .jpeg">
                                @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.a16') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a26') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                    <input class="form-control" type="text" id="dateon" name="dateon" readonly />
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true" style="font-size:34px"></i></span>
                                </div>
                                @error('dateon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>{{ __('multi-leng.a17') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a27') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                <div id="datepicker2" class="input-group date" data-date-format="dd-mm-yyyy">
                                    <input class="form-control" type="text" id="dateoff" name="dateoff" readonly />
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true" style="font-size:34px"></i></span>
                                </div>
                                @error('dateoff')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><b>{{ __('multi-leng.a23') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a25') }}" data-html="true"></i>&nbsp;</label>
                            <br>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addcat();">{{ trans('multi-leng.a24')}}</button>
                            <div class="card-body">
                                <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('multi-leng.a20')}}</th>
                                        <th>{{ trans('multi-leng.formerror79')}}</th>
                                        <th>{{ trans('multi-leng.formerror22')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodytable">
                                    @foreach($files as $file)
                                    <tr><td> {{$file->idfile}}</td><td>{{$file->filename}}</td><td>{{$file->descripcion}}</td><td><button type='button' class='btn btn-danger btn-sm btn-block deletefile mb-1' onclick='senddelete({{$file->idfile}}, "{{$file->filename}}")'>{{__('multi-leng.a38')}}</button><a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/files/{{$file->filename}}' role='button' download='{{$file->filename}}'>{{__('multi-leng.a39')}}</a></td></tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-warning btn-sm" id="validadatosform">{{ trans('lang.enviar')}}</button>
                            
                        </div>
                    @endif
                    
                </div>
                
            </div>
            <div class="card-body m-0 p-0">
                @role('revisor')
                    <a href="{{ route('ver-publicaciones-blog') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
                @role('admin')
                    <a href="{{ route('buscar-concursos-registrados-administradores') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
            </div>
        </div>
    </div>
</div>
<form  id="formpostnew" method="post" action="{{ route('finalizar-ingreso-concurso-administrador')}}" enctype="multipart/form-data" style="display:none">
     @csrf
    <input type="hidden" name="idconval" id="idconval" value="{{ $idnew }}">
    <button type="submit" class="btn btn-warning btn-sm" id="btnsubmit" style="display:none">{{ trans('lang.enviar')}}</button>
</form>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ trans('multi-leng.a24')}}</h5>
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
<input type="hidden" id="valid" name="valid" value="{{ $post->idcomp  }}">
<input type="hidden" id="desctextdoc" name="desctextdoc">

@endsection

@section('extra-script')

    <!-- Summernote -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).ready(function() {
            console.log(new Date());
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
            let obj =  @json($arreglocat);
            Object.keys(obj).forEach(key => {
                if(obj[key]['id'] == 6)
                {
                    if(obj[key]['tipo'] == "selected")
                    {
                        $("#subcat").find('option[value="'+obj[key]['id']+'"]').prop("selected", true);
                    }
                }
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
            let obj1 =  @json($arreglo);
            Object.keys(obj1).forEach(key => {
                
                if(obj1[key]['tipo'] == "selected")
                {
                    $("#tags").find('option[value="'+obj1[key]['id']+'"]').prop("selected", true);
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
            $('#dt-mant-table').DataTable({
                //"dom": 'lfrtip'
                "dom": 'frtip', 
                fixedHeader: true,
                responsive: true,      
                "order": [[ 2, "desc" ]],
                "language": {
                    "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                }
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
            ],
            callbacks: {
                    onChange: function() {
                        actualizardatos($('#summernote').summernote('code'), 3);
                    }
                  }
        });
        $( "#thumbnail" ).change(function() {
            var fileUpload = $(this)[0];
            if(fileUpload.size > 9000000)
            {
                alert("{{__('multi-leng.a21')}}");
                $( "#valavatar" ).val("{{__('multi-leng.a21')}}");
                $('#cambiologo').attr('src', "{{ asset('storage/blog/imagenes/600x400.png') }}");
                $("#avatar").val('');
            }
            else
            {
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
                                    actualizardatos($(this).val(), 5);

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
            }
            
        });
        //image upload preview
        $("#formpost").submit(function(e){
            
            var error = "";
            var dateon = $("#datepicker").datepicker("getDate");
            var dateoff = $("#datepicker2").datepicker("getDate");
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
            if ($('#thumbnail').get(0).files.length === 0) 
            {
                error += "{{ __('multi-leng.formerror42') }}<br>";
            }
            if(dateon  == "Invalid Date")
            {
                error += "{{ __('multi-leng.a30') }}<br>";
            }
            if(dateoff  == "Invalid Date")
            {
                error += "{{ __('multi-leng.a31') }}<br>";
            }
            if(dateon  != "Invalid Date" && dateoff  != "Invalid Date" && (dateon.getTime() > dateoff.getTime()))
            {
                error += "{{ __('multi-leng.a32') }}<br>";
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
                $('input[name="idconval"]').val($("#valid").val());
                document.getElementById('formpost').submit();
            }
            
        });
        $(function () {
            $.fn.datepicker.dates['es'] = {
                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                today: 'Hoy',
                clear: 'Limpiar',
                format: 'dd/mm/yy',
                titleFormat: "MM yyyy", 
                weekStart: 1
            };
            
            /*$("#datepicker").datepicker({
                language: 'es', 
                autoclose: true, 
                todayHighlight: true,
            }).datepicker('update', new Date()).change(function() {
            var dateTime = new Date($(this).datepicker("getDate"));
            var strDateTime = dateTime.getFullYear()  + "-" + (dateTime.getMonth()+1) + "-" + dateTime.getDate() + " 00:00:00";
            actualizardatos(strDateTime, 6);
            });*/
            $("#datepicker").datepicker({
                language: 'es', 
                autoclose: true, 
                todayHighlight: true,
            })
            @if($post->date_on == "" || $post->date_on == null)
            .datepicker('setDate', null)
            @else
            .datepicker('update', new Date( "{{ date('D M d Y H:i:s O', strtotime($post->date_on)) }} "))
            @endif
            .change(function() {
                
                var dateTime = new Date($(this).datepicker("getDate"));
                var strDateTime = dateTime.getFullYear()  + "-" + (dateTime.getMonth()+1) + "-" + dateTime.getDate() + " 00:00:00";
                actualizardatos(strDateTime, 6);
            });
            /*$("#datepicker2").datepicker({
                language: 'es', 
                autoclose: true, 
                todayHighlight: true,
            }).datepicker('update', new Date()).change(function() {
            var dateTime = new Date($(this).datepicker("getDate"));
            var strDateTime = dateTime.getFullYear()  + "-" + (dateTime.getMonth()+1) + "-" + dateTime.getDate() + " 23:59:59";
            actualizardatos(strDateTime, 7);
            });*/
            $("#datepicker2").datepicker({
                language: 'es', 
                autoclose: true, 
                todayHighlight: true,
            })
            @if($post->date_off == "" || $post->date_off == null)
            .datepicker('setDate', null)
            @else
            .datepicker('update', new Date( "{{ date('D M d Y H:i:s O', strtotime($post->date_off)) }} "))
            @endif
            .change(function() {
            var dateTime = new Date($(this).datepicker("getDate"));
            var strDateTime = dateTime.getFullYear()  + "-" + (dateTime.getMonth()+1) + "-" + dateTime.getDate() + " 23:59:59";
            actualizardatos(strDateTime, 7);
            });
        });

        $("#title").keyup(function(){
            if($.trim($(this).val().length) > 0)
            {
                actualizardatos($(this).val(), 1);
            }
        });
        
        $("#subcat").change(function(){
            actualizardatos($(this).val(), 2);
        });

        $(".note-editable").keyup(function(){
            actualizardatos($(this).html(), 3);
        });
        

        $("#tags").change(function(){
            actualizardatos($(this).val(), 4);
        });
        
        function actualizardatos(val, type)
        {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData();
            formData.append("id", $("#valid").val());
            if(type == 1 || type == 2 || type == 3 || type == 4 || type == 6 || type == 7 || type == 8)
            {
                formData.append("value", val);
                
            }
            if(type == 8)
            {
                formData.append("value", val);
                formData.append("desc", $("#desctextdoc").val());
                
            }
            
            if(type == 5)
            {
                const fileInput = document.querySelector('#thumbnail');
                const file = fileInput.files[0];

                // Append the file directly to a FormData object
                formData.append("value", file);
                
                
            }
            formData.append("type", type);
            formData.append("status", 1);
            $.ajax({
            type: "POST",
            url: '/actualizar-datos-concursos-administrador',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(respu){
                $("#valid").val(respu.id);

                if(type == 8)
                {
                    $("#errorfile").html("{{__('multi-leng.a22')}}");
                    $("#docs").val('');
                    $('#dt-mant-table').DataTable().destroy();
                    $("#tbodytable").html('');
                    var tr = "";
                    Object.keys(respu.files).forEach(key => {

                        tr += `<tr><td> ${respu.files[key]['idfile']}</td><td>${respu.files[key]['filename']}</td><td>${respu.files[key]['descripcion']}</td><td><button type='button' class='btn btn-danger btn-sm btn-block deletefile mb-1' onclick='senddelete(${respu.files[key]['idfile']}, "${respu.files[key]['filename']}")'>{{__('multi-leng.a38')}}</button><a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/files/${respu.files[key]['filename']}' role='button' download='${respu.files[key]['filename']}'>{{__('multi-leng.a39')}}</a></td>></tr>`;

                        
                    });
                    $("#tbodytable").html(tr);
                    $('#dt-mant-table').DataTable({
                        //"dom": 'lfrtip'
                        "dom": 'frtip', 
                        fixedHeader: true,
                        responsive: true,      
                        "order": [[ 1, "desc" ]],
                        "language": {
                            "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                        }
                    });
                    $("#desctextdoc").val('');
                }
            }
            });
        }

        function addcat()
        {
            $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.a24')}}");
            $( "#modalbody" ).html('<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror26')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a36") }}" data-html="true"></i></label><input type="text" class="form-control" name="textdocs" id="textdocs" maxlength="20"><small id="errortextfile" style="color:red"></small></div><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.a23')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a25") }}" data-html="true"></i></label><input type="file" class="form-control" name="docs" id="docs" accept=".png, .jpg, .jpeg, .pdf, .xlsx"><small id="errorfile" style="color:red"></small></div>');
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $( "#staticBackdrop" ).modal('show');
            
        }
        $("#staticBackdrop").on('show.bs.modal', function() { 
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
            $("#docs").change(function(){
                $("#errorfile").html('');
                $("#errortextfile").html('');

                if($.trim($("#textdocs").val()).length < 3)
                {
                    $("#errortextfile").html("{{__('multi-leng.a37')}}");
                    $("#docs").val('');
                }
                else
                {
                    var fileUpload = $(this)[0];
                    if(fileUpload.size > 9000000)
                    {
                        $("#errorfile").html("{{__('multi-leng.a21')}}");
                        $("#docs").val('');
                    }
                    else
                    {
                        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg|.xlsx|.pdf)$");
                        if (regex.test(fileUpload.value.toLowerCase())) 
                        {
                            //Check whether HTML5 is supported.
                            if (typeof (fileUpload.files) != "undefined") 
                            {
                                
                                const fileInput = document.querySelector('#docs');
                                const file = fileInput.files[0];
                                $("#desctextdoc").val($("#textdocs").val());
                                actualizardatos(file, 8);
                            } 
                            else 
                            {
                                $("#errorfile").html("{{__('lang.textprof2')}}");
                                $("#docs").val('');
                            }
                        } 
                        else 
                        {
                            $("#errorfile").html("{{__('lang.textprof3')}}");
                            $("#docs").val('');
                        }
                    }
                }
                
                
            });
        });

        function senddelete(id, name)
        {
            $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.a24')}}");
            $( "#modalbody" ).html(`<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror9')}}</b></label><input type="text" class="form-control" name="deldocs" id="deldocs" value="${name}" readonly><button type="button" class="btn btn-danger btn-sm" onclick="validardelete(${id}, '${name}')">{{ trans('lang.eliminar')}}</button></div>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $( "#staticBackdrop" ).modal('show');
        }

        function validardelete(id, name)
        {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData();
                formData.append("id", id);
                formData.append("name", name);
                formData.append("idcon", $("#valid").val());
                $.ajax({
                type: "POST",
                url: '/eliminar-archivos-adjuntos-concursos-administrador',
                data: formData,
                processData: false,
                contentType: false,  
                dataType: "JSON",
                success: function(respu)
                {

                    
                    $('#dt-mant-table').DataTable().destroy();
                    $("#tbodytable").html('');
                    var tr = "";
                    Object.keys(respu.files).forEach(key => {

                        tr += `<tr><td> ${respu.files[key]['idfile']}</td><td>${respu.files[key]['filename']}</td><td>${respu.files[key]['descripcion']}</td><td><button type='button' class='btn btn-danger btn-sm btn-block deletefile mb-1' onclick='senddelete(${respu.files[key]['idfile']}, "${respu.files[key]['filename']}")'>{{__('multi-leng.a38')}}</button><a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/files/${respu.files[key]['filename']}' role='button' download='${respu.files[key]['filename']}'>{{__('multi-leng.a39')}}</a></td>></tr>`;

                        
                    });
                    $("#tbodytable").html(tr);
                    $('#dt-mant-table').DataTable({
                        //"dom": 'lfrtip'
                        "dom": 'frtip', 
                        fixedHeader: true,
                        responsive: true,      
                        "order": [[ 1, "desc" ]],
                        "language": {
                            "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                        }
                    });
                    $( "#staticBackdrop" ).modal('hide');
                }
            });
        }
        $(document).on('click','#validadatosform',function(e){
            var error = "";
            var dateon = $("#datepicker").datepicker("getDate");
            var dateoff = $("#datepicker2").datepicker("getDate");
            if($.trim($("#title").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
            }
            if($.trim($("#valavatar").val())!= "")
            {
                error += $.trim($("#valavatar").val())+"<br>";
            }
            if($.trim($("#subcat").val()).length == 0 || $.trim($("#subcat").val()) == 0)
            {
                error += "{{ __('multi-leng.formerror40') }}<br>";
            }
            if($.trim($("#summernote").val()).length == 0 || $.trim($("#summernote").val()) == "<br>")
            {
                error += "{{ __('multi-leng.formerror41') }}<br>";
            }
            if ($('#thumbnail').get(0).files.length === 0) 
            {
                error += "{{ __('multi-leng.formerror42') }}<br>";
            }
            if(dateon  == "Invalid Date")
            {
                error += "{{ __('multi-leng.a30') }}<br>";
            }
            if(dateoff  == "Invalid Date")
            {
                error += "{{ __('multi-leng.a31') }}<br>";
            }
            if(dateon  != "Invalid Date" && dateoff  != "Invalid Date" && (dateon.getTime() > dateoff.getTime()))
            {
                error += "{{ __('multi-leng.a32') }}<br>";
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
                //$('input[name="idconval"]').val($("#valid").val());
                
                $("#btnsubmit").click();
            }
        });

    </script>
@endsection

