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
                                        <h4>{{ trans('multi-leng.a196') }} <strong class="statusval">{{ ($status->etapa4 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <a href="{{ route('imprimr-formulario-docente-observaciones', Crypt::encrypt($correc)) }}" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.a249')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <a href="{{ route('ver-observaciones-docente-nueva-ventana', Crypt::encrypt($correc)) }}" target="_blank" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.a255')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <caption>{{ trans('multi-leng.a117')}} &nbsp;<button type="button" onclick="completaritem(1, 0, '', 0, 0,  '{{ trans('multi-leng.a117')}}')" class="btn btn-success btn-sm text-success btn-sm bg-white" id="additembtn" style="font-size:12px;">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablaper">
                                                        @foreach($tablaper as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            <td>
                                                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritem(2, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a117')}}' )">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritem(3, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a117')}}' )">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablaper">
                                                        <tr>
                                                            <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                            <th scope="col" class="text-center">$ {{ $sumper }}</th>
                                                            <td>
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                <hr class="pt-3 mt-5" style="border-top: 1px solid #fff;">
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablacom">
                                                    <caption>{{ trans('multi-leng.a118')}} &nbsp;<button type="button" onclick="completaritemcom(1, 0, '', 0, 0,  '{{ trans('multi-leng.a118')}}')" class="btn btn-success btn-sm text-success btn-sm bg-white" id="additembtncom" style="font-size:12px;">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablacom">
                                                        @foreach($tablacom as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            <td>
                                                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritemcom(2, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a118')}}' )">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritemcom(3, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a118')}}' )">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablacom">
                                                            <tr>
                                                                <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                                <th scope="col" class="text-center">$ {{ $sumcom }}</th>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                <hr class="pt-3 mt-5" style="border-top: 1px solid #fff;">
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablafun">
                                                    <caption>{{ trans('multi-leng.a119')}} &nbsp;<button type="button" onclick="completaritemfun(1, 0, '', 0, 0,  '{{ trans('multi-leng.a119')}}')" class="btn btn-success btn-sm text-success btn-sm bg-white" id="additembtnfun" style="font-size:12px;">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablafun">
                                                        @foreach($tablafun as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            <td>
                                                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritemfun(2, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a119')}}' )">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritemfun(3, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a119')}}' )">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablafun">
                                                            <tr>
                                                                <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                                <th scope="col" class="text-center">$ {{ $sumfun }}</th>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                <hr class="pt-3 mt-5" style="border-top: 1px solid #fff;">
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tablaotr">
                                                    <caption>{{ trans('multi-leng.a120')}} &nbsp;<button type="button" onclick="completaritemotr(1, 0, '', 0, 0,  '{{ trans('multi-leng.a120')}}')" class="btn btn-success btn-sm text-success btn-sm bg-white" id="additembtnotr" style="font-size:12px;">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></caption>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.formerror26')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a123')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a124')}}</th>
                                                            <th scope="col">Total ($)</th>
                                                            <th>{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodytablaotr">
                                                        @foreach($tablaotr as $tabla)
                                                        <tr>
                                                            
                                                            <th scope="col">{{ $tabla->descri }}</th>
                                                            <td class="text-center">{{ $tabla->valor1 }}</td>
                                                            <td class="text-center">{{ $tabla->valor2 }}</td>
                                                            <td class="text-center">{{ $tabla->valor1 * $tabla->valor2 }}</td>
                                                            <td>
                                                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritemotr(2, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a120')}}' )">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritemotr(3, {{ $tabla->iddetres }}, '{{ $tabla->descri }}', {{ $tabla->valor1  }}, {{ $tabla->valor2 }}, '{{ trans('multi-leng.a120')}}' )">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                        <tfoot id="tfoottablaotr">
                                                            <tr>
                                                                <th colspan="3" scope="col">ITEM {{ trans('multi-leng.a121')}} </th>
                                                                <th scope="col" class="text-center">$ {{ $sumotr }}</th>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg3et4" class="textlabel"><b>{{ trans('multi-leng.a125')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a126') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a126')}}" id="preg3et4" name="preg3et4" rows="15" maxlength="1500">{{ $answ[0]['preg3et4'] }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda1c" class="help-block" style="color:#fff;"></p>
                                                </span>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label class="textlabel"><b>{{ __('multi-leng.a186') }}</b></label>
                                                <div class="container-fluid mb-4">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-white">
                                                            <div style="height:55px;">{{ __('multi-leng.a187') }}&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a191') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></div>
                                                            <button type="button" class="btn btn-light btn-sm text-success btn-block" style="background-color:#fff;font-size:12px;" onclick="addcat(1);">{{ __('multi-leng.a188') }}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-white">
                                                            <div style="height:55px;">{{ __('multi-leng.a189') }}&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a191') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></div>
                                                            <button type="button" class="btn btn-light btn-sm text-success btn-block" style="background-color:#fff;font-size:12px;" onclick="addcat(2);">{{ __('multi-leng.a188') }}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-white">
                                                            <div style="height:55px;">{{ __('multi-leng.a190') }}&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a192') }}" data-html="true"></i></div>
                                                            <button type="button" class="btn btn-light btn-sm text-success btn-block" style="background-color:#fff;font-size:12px;" onclick="addcat(3);">{{ __('multi-leng.a113') }}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                            <a href="{{ route('ver-formulario-docente-tercera-etapa', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a104')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                            <button id="validardatos" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a87')}} {{ trans('multi-leng.a157')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                            <button id="finalizarpost" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.a127')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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
                <div class="col-md-12">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h4>{{ trans('multi-leng.a196') }} <strong class="statusval">{{ ($status->etapa4 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
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
        function ocultar() {
            $('#alert').css('display', 'none');
        }
        setTimeout(ocultar, 13000);
        $('#alert').focus();
        
    });
    $('#mensaje_ayuda1c').text('1500 {{ trans('multi-leng.a58')}}');
    $('#preg3et4').keyup(function () {
        var max = 1500;
        var len = $(this).val().length;
        if (len >= max) 
        {
            $('#mensaje_ayuda1c').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda1c').addClass('text-danger');                  
        } 
        else 
        {
            var ch2 = max - len;
            $('#mensaje_ayuda1c').text(ch2 + ' {{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda1c').removeClass('text-danger');
            actualizardatos($(this).val(), 0, 0, "answ", 0, 0);         
        }
    });

    function completaritem(item, id, des, val1, val2, title)
    {
        if(item == 1)
        {
            $('#staticBackdropLabel').html(`{{ trans('multi-leng.formerror227')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailind" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 2)
        {
            $('#staticBackdropLabel').html(`{{ trans('lang.editar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailind" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 3)
        { 
            $('#staticBackdropLabel').html(`{{ trans('lang.eliminar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" disabled>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}" disabled>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}" disabled>
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailind" class="btn btn-danger btn-sm btn-block" type="button">{{ trans('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        
    }
    function completaritemcom(item, id, des, val1, val2, title)
    {
        if(item == 1)
        {
            $('#staticBackdropLabel').html(`{{ trans('multi-leng.formerror227')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindcom" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 2)
        {
            $('#staticBackdropLabel').html(`{{ trans('lang.editar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindcom" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 3)
        { 
            $('#staticBackdropLabel').html(`{{ trans('lang.eliminar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" disabled>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}" disabled>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}" disabled>
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindcom" class="btn btn-danger btn-sm btn-block" type="button">{{ trans('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        
    }
    function completaritemfun(item, id, des, val1, val2, title)
    {
        if(item == 1)
        {
            $('#staticBackdropLabel').html(`{{ trans('multi-leng.formerror227')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindfun" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 2)
        {
            $('#staticBackdropLabel').html(`{{ trans('lang.editar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindfun" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 3)
        { 
            $('#staticBackdropLabel').html(`{{ trans('lang.eliminar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" disabled>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}" disabled>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}" disabled>
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindfun" class="btn btn-danger btn-sm btn-block" type="button">{{ trans('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        
    }
    function completaritemotr(item, id, des, val1, val2, title)
    {
        if(item == 1)
        {
            $('#staticBackdropLabel').html(`{{ trans('multi-leng.formerror227')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindotr" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('multi-leng.formerror227')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 2)
        {
            $('#staticBackdropLabel').html(`{{ trans('lang.editar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}">
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}">
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindotr" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        if(item == 3)
        { 
            $('#staticBackdropLabel').html(`{{ trans('lang.eliminar')}} ${title}`); 
            $('#modalbody').html(`<form>
                                        <input type="hidden" id="item" name="item" value="${item}">
                                        <input type="hidden" id="idtab" name="idtab" value="${id}">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.formerror26')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" name="desc" id="desc" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" value="${des}" disabled>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a123')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="cant" name="cant" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val1}" disabled>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a124')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a128') }}" data-html="true"></i></label>
                                            <input type="text" class="form-control" id="unit" name="unit" minlength="1" placeholder="0" maxlength="8" onkeypress="return valideKeycel(event);" value="${val2}" disabled>
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="adddetailindotr" class="btn btn-danger btn-sm btn-block" type="button">{{ trans('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        
    }
    function addcat(tipo)
    {
        if(tipo == 1)
        {
            $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.a24')}}");
            $( "#modalbody" ).html(`<div class="form-group">
                                        <label for="textdocs"><b>{{ trans('multi-leng.formerror26')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a36") }}" data-html="true"></i></label>
                                        <input type="text" class="form-control" name="textdocs" id="textdocs" maxlength="30">
                                        <small id="errortextfile" style="color:red"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="docs"><b>{{ trans('multi-leng.a23')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a191") }}" data-html="true"></i></label>
                                        <input type="file" class="form-control" name="docs" id="docs" accept=".pdf, .docx">
                                        <small id="errorfile" style="color:red"></small>
                                    </div>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $( "#staticBackdrop" ).modal('show');
        }

        if(tipo == 2)
        {
            $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.a24')}}");
            $( "#modalbody" ).html(`<div class="form-group">
                                        <label for="textdocs"><b>{{ trans('multi-leng.formerror26')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a36") }}" data-html="true"></i></label>
                                        <input type="text" class="form-control" name="textdocs" id="textdocs" maxlength="30">
                                        <small id="errortextfile" style="color:red"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="docs1"><b>{{ trans('multi-leng.a23')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a191") }}" data-html="true"></i></label>
                                        <input type="file" class="form-control" name="docs1" id="docs1" accept=".pdf, .docx">
                                        <small id="errorfile" style="color:red"></small>
                                    </div>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $( "#staticBackdrop" ).modal('show');
        }

        if(tipo == 3)
        {
            $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.a24')}}");
            $( "#modalbody" ).html(`<div class="form-group">
                                        <label for="textdocs"><b>{{ trans('multi-leng.formerror26')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a36") }}" data-html="true"></i></label>
                                        <input type="text" class="form-control" name="textdocs" id="textdocs" maxlength="30">
                                        <small id="errortextfile" style="color:red"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="docs2"><b>{{ trans('multi-leng.a23')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __("multi-leng.a191") }}" data-html="true"></i></label>
                                        <input type="file" class="form-control" name="docs2" id="docs2" accept=".pdf, .docx">
                                        <small id="errorfile" style="color:red"></small>
                                    </div>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $( "#staticBackdrop" ).modal('show');
        }
        
        
    }

    function valideKeycel(evt)
    {
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) 
        {
            return true;
        }
        else if(code>=48 && code<=57) 
        { 
            return true;
        } 
        else
        {
            return false;
        }
    }

    $("#staticBackdrop").on('show.bs.modal', function() { 
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        

        $(document).on('click','#adddetailind',function(e){
            let error = "";
            let cant, unit, desc;
            desc = $.trim($("#desc").val());
            cant = parseInt($("#cant").val());
            $("#cant").val(parseInt($("#cant").val()));
            unit = parseInt($("#unit").val());
            $("#unit").val(parseInt($("#unit").val()));

            $("#mensaje1").html('');
            $("#mensaje2").html('');
            $("#mensaje3").html('');
            let val1, val2, val3, val4, totacu, idtab;
            if(desc.length < 2)
            {
                error += "{{ __('multi-leng.a182') }}<br>";
                $("#mensaje1").html('{{ __('multi-leng.a89') }}');
            }
            if(cant <= 0)
            {
                error += "{{ __('multi-leng.a183') }}<br>";
                $("#mensaje2").html('{{ __('multi-leng.a89') }}');
            }
            if(unit <= 0)
            {
                error += "{{ __('multi-leng.a184') }}<br>";
                $("#mensaje3").html('{{ __('multi-leng.a89') }}');
            }
            if(error != '')
            {
                return false;
            }
            else
            {
                $("#additembtn").prop("disabled", true);
                $("#adddetailind").prop("disabled", true);
                actualizardatos(desc, cant, unit, "additems", $("#idtab").val(), $("#item").val());
            }
        });
        $(document).on('click','#adddetailindcom',function(e){
            let error = "";
            let cant, unit, desc;
            desc = $.trim($("#desc").val());
            cant = parseInt($("#cant").val());
            $("#cant").val(parseInt($("#cant").val()));
            unit = parseInt($("#unit").val());
            $("#unit").val(parseInt($("#unit").val()));

            $("#mensaje1").html('');
            $("#mensaje2").html('');
            $("#mensaje3").html('');
            let val1, val2, val3, val4, totacu, idtab;
            if(desc.length < 2)
            {
                error += "{{ __('multi-leng.a182') }}<br>";
                $("#mensaje1").html('{{ __('multi-leng.a89') }}');
            }
            if(cant <= 0)
            {
                error += "{{ __('multi-leng.a183') }}<br>";
                $("#mensaje2").html('{{ __('multi-leng.a89') }}');
            }
            if(unit <= 0)
            {
                error += "{{ __('multi-leng.a184') }}<br>";
                $("#mensaje3").html('{{ __('multi-leng.a89') }}');
            }
            if(error != '')
            {
                return false;
            }
            else
            {
                $("#additembtncom").prop("disabled", true);
                $("#adddetailindcom").prop("disabled", true);
                actualizardatos(desc, cant, unit, "additemscom", $("#idtab").val(), $("#item").val());
            }
        });
        $(document).on('click','#adddetailindfun',function(e){
            let error = "";
            let cant, unit, desc;
            desc = $.trim($("#desc").val());
            cant = parseInt($("#cant").val());
            $("#cant").val(parseInt($("#cant").val()));
            unit = parseInt($("#unit").val());
            $("#unit").val(parseInt($("#unit").val()));

            $("#mensaje1").html('');
            $("#mensaje2").html('');
            $("#mensaje3").html('');
            let val1, val2, val3, val4, totacu, idtab;
            if(desc.length < 2)
            {
                error += "{{ __('multi-leng.a182') }}<br>";
                $("#mensaje1").html('{{ __('multi-leng.a89') }}');
            }
            if(cant <= 0)
            {
                error += "{{ __('multi-leng.a183') }}<br>";
                $("#mensaje2").html('{{ __('multi-leng.a89') }}');
            }
            if(unit <= 0)
            {
                error += "{{ __('multi-leng.a184') }}<br>";
                $("#mensaje3").html('{{ __('multi-leng.a89') }}');
            }
            if(error != '')
            {
                return false;
            }
            else
            {
                $("#additembtnfun").prop("disabled", true);
                $("#adddetailindfun").prop("disabled", true);
                actualizardatos(desc, cant, unit, "additemsfun", $("#idtab").val(), $("#item").val());
            }
        });
        $(document).on('click','#adddetailindotr',function(e){
            let error = "";
            let cant, unit, desc;
            desc = $.trim($("#desc").val());
            cant = parseInt($("#cant").val());
            $("#cant").val(parseInt($("#cant").val()));
            unit = parseInt($("#unit").val());
            $("#unit").val(parseInt($("#unit").val()));

            $("#mensaje1").html('');
            $("#mensaje2").html('');
            $("#mensaje3").html('');
            let val1, val2, val3, val4, totacu, idtab;
            if(desc.length < 2)
            {
                error += "{{ __('multi-leng.a182') }}<br>";
                $("#mensaje1").html('{{ __('multi-leng.a89') }}');
            }
            if(cant <= 0)
            {
                error += "{{ __('multi-leng.a183') }}<br>";
                $("#mensaje2").html('{{ __('multi-leng.a89') }}');
            }
            if(unit <= 0)
            {
                error += "{{ __('multi-leng.a184') }}<br>";
                $("#mensaje3").html('{{ __('multi-leng.a89') }}');
            }
            if(error != '')
            {
                return false;
            }
            else
            {
                $("#additembtnotr").prop("disabled", true);
                $("#adddetailindotr").prop("disabled", true);
                actualizardatos(desc, cant, unit, "additemsotr", $("#idtab").val(), $("#item").val());
            }
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
                    var allowedExtensions = /(.pdf|.docx)$/i;
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
                            actualizardatos(file, $("#textdocs").val(), "file", 0, 0, 1);
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
        $("#docs1").change(function(){
            $("#errorfile").html('');
            $("#errortextfile").html('');

            if($.trim($("#textdocs").val()).length < 3)
            {
                $("#errortextfile").html("{{__('multi-leng.a37')}}");
                $("#docs1").val('');
            }
            else
            {
                var fileUpload = $(this)[0];
                if(fileUpload.size > 9000000)
                {
                    $("#errorfile").html("{{__('multi-leng.a21')}}");
                    $("#docs1").val('');
                }
                else
                {
                    var filePath = fileUpload.value;
                    var allowedExtensions = /(.pdf|.docx)$/i;
                    if(!allowedExtensions.exec(filePath))
                    {
                        $("#errorfile").html("{{__('lang.textprof3')}}");
                        $("#docs1").val('');
                    }
                    else
                    {
                        //Check whether HTML5 is supported.
                        if (typeof (fileUpload.files) != "undefined") 
                        {
                            
                            const fileInput = document.querySelector('#docs1');
                            const file = fileInput.files[0];
                            actualizardatos(file, $("#textdocs").val(), "file", 0, 0, 2);
                        } 
                        else 
                        {
                            $("#errorfile").html("{{__('lang.textprof2')}}");
                            $("#docs1").val('');
                        }
                    }
                }
            }
            
            
        });
        $("#docs2").change(function(){
            $("#errorfile").html('');
            $("#errortextfile").html('');

            if($.trim($("#textdocs").val()).length < 3)
            {
                $("#errortextfile").html("{{__('multi-leng.a37')}}");
                $("#docs2").val('');
            }
            else
            {
                var fileUpload = $(this)[0];
                if(fileUpload.size > 9000000)
                {
                    $("#errorfile").html("{{__('multi-leng.a21')}}");
                    $("#docs2").val('');
                }
                else
                {
                    var filePath = fileUpload.value;
                    var allowedExtensions = /(.pdf|.docx)$/i;
                    if(!allowedExtensions.exec(filePath))
                    {
                        $("#errorfile").html("{{__('lang.textprof3')}}");
                        $("#docs2").val('');
                    }
                    else
                    {
                        //Check whether HTML5 is supported.
                        if (typeof (fileUpload.files) != "undefined") 
                        {
                            
                            const fileInput = document.querySelector('#docs2');
                            const file = fileInput.files[0];
                            actualizardatos(file, $("#textdocs").val(), "file", 0, 0, 3);
                        } 
                        else 
                        {
                            $("#errorfile").html("{{__('lang.textprof2')}}");
                            $("#docs2").val('');
                        }
                    }
                }
            }
            
            
        });
        
    });
    function actualizardatos(val, col, type, tipo, data, data1)
    {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData();
        formData.append("idansw", $("#idansw").val());
        formData.append("idpost", $("#idpost").val());
        formData.append("value", val);
        formData.append("col", col);
        formData.append("type", type);
        formData.append("tipo", tipo);
        formData.append("data", data);
        formData.append("data1", data1);
        $.ajax({
            type: "POST",
            url: '{{url("/")}}/actualizar-formulario-postulacion-docente-etapa-cuatro',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(respu)
            {
                
                if(type == "final")
                {
                    $('#finalizarpost').prop('disabled', false);
                    if(respu.status == 1)
                    {
                        window.location.href = "{{url('/')}}/redireccion-formulario-completo-docente/"+respu.id;
                    }
                    if(respu.status == 0)
                    {

                        $('.statusval').html('{{ trans('multi-leng.a197')}}');
                        $('#staticBackdropLabel').html('{{ trans('multi-leng.a164')}}');
                        $('#modalbody').html(`<strong>{{ trans('multi-leng.a169')}}</strong><br><br>${respu.error}<br><strong>{{ trans('multi-leng.a170') }}</strong>`);
                        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
                        $('#staticBackdrop').modal('show');
                    }
                    
                }
                if(type == "val")
                {
                    $('#validardatos').prop('disabled', false);
                    $('.statusval').html('{{ trans('multi-leng.a197')}}');
                    $('#staticBackdropLabel').html('{{ trans('multi-leng.a164')}}');
                    $('#modalbody').html(`<strong>{{ trans('multi-leng.a195')}}</strong>`);
                    $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
                    $('#staticBackdrop').modal('show');
                }
                else if(tipo == "additems")
                {
                    $('#tablaper').DataTable().destroy();
                    $("#bodytablaper").html('');
                    $("#tfoottablaper").html('');
                    let total, totalfinal, frase, tr;
                    frase = "{{ trans('multi-leng.a117') }}" ;
                    totalfinal = 0;
                    tr = '';
                    Object.keys(respu.datos).forEach(key => {
                        total = respu.datos[key]['valor1'] * respu.datos[key]['valor2'];
                        totalfinal = total + totalfinal;
                        tr += `<tr>
                            <td class="text-center">${respu.datos[key]['descri']}</td>
                            <td class="text-center">${respu.datos[key]['valor1']}</td>
                            <td class="text-center">${respu.datos[key]['valor2']}</td>
                            <td class="text-center">${total}</td>
                            <td class="text-center">
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritem(2, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritem(3, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
                    });
                    
                    $("#bodytablaper").html(tr);
                    $("#tfoottablaper").html(`<tr>
                                                <th colspan="3" scope="col">
                                                    ITEM {{ trans('multi-leng.a121')}} 
                                                </th>
                                                <th class="text-center" scope="col">
                                                    $ ${totalfinal}
                                                </th>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>`);
                    
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
                    
                    $("#valorinicial1").val(totalfinal);
                    $("#valor1et4").val(totalfinal);
                    $("#valor5et4").val(parseInt($("#valorinicial1").val()) + parseInt($("#valorinicial2").val()) + parseInt($("#valorinicial3").val()) + parseInt($("#valorinicial4").val()));
                    $("#additembtn").prop("disabled", false);
                    $( "#staticBackdrop" ).modal('hide');
                    
                }
                else if(tipo == "additemscom")
                {
                    $('#tablacom').DataTable().destroy();
                    $("#bodytablacom").html('');
                    $("#tfoottablacom").html('');
                    let total, totalfinal, frase, tr;
                    frase = "{{ trans('multi-leng.a118') }}" ;
                    totalfinal = 0;
                    tr = '';
                    Object.keys(respu.datos).forEach(key => {
                        total = respu.datos[key]['valor1'] * respu.datos[key]['valor2'];
                        totalfinal = total + totalfinal;
                        tr += `<tr>
                            <th scope="col">${respu.datos[key]['descri']}</th>
                            <td class="text-center">${respu.datos[key]['valor1']}</td>
                            <td class="text-center">${respu.datos[key]['valor2']}</td>
                            <td class="text-center">${total}</td>
                            <td class="text-center">
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritemcom(2, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritemcom(3, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
                    });
                    
                    $("#bodytablacom").html(tr);
                    $("#tfoottablacom").html(`<tr>
                                                <th colspan="3" scope="col">
                                                    ITEM {{ trans('multi-leng.a121')}} 
                                                </th>
                                                <th class="text-center" scope="col">
                                                    $ ${totalfinal}
                                                </th>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>`);
                    
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
                    
                    $("#valorinicial2").val(totalfinal);
                    $("#valor2et4").val(totalfinal);
                    $("#valor5et4").val(parseInt($("#valorinicial1").val()) + parseInt($("#valorinicial2").val()) + parseInt($("#valorinicial3").val()) + parseInt($("#valorinicial4").val()));
                    $("#additembtncom").prop("disabled", false);
                    $( "#staticBackdrop" ).modal('hide');
                    
                }
                else if(tipo == "additemsfun")
                {
                    $('#tablafun').DataTable().destroy();
                    $("#bodytablafun").html('');
                    $("#tfoottablafun").html('');
                    let total, totalfinal, frase, tr;
                    frase = "{{ trans('multi-leng.a119') }}" ;
                    totalfinal = 0;
                    tr = '';
                    Object.keys(respu.datos).forEach(key => {
                        total = respu.datos[key]['valor1'] * respu.datos[key]['valor2'];
                        totalfinal = total + totalfinal;
                        tr += `<tr>
                            <th scope="col">${respu.datos[key]['descri']}</th>
                            <td class="text-center">${respu.datos[key]['valor1']}</td>
                            <td class="text-center">${respu.datos[key]['valor2']}</td>
                            <td class="text-center">${total}</td>
                            <td class="text-center">
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritemfun(2, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritemfun(3, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
                    });
                    
                    $("#bodytablafun").html(tr);
                    $("#tfoottablafun").html(`<tr>
                                                <th colspan="3" scope="col">
                                                    ITEM {{ trans('multi-leng.a121')}} 
                                                </th>
                                                <th class="text-center" scope="col">
                                                    $ ${totalfinal}
                                                </th>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>`);
                    
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
                    
                    $("#valorinicial3").val(totalfinal);
                    $("#valor3et4").val(totalfinal);
                    $("#valor5et4").val(parseInt($("#valorinicial1").val()) + parseInt($("#valorinicial2").val()) + parseInt($("#valorinicial3").val()) + parseInt($("#valorinicial4").val()));
                    $("#additembtnfun").prop("disabled", false);
                    $( "#staticBackdrop" ).modal('hide');
                    
                }
                else if(tipo == "additemsotr")
                {
                    $('#tablaotr').DataTable().destroy();
                    $("#bodytablaotr").html('');
                    $("#tfoottablaotr").html('');
                    let total, totalfinal, frase, tr;
                    frase = "{{ trans('multi-leng.a120') }}" ;
                    totalfinal = 0;
                    tr = '';
                    Object.keys(respu.datos).forEach(key => {
                        total = respu.datos[key]['valor1'] * respu.datos[key]['valor2'];
                        totalfinal = total + totalfinal;
                        tr += `<tr>
                            <th scope="col">${respu.datos[key]['descri']}</th>
                            <td class="text-center">${respu.datos[key]['valor1']}</td>
                            <td class="text-center">${respu.datos[key]['valor2']}</td>
                            <td class="text-center">${total}</td>
                            <td class="text-center">
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick="completaritemotr(2, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick="completaritemotr(3, ${respu.datos[key]['iddetres']}, '${respu.datos[key]['descri']}', ${respu.datos[key]['valor1']}, ${respu.datos[key]['valor2']}, '${frase}')">{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
                    });
                    
                    $("#bodytablaotr").html(tr);
                    $("#tfoottablaotr").html(`<tr>
                                                <th colspan="3" scope="col">
                                                    ITEM {{ trans('multi-leng.a121')}} 
                                                </th>
                                                <th class="text-center" scope="col">
                                                    $ ${totalfinal}
                                                </th>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>`);
                    
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
                    
                    $("#valorinicial4").val(totalfinal);
                    $("#valor4et4").val(totalfinal);
                    $("#valor5et4").val(parseInt($("#valorinicial1").val()) + parseInt($("#valorinicial2").val()) + parseInt($("#valorinicial3").val()) + parseInt($("#valorinicial4").val()));
                    $("#additembtnotr").prop("disabled", false);
                    $( "#staticBackdrop" ).modal('hide');
                    
                }
                else if(type == "file" || type == "delete")
                {
                    
                    $('#tabla2').DataTable().destroy();
                    let tr = "";
                    Object.keys(respu.files).forEach(key => {

                        tr += `<tr><td>${respu.files[key]['dirfile']}</td><td>${respu.files[key]['descripcion']}</td><td>${respu.files[key]['tipofile']}</td><td><button type='button' class='btn btn-danger btn-sm btn-block deletefile mb-1' onclick='senddelete(${respu.files[key]['idanswfile']}, "${respu.files[key]['dirfile']}")'>{{__('multi-leng.a38')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button><a class='btn btn-success btn-sm btn-block' href='{{url('/')}}/storage/adjuntos/docentes/${respu.files[key]['dirfile']}' role='button' download='${respu.files[key]['dirfile']}'>{{__('multi-leng.a39')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a></td>></tr>`;

                        
                    });

                    $("#tbodytable2").html(tr);
                    $('#tabla2').DataTable({
                        //"dom": 'lfrtip'
                        "dom": '', 
                        fixedHeader: true,
                        responsive: true,      
                        "order": [[ 1, "desc" ]],
                        "language": {
                            "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                        }
                    });
                    $( "#contda" ).val(respu.contda);
                    $( "#contdn" ).val(respu.contdn);
                    $( "#staticBackdrop" ).modal('hide');
                }
                else
                {
                    console.log("acá", type);
                }
            }
        });
    }
    $(document).on('click','#validardatos',function(e){
        let error = "";

        if($.trim($("#preg3et4").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a158')}}</strong><br>";
        }
        if($.trim($("#valor5et4").val()).length == 0 || parseInt($("#valor5et4").val()) == 0 )
        {
            error += "<strong>{{ trans('multi-leng.a159')}}</strong><br>";
        }
        if($.trim($("#contda").val()).length == 0 || parseInt($("#contda").val()) == 0 )
        {
            error += "<strong>{{ trans('multi-leng.a193')}}</strong><br>";
        }
        if($.trim($("#contdn").val()).length == 0 || parseInt($("#contdn").val()) == 0 )
        {
            error += "<strong>{{ trans('multi-leng.a194')}}</strong><br>";
        }
        if(error != "")
        {
            $('#staticBackdropLabel').html('{{ trans('multi-leng.a164')}}');
            $('#modalbody').html(`{{ trans('multi-leng.a162')}} <br>${error}`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
        }
        else
        {
            $('#validardatos').prop('disabled', true);
            actualizardatos(1, 0, "val", 0, 0, 0);
        }
        
    });
    $(document).on('click','#finalizarpost',function(e){

        actualizardatos(0, 0, "final", 0, 0, 0);
        $('#finalizarpost').prop('disabled', true);
        
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
    
</script>
@endsection
