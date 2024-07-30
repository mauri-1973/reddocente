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
                                                <label for="preg1a" class="textlabel"><b>{{ trans('multi-leng.a94')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a95')}}" id="preg1a" name="preg1a" rows="15" maxlength="1500" readonly>{{ $answ[0]->preg1et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda1" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg2a" class="textlabel"><b>{{ trans('multi-leng.a96')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a97')}}" id="preg2a" name="preg2a" rows="15" maxlength="500" readonly>{{ $answ[0]->preg2et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda2" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3a" class="textlabel"><b>{{ trans('multi-leng.a98')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a99')}}" id="preg3a" id="preg3a" rows="15" maxlength="1500" readonly>{{ $answ[0]->preg3et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda3" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg4a" class="textlabel"><b>{{ trans('multi-leng.a100')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a101')}}" id="preg4a" name="preg4a" rows="15" maxlength="1500" readonly>{{ $answ[0]->preg4et2 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda4" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg5a" class="textlabel"><b>{{ trans('multi-leng.a102')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a103')}}" id="preg5a" id="preg5a" rows="15" maxlength="1500" readonly>{{ $answ[0]->preg5et2 }}</textarea>
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
                                                                <a href="{{ route('imprimr-formulario-docente', Crypt::encrypt($answ[0]->idansw)) }}" role="button" id="imprimir" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a204')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
        
    });

    
    
</script>
@endsection
