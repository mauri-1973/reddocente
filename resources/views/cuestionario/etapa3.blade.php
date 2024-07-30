@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')
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
    .textlabel{
        font-size:18px !important;
        color:#fff;
    }
    .form-control
    {
        font-size:18px !important;
    }
    .form-control1
    {
        font-size:12px !important;
    }
    .textarea1 {
        min-height:270px !important;height:100%;width:100%;
    }
    .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 3px 7px !important;
    vertical-align: middle;
    }
    .dataTables_filter input {
    color: white;
    background-color: black;
    }
    .dataTables_wrapper .dataTables_info {
        color: #fff; !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: white !important;
        border: 1px solid #fff!important;
        background-color: #fff!important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #fff))!important;
        background: -webkit-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: -moz-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: -ms-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: -o-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: linear-gradient(to bottom, #fff 0%, #fff 100%)!important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: white !important;
        border: 1px solid #fff!important;
        background-color: #fff!important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #fff))!important;
        background: -webkit-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: -moz-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: -ms-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: -o-linear-gradient(top, #fff 0%, #fff 100%)!important;
        background: linear-gradient(to bottom, #fff 0%, #fff 100%)!important;
    }
</style>
@endsection
@section('index')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="row justify-content-center mt-4">
                <div class="alert alert-success bg-success" {{ trans('multi-leng.a177')}}" role="alert" id="alert">
                    <h4 class="alert-heading">{{ trans('multi-leng.formerror46')}}:</h4>
                    <p style="font-size:16px;">{{ trans('multi-leng.a177')}}</p>
                    <hr>
                    <p style="font-size:16px;" class="mb-0">{{ trans('multi-leng.a178')}}</p>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h4>{{ trans('multi-leng.a199') }} <strong class="statusval">{{ ($status->etapa3 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="author text-white mb-5">
                                            <h3>{{ trans('multi-leng.a42')}}</h3>
                                        </div>
                                        <div class="author text-white mb-3">
                                            <h5>{{ trans('multi-leng.a93')}} </h5>
                                        </div>
                                       
                                        <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg1b" class="textlabel"><b>{{ trans('multi-leng.a105')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a106') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ __('multi-leng.a106') }}" id="preg1b" name="preg1b" rows="15" value="" maxlength="1500">{{ $answ[0]->preg1et3 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda1b" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg2b" class="textlabel"><b>{{ trans('multi-leng.a107')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a108') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ __('multi-leng.a108') }}" id="preg2b" name="preg2b" rows="15" maxlength="1500">{{ $answ[0]->preg2et3 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda2b" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3b" class="textlabel"><b>{{ trans('multi-leng.a109')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a110') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ __('multi-leng.a110') }}" id="preg3b" name="preg3b" rows="15" maxlength="1500">{{ $answ[0]->preg3et3 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda3b" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label class="textlabel"><b>{{ trans('multi-leng.a111')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a114') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <div class="container-fluid mb-4">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            
                                                            <a class='btn btn-light btn-sm text-success btn-block' href='{{url('/')}}/storage/descargables/plantilla_cronograma.docx' role='button' download='plantilla_cronograma.docx' style="background-color:#fff;font-size:12px;">{{ __('multi-leng.a112') }}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button type="button" class="btn btn-light btn-sm text-success btn-block" style="background-color:#fff;font-size:12px;" onclick="addcat();">{{ __('multi-leng.a113') }}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla2">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ trans('multi-leng.a20')}}</th>
                                                            <th>{{ trans('multi-leng.formerror79')}}</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable2">
                                                        @foreach($files as $file)
                                                        <tr>
                                                            <td> {{ $file->idanswfile }} </td>
                                                            <td> {{ $file->dirfile }} </td>
                                                            <td> {{ $file->descripcion}} </td>
                                                            <td>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block deletefile mb-1' onclick='senddelete({{ $file->idanswfile }}, "{{ $file->dirfile }}")'>{{__('multi-leng.a38')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button><a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/docentes/{{ $file->dirfile }}' role='button' download='{{ $file->dirfile }}'>{{__('multi-leng.a39')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </td>
                                                        </tr>
                                                       @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <a href="{{ route('ver-formulario-docente-segunda-etapa', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a104')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <button id="validardatos" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a87')}} {{ trans('multi-leng.a155')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <a href="{{ route('buscar-concursos-registrados-docentes' ) }}" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.lognav')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <a href="{{ route('ver-formulario-docente-cuarta-etapa', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a88')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <hr style="border-top: 3px solid #fff;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-t-2 border-gray-600">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h4>{{ trans('multi-leng.a199') }} <strong class="statusval">{{ ($status->etapa3 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
<input type="hidden" id="idconc" name="idconc" value="{{ $idconcurso }}">
<input type="hidden" id="idpost" name="idpost" value="{{ $idpostulacion }}">
<input type="hidden" id="idansw" name="idansw" value="{{ $idansw }}">

<input type="hidden" id="countfile" name="countfile" value="{{ $countfiles }}">
<input type="hidden" id="desctextdoc" name="desctextdoc">
@endsection

@section('extra-script')
<script type="text/javascript">
    
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('#tabla2').DataTable({
            //"dom": 'lfrtip'
            "dom": 'frtip', 
            fixedHeader: true,
            responsive: true,      
            "order": [[ 1, "desc" ]],
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        function ocultar() {
            $('#alert').css('display', 'none');
        }
        setTimeout(ocultar, 13000);
        $('#alert').focus(); 
        
    });
    $('#mensaje_ayuda1b').text('1500 {{ trans('multi-leng.a58')}}');
    $('#mensaje_ayuda2b').text('1500 {{ trans('multi-leng.a58')}}');
    $('#mensaje_ayuda3b').text('1500 {{ trans('multi-leng.a58')}}');
    $('#preg1b').keyup(function () {
        var max = 1500;
        var len = $(this).val().length;
        if (len >= max) {
            $('#mensaje_ayuda1b').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda1b').addClass('text-danger');                  
        } 
        else {
            var ch2 = max - len;
            $('#mensaje_ayuda1b').text(ch2 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda1b').removeClass('text-danger');
            actualizardatos($(this).val(), "preg1et3", "answ", 0, 0, 0);         
        }
    });
    $('#preg2b').keyup(function () {
        var max2 = 1500;
        var len2 = $(this).val().length;
        if (len2 >= max2) {
            $('#mensaje_ayuda2b').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda2b').addClass('text-danger');                  
        } 
        else {
            var ch = max2 - len2;
            $('#mensaje_ayuda2b').text(ch + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda2b').removeClass('text-danger');  
            actualizardatos($(this).val(), "preg2et3", "answ", 0, 0, 0);       
        }
    });
    $('#preg3b').keyup(function () {
        var max3 = 1500;
        var len3 = $(this).val().length;
        if (len3 >= max3) {
            $('#mensaje_ayuda3b').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda3b').addClass('text-danger');                  
        } 
        else {
            var ch3 = max3 - len3;
            $('#mensaje_ayuda3b').text(ch3 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda3b').removeClass('text-danger'); 
            actualizardatos($(this).val(), "preg3et3", "answ", 0, 0, 0);        
        }
    });
    function addcat()
    {
        $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.a24')}}");
        $( "#modalbody" ).html('<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror26')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a36") }}" data-html="true"></i></label><input type="text" class="form-control" name="textdocs" id="textdocs" maxlength="20"><small id="errortextfile" style="color:red"></small></div><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.a23')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a114") }}" data-html="true"></i></label><input type="file" class="form-control" name="docs" id="docs" accept=".png, .jpg, .jpeg, .pdf, .xlsx"><small id="errorfile" style="color:red"></small></div>');
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
                    var filePath = fileUpload.value;
                    var allowedExtensions = /(.jpg|.png|.jpeg|.xlsx|.pdf)$/i;
                    if(!allowedExtensions.exec(filePath))
                    {
                        $("#errorfile").html("{{__('lang.textprof3')}}");
                        $("#docs").val('');
                    }
                    else
                    {
                        //Check whether HTML5 is supported.
                        if (typeof (fileUpload.files) != "undefined") 
                        {
                            
                            const fileInput = document.querySelector('#docs');
                            const file = fileInput.files[0];
                            actualizardatos(file, $("#textdocs").val(), "file", 0, 0, 0);
                        } 
                        else 
                        {
                            $("#errorfile").html("{{__('lang.textprof2')}}");
                            $("#docs").val('');
                        }
                    }
                }
            }
            
            
        });
    });
    
    function senddelete(id, name)
    {
        $( "#staticBackdropLabel" ).html("{{ trans('lang.eliminar')}}");
        $( "#modalbody" ).html(`<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror9')}}</b></label><input type="text" class="form-control" name="deldocs" id="deldocs" value="${name}" readonly><button type="button" class="btn btn-danger btn-sm" onclick="validardelete(${id}, '${name}')">{{ trans('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></div>`);
        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
        $( "#staticBackdrop" ).modal('show');
    }
    function validardelete(id, nombre)
    {
        actualizardatos(id, nombre, "delete", 0, 0, 0);
    }

    function actualizardatos(val, col, type, tipo, data, data1)
    {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData();
        formData.append("idconc", $("#idconc").val());
        formData.append("idpost", $("#idpost").val());
        formData.append("idansw", $("#idansw").val());
        formData.append("value", val);
        formData.append("col", col);
        formData.append("type", type);
        formData.append("tipo", tipo);
        formData.append("data", data);
        formData.append("data1", data1);
        $.ajax({
            type: "POST",
            url: '{{url("/")}}/actualizar-formulario-postulacion-docente-etapa-tres',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(respu)
            {
                console.log(respu.status);
                if(type == "val")
                {
                    $('.statusval').html('{{ trans('multi-leng.a197')}}');
                    $('#staticBackdropLabel').html('{{ trans('multi-leng.a146')}}');
                    $('#modalbody').html(`<strong>{{ trans('multi-leng.a156')}}</strong>`);
                    $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
                    $('#staticBackdrop').modal('show');
                }
                else if(type == "file" || "delete")
                {
                    var table = $('#tabla2').DataTable();
                    var table_length = parseInt(table.data().count()) + 1;
                    $('#tabla2').DataTable().destroy();
                    let tr = "";
                    Object.keys(respu.files).forEach(key => {

                        tr += `<tr><td> ${respu.files[key]['idanswfile']}</td><td>${respu.files[key]['dirfile']}</td><td>${respu.files[key]['descripcion']}</td><td><button type='button' class='btn btn-danger btn-sm btn-block deletefile mb-1' onclick='senddelete(${respu.files[key]['idanswfile']}, "${respu.files[key]['dirfile']}")'>{{__('multi-leng.a38')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button><a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/docentes/${respu.files[key]['dirfile']}' role='button' download='${respu.files[key]['dirfile']}'>{{__('multi-leng.a39')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a></td>></tr>`;

                        
                    });

                    $("#tbodytable2").html(tr);
                    $('#tabla2').DataTable({
                        //"dom": 'lfrtip'
                        "dom": 'frtip', 
                        fixedHeader: true,
                        responsive: true,      
                        "order": [[ 1, "desc" ]],
                        "language": {
                            "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                        }
                    });
                    $( "#countfile" ).val(respu.countfiles);
                    $( "#staticBackdrop" ).modal('hide');
                }
                else
                {
                    console.log(respu.status);
                }
                
            }
        });
    }
    $(document).on('click','#validardatos',function(e){
        let error = "";
        if($.trim($("#preg1b").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a151')}}</strong><br>";
        }
        if($.trim($("#preg2b").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a152')}}</strong><br>";
        }
        if($.trim($("#preg3b").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a153')}}</strong><br>";
        }
        if($("#countfile").val()== 0)
        {
            error += "<strong>{{ trans('multi-leng.a154')}}</strong><br>";
        }
        if(error != "")
        {
            $('#staticBackdropLabel').html('{{ trans('multi-leng.a163')}}');
            $('#modalbody').html(`{{ trans('multi-leng.a161')}} <br>${error}`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        else
        {
            
            actualizardatos(1, 0, "val", 0, 0, 0);
        }
        
    });
    
</script>
@endsection
