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
                
                <div class="col-md-12">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h4>{{ trans('multi-leng.a205') }} <strong class="statusval">{{ $text }}</strong></h4>
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
                                                <label for="preg1b" class="textlabel"><b>{{ trans('multi-leng.a105')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ __('multi-leng.a106') }}" id="preg1b" name="preg1b" rows="15" value="" maxlength="1500" readonly>{{ $answ[0]->preg1et3 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda1b" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg2b" class="textlabel"><b>{{ trans('multi-leng.a107')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ __('multi-leng.a108') }}" id="preg2b" name="preg2b" rows="15" maxlength="1500" readonly>{{ $answ[0]->preg2et3 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda2b" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3b" class="textlabel"><b>{{ trans('multi-leng.a109')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ __('multi-leng.a110') }}" id="preg3b" name="preg3b" rows="15" maxlength="1500" readonly>{{ $answ[0]->preg3et3 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda3b" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label class="textlabel"><b>{{ trans('multi-leng.a111')}}</b></label>
                                                
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla2">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('multi-leng.a20')}}</th>
                                                            <th>{{ trans('multi-leng.formerror79')}}</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable2">
                                                        @foreach($files as $file)
                                                        <tr>
                                                            <td> {{ $file->dirfile }} </td>
                                                            <td> {{ $file->descripcion}} </td>
                                                            <td>
                                                                <a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/docentes/{{ $file->dirfile }}' role='button' download='{{ $file->dirfile }}'>{{__('multi-leng.a39')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
                                                                <a href="{{ route('imprimr-formulario-docente', Crypt::encrypt($answ[0]->idansw)) }}" role="button" id="imprimir" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a204')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
        
    });
    
    
</script>
@endsection
