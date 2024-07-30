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
        font-size:14px !important;
    }
    .textarea1 {
        min-height:270px !important;height:100%;width:100%;
    }
    .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 3px 7px !important;
    vertical-align: middle;
    }
    caption{
        color:#fff;
        caption-side: top;
        font-size:16px;
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
                                            <h5>{{ trans('multi-leng.a115')}}</h5>
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel"><b>{{ trans('multi-leng.a116')}}</b></label>
                                                <table class="table table-bordered table-sm" id="tablainicio" style="background-color:#fff;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="row">Ítem</th>
                                                            <th scope="row">Total ($)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="input-sm" scope="row">
                                                                {{ trans('multi-leng.a117')}}
                                                            </th>
                                                            <td class="input-sm">
                                                                <input class="form-control form-control1 input-sm tab1" data-col="valor1"  id="valor1et4" name="valor1et4" type="text" maxlength="8" value="{{ $sumper }}" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                {{ trans('multi-leng.a118')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm tab1" data-col="valor2"  id="valor2et4" name="valor2et4" type="text" maxlength="8" value="{{ $sumcom }}" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                {{ trans('multi-leng.a119')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm tab1" data-col="valor3"  id="valor3et4" name="valor3et4" type="text" maxlength="8" value="{{ $sumfun }}" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                {{ trans('multi-leng.a120')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm tab1" data-col="valor4"  id="valor4et4" name="valor4et4" type="text" maxlength="8" value="{{ $sumotr }}" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                {{ trans('multi-leng.a121')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm" id="valor5et4" name="valor5et4" type="text" value="{{ $sumper + $sumcom + $sumfun + $sumotr }}" disabled>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3et4" class="textlabel"><b>{{ trans('multi-leng.a122')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a185') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablaper">
                                                    <caption>{{ trans('multi-leng.a117')}}</caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablaper">
                                                        @foreach($tablaper as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablaper">
                                                        <tr>
                                                            <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                            <th scope="col" class="text-center">$ {{ $sumper }}</th>
                                                        </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                <hr class="pt-3 mt-5" style="border-top: 1px solid #fff;">
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablacom">
                                                    <caption>{{ trans('multi-leng.a118')}}</caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablacom">
                                                        @foreach($tablacom as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablacom">
                                                            <tr>
                                                                <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                                <th scope="col" class="text-center">$ {{ $sumcom }}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                <hr class="pt-3 mt-5" style="border-top: 1px solid #fff;">
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablafun">
                                                    <caption>{{ trans('multi-leng.a119')}}</caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablafun">
                                                        @foreach($tablafun as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablafun">
                                                            <tr>
                                                                <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                                <th scope="col" class="text-center">$ {{ $sumfun }}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                <hr class="pt-3 mt-5" style="border-top: 1px solid #fff;">
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablaotr">
                                                    <caption>{{ trans('multi-leng.a120')}}</caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablaotr">
                                                        @foreach($tablaotr as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablaotr">
                                                            <tr>
                                                                <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                                <th scope="col" class="text-center">$ {{ $sumotr }}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3et4" class="textlabel"><b>{{ trans('multi-leng.a125')}}</b></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a126')}}" id="preg3et4" name="preg3et4" rows="15" maxlength="1500" disabled>{{ $answ[0]['preg3et4'] }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda1c" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label class="textlabel"><b>{{ __('multi-leng.a186') }}</b></label>
                                               
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla2">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th>{{ trans('multi-leng.a20')}}</th>
                                                            <th>{{ trans('multi-leng.formerror79')}}</th>
                                                            <th>{{ trans('multi-leng.formerror50')}}</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable2">
                                                        @foreach($files as $file)
                                                        <tr>
                                                            
                                                            <td> {{ $file->dirfile }} </td>
                                                            <td> {{ $file->descripcion}} </td>
                                                            <td> {{ $file->tipofile}} </td>
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
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <a href="{{ route('ver-formulario-docente-tercera-etapa', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a104')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <a href="{{ route('imprimr-formulario-docente', Crypt::encrypt($answ[0]->idansw)) }}" role="button" id="imprimir" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a204')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <a href="{{ route('buscar-concursos-registrados-docentes' ) }}" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.lognav')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
<input type="hidden" id="valorinicial1" name="valorinicial1" value="{{ $sumper }}">
<input type="hidden" id="valorinicial2" name="valorinicial2" value="{{ $sumcom }}">
<input type="hidden" id="valorinicial3" name="valorinicial3" value="{{ $sumfun }}">
<input type="hidden" id="valorinicial4" name="valorinicial4" value="{{ $sumotr }}">
<input type="hidden" id="contda" name="contda" value="{{ $contda }}">
<input type="hidden" id="contdn" name="contdn" value="{{ $contdn }}">
@endsection

@section('extra-script')
<script type="text/javascript">
    
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('#tablaper').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            "order": false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablacom').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            "order": false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablafun').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            "order": false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablaotr').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            "order": false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tabla2').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            "order": false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        
    });
    
    
</script>
@endsection
