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
                                        <h4>{{ trans('multi-leng.a200') }} <strong class="statusval">{{ ($status->etapa2 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
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
                                                <label for="preg1a" class="textlabel"><b>{{ trans('multi-leng.a94')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a95') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a95')}}" id="preg1a" name="preg1a" rows="15" maxlength="1500">{{ $answ[0]->preg1et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda1" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg2a" class="textlabel"><b>{{ trans('multi-leng.a96')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a97') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a97')}}" id="preg2a" name="preg2a" rows="15" maxlength="500">{{ $answ[0]->preg2et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda2" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3a" class="textlabel"><b>{{ trans('multi-leng.a98')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a99') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a99')}}" id="preg3a" id="preg3a" rows="15" maxlength="1500">{{ $answ[0]->preg3et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda3" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg4a" class="textlabel"><b>{{ trans('multi-leng.a100')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a101') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a101')}}" id="preg4a" name="preg4a" rows="15" maxlength="1500">{{ $answ[0]->preg4et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda4" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg5a" class="textlabel"><b>{{ trans('multi-leng.a102')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a103') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a103')}}" id="preg5a" id="preg5a" rows="15" maxlength="1500">{{ $answ[0]->preg5et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda5" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <a href="{{ route('ver-formulario-docente-primera-etapa', Crypt::encrypt($answ[0]->idansw) )  }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a104')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <button type="button" id="validardatos" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a87')}} {{ trans('multi-leng.a149')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <a href="{{ route('buscar-concursos-registrados-docentes' ) }}" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.lognav')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                                <a href="{{ route('ver-formulario-docente-tercera-etapa', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a88')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
                                        <h4>{{ trans('multi-leng.a200') }} <strong class="statusval">{{ ($status->etapa2 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
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
@endsection

@section('extra-script')
<script type="text/javascript">
    
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        function ocultar() {
            $('#alert').css('display', 'none');
        }
        setTimeout(ocultar, 13000);
        $('#alert').focus();  
        
    });
    $('#mensaje_ayuda1').text('1500 {{ trans('multi-leng.a58')}}');
    $('#mensaje_ayuda2').text('500 {{ trans('multi-leng.a58')}}');
    $('#mensaje_ayuda3').text('1500 {{ trans('multi-leng.a58')}}');
    $('#mensaje_ayuda4').text('1500 {{ trans('multi-leng.a58')}}');
    $('#mensaje_ayuda5').text('1500 {{ trans('multi-leng.a58')}}');
    $('#preg1a').keyup(function () {
        var max = 1500;
        var len = $(this).val().length;
        if (len >= max) {
            $('#mensaje_ayuda1').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda1').addClass('text-danger');                  
        } 
        else {
            var ch2 = max - len;
            $('#mensaje_ayuda1').text(ch2 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda1').removeClass('text-danger');
            actualizardatos($(this).val(), "preg1et2", "answ", 0, 0, 0);

        }
    });
    $('#preg2a').keyup(function () {
        var max2 = 500;
        var len2 = $(this).val().length;
        if (len2 >= max2) {
            $('#mensaje_ayuda2').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda2').addClass('text-danger');                  
        } 
        else {
            var ch = max2 - len2;
            $('#mensaje_ayuda2').text(ch + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda2').removeClass('text-danger');  
            actualizardatos($(this).val(), "preg2et2", "answ", 0, 0, 0);       
        }
    });
    $('#preg3a').keyup(function () {
        var max3 = 1500;
        var len3 = $(this).val().length;
        if (len3 >= max3) {
            $('#mensaje_ayuda3').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda3').addClass('text-danger');                  
        } 
        else {
            var ch3 = max3 - len3;
            $('#mensaje_ayuda3').text(ch3 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda3').removeClass('text-danger');
            actualizardatos($(this).val(), "preg3et2", "answ", 0, 0, 0);         
        }
    });
    $('#preg4a').keyup(function () {
        var max4 = 1500;
        var len4 = $(this).val().length;
        if (len4 >= max4) {
            $('#mensaje_ayuda4').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda4').addClass('text-danger');                  
        } 
        else {
            var ch4 = max4 - len4;
            $('#mensaje_ayuda4').text(ch4 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda4').removeClass('text-danger'); 
            actualizardatos($(this).val(), "preg4et2", "answ", 0, 0, 0);        
        }
    });
    $('#preg5a').keyup(function () {
        var max5 = 1500;
        var len5 = $(this).val().length;
        if (len5 >= max5) {
            $('#mensaje_ayuda5').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda5').addClass('text-danger');                  
        } 
        else {
            var ch5 = max5 - len5;
            $('#mensaje_ayuda5').text(ch5 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda5').removeClass('text-danger'); 
            actualizardatos($(this).val(), "preg5et2", "answ", 0, 0, 0);        
        }
    });

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
            url: '{{url("/")}}/actualizar-formulario-postulacion-docente-etapa-dos',
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
                    $('#modalbody').html(`<strong>{{ trans('multi-leng.a148')}}</strong>`);
                    $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
                    $('#staticBackdrop').modal('show');
                }
                
            }
        });
    }
    $(document).on('click','#validardatos',function(e){
        let error = "";
        console.log("val2", $("#preg1a").val());
        if($.trim($("#preg1a").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a141')}}</strong><br>";
        }
        if($.trim($("#preg2a").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a142')}}</strong><br>";
        }
        if($.trim($("#preg3a").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a143')}}</strong><br>";
        }
        if($.trim($("#preg4a").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a144')}}</strong><br>";
        }
        if($.trim($("#preg5a").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a145')}}</strong><br>";
        }
        if(error != "")
        {
            $('#staticBackdropLabel').html('{{ trans('multi-leng.a146')}}');
            $('#modalbody').html(`{{ trans('multi-leng.a147')}} <br>${error}`);
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
