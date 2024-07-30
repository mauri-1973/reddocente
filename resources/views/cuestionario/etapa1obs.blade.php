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
        font-size:16px !important;
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
                                        
                                        <h4>{{ trans('multi-leng.a201') }} <strong class="statusval">{{ ($status->etapa1 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
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
                <div class="col-md-12 mb-1">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="author text-white mb-5">
                                            <h3>{{ trans('multi-leng.a42')}}</h3>
                                        </div>
                                        <div class="author text-white mb-3">
                                            <h5>{{ trans('multi-leng.a43')}}</h5>
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg1et1" class="textlabel"><b>{{ trans('multi-leng.a44')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <input class="form-control input-lg" id="preg1et1" name="preg1et1" type="text" minlength="2" maxlength="70" value="{{ $answ[0]->preg1et1 }}" placeholder="{{ trans('multi-leng.a150')}}" required>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg2et1" class="textlabel"><b>{{ trans('multi-leng.a45')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a46') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a46')}}" id="preg2et1" name="preg2et1" rows="15" maxlength="500">{{ $answ[0]->preg2et1 }}</textarea>
                                                <span class="help-block">
                                                    <p id="mensaje_ayuda" class="help-block" style="color:#fff;"></p>
                                                </span> 
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="author text-white mb-3">
                                                <h5>{{ trans('multi-leng.a47')}}</h5>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a48')}}</b>&nbsp;&nbsp;<i style="color:#fff;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a61') }}" data-html="true"></i>&nbsp; <small style="color:white;font-size:10px;">(* {{ __('lang.infoobli') }})</small></label>
                                                <table class="table table-bordered table-sm" id="tablainicio" style="background-color:#fff;">
                                                    <tbody>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a49')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td class="input-sm">
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="namedir" name="namedir" id="namedir" type="text" maxlength="70" value="{{ $dir->namedir}}"> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                RUT:&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="rutdir" id="rutdir" name="rutdir" type="text" minlength="9" maxlength="10" value="{{ $dir->rutdir }}" onkeypress="return valideKey(event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a50')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="faculdir" name="faculdir" id="faculdir" type="text" maxlength="70" value="{{ $dir->faculdir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a51')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="jordir" name="jordir" id="jordir" type="text" maxlength="70" value="{{ $dir->jordir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a52')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="tipodir" name="tipodir" id="tipodir" type="text" maxlength="70" value="{{ $dir->tipodir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a53')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="antidir" name="antidir" id="antidir" type="text" maxlength="70" value="{{ $dir->antidir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a54')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="teldir" name="teldir" id="teldir" type="text" maxlength="9" value="{{ $dir->teldir}}" onkeypress="return valideKeycel(event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a55')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="emaildir" name="emaildir" id="emaildir" type="text" maxlength="70" value="{{ $dir->emaildir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a56')}}&nbsp;&nbsp;<small style="color:black;font-size:10px;">(* {{ __('lang.infoobli') }})</small>
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="horasdir" name="horasdir" id="horasdir" type="text" maxlength="4" value="{{ $dir->horasdir}}" onkeypress="return valideKeycel(event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">{{ trans('multi-leng.a57')}}</th>
                                                            <td>
                                                                <textarea class="form-control input-lg" placeholder="Ingrese su Firma" id="preg1" rows="15" maxlength="300" disabled>
                                                                
                                                                </textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a60')}}</label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;">
                                                    <tbody>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a49')}}
                                                            </th>
                                                            <td class="input-sm">
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir }}" data-col="namedir" name="namesuddir" id="namesubdir" type="text" maxlength="70" value="{{ $subdir->namedir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                RUT:
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir }}" data-col="rutdir" name="rutsubdir" id="namedir" type="text" maxlength="10" value="{{ $subdir->rutdir}}" onkeypress="return valideKey(event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a50')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir  }}" data-col="faculdir" name="faculsubdir" id="faculsubdir" type="text" maxlength="70" value="{{ $subdir->faculdir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a51')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir }}" data-col="jordir" name="jorsubdir" id="jorsubdir" type="text" maxlength="70" value="{{ $subdir->jordir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a52')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir  }}" data-col="tipodir" name="tiposubdir" id="tiposubdir" type="text" maxlength="70" value="{{ $subdir->jordir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a53')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir  }}" data-col="antidir" name="antisubdir" id="antisubdir" type="text" maxlength="70" value="{{ $subdir->antidir}}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a54')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir }}" data-col="teldir" name="telsubdir" id="telsubdir" type="text" maxlength="9" value="{{ $subdir->teldir}}" onkeypress="return valideKeycel(event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a55')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir  }}" data-col="emaildir" name="emailsubdir" id="emailsubdir" type="text" maxlength="70" value="{{ $subdir->emaildir}}" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a56')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm subcomdir" data-id="{{ $subdir->idansdir }}" data-col="horasdir" name="horassubdir" id="horassubdir" type="text" maxlength="4" value="{{ $subdir->horasdir}}" onkeypress="return valideKeycel(event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a57')}}
                                                            </th>
                                                            <td>
                                                                <textarea class="form-control input-lg" placeholder="Ingrese su Firma" id="preg1" rows="15" maxlength="300" disabled>
                                                                
                                                                </textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a66')}} <button type="button" class="btn btn-light btn-sm text-success" style="background-color:#fff;font-size:12px;" onclick="agragarinfo(1);">{{ trans('multi-leng.a62')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.a67')}}</th>
                                                            <th scope="col">RUT</th>
                                                            <th scope="col">{{ trans('multi-leng.a54')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a55')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a68')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a69')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a70')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a71')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable1">
                                                   
                                                        @foreach($est as $se)
                                                        <tr>
                                                            
                                                            <td>{{ $se->namedir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->rutdir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->teldir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->emaildir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->tipodir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->jordir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->faculdir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->niveldir ?? 'Pendiente' }}</td>
                                                            <td>
                                                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick='editest("{{ $se->idansdir }}", "{{ $se->namedir }}", "{{ $se->rutdir }}", "{{ $se->teldir }}", "{{ $se->emaildir }}", "{{ $se->tipodir }}", "{{ $se->jordir }}", "{{ $se->faculdir }}", "{{ $se->niveldir }}")'>{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick='deleteest({{ $se->idansdir }}, "est")'>{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></td>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a85')}} <button type="button" class="btn btn-light btn-sm text-success" id="btn2" style="background-color:#fff;font-size:12px;" onclick="agragarinfo(2);">{{ trans('multi-leng.a86')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla2">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.a83')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a50')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a180') }}</th>
                                                            <th scope="col">{{ trans('multi-leng.a68')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a84')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.formerror22')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable2">
                                                        @foreach($acad as $se)
                                                        <tr>
                                                            
                                                            <td>{{ $se->namedir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->jordir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->niveldir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->tipodir ?? 'Pendiente' }}</td>
                                                            <td>{{ $se->faculdir ?? 'Pendiente' }}</td>
                                                            <td>
                                                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick='editacad("{{ $se->idansdir }}", "{{ $se->namedir }}", "{{ $se->niveldir }}", "{{ $se->tipodir }}", "{{ $se->jordir }}", "{{ $se->faculdir }}")'>{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick='deleteest({{ $se->idansdir }}, "acadid")'>{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button></td>
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
                                                                <button type="button" id="validardatos" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a87')}} {{ trans('multi-leng.a134')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <a href="{{ route('buscar-concursos-registrados-docentes' ) }}" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.lognav')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <a href="{{ route('ver-formulario-docente-segunda-etapa', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a88')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
                                        <h4>{{ trans('multi-leng.a201') }} <strong class="statusval">{{ ($status->etapa1 == 1) ? trans('multi-leng.a197') : trans('multi-leng.a198') }}</strong></h4>
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
<input type="hidden" id="idansw" name="idansw" value="{{ Crypt::encrypt($answ[0]->idansw) }}">

@endsection

@section('extra-script')
<script type="text/javascript">
    
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        
        $('#tabla1').DataTable({
            //"dom": 'lfrtip'
            "dom": 'frtip', 
            fixedHeader: true,
            responsive: true,      
            "order": [[ 1, "desc" ]],
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
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
    $('#mensaje_ayuda').text('500 {{ trans('multi-leng.a58')}}');
    $('#preg2et1').keyup(function () {
        var max = 500;
        var len = $(this).val().length;
        if (len >= max) 
        {

            $('#mensaje_ayuda').text('{{ trans('multi-leng.a59')}}');// Aquí enviamos el mensaje a mostrar          
            $('#mensaje_ayuda').addClass('text-danger'); 
                            
        } 
        else 
        {

            var ch = max - len;
            $('#mensaje_ayuda').text(ch + '{{ trans('multi-leng.a58')}}');
            $('#mensaje_ayuda').removeClass('text-danger');
            actualizardatos($(this).val(), "preg2et1", "answ", 0, 0, 0);

        }
    });

    function agragarinfo(tipo)
    {
        if(tipo == 1)
        {
            $('#staticBackdropLabel').html('{{ trans('multi-leng.a62')}}');
            $('#modalbody').html(`<form>
                                        <input type="hidden" value="0" class="form-control" name="idest" id="idest">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a49')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" value="" class="form-control" name="name" id="name" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" required autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>RUT:</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a63') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="rut" name="rut" placeholder="XXXXXXXX-X" minlength="9" maxlength="10" onkeypress="return valideKey(event);" required>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a54')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a64') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="XXXXXXXXX" minlength="9" maxlength="9" onkeypress="return valideKeycel(event);" required>
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a55')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a65') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="email" name="email" minlength="6" placeholder="xxxxxx@xxxxxxxx.xxx" maxlength="70" required>
                                            <small id="mensaje4" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a68')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="posicion" name="posicion" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje5" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a69')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="carrera" name="carrera" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje6" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a70')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="facultad" name="facultad" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje7" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a71')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="nivel" name="nivel" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje8" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="addstudent" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('multi-leng.a62')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button onclick="addpending(1);" id="idpending" class="btn btn-warning btn-sm btn-block" type="button">{{ trans('multi-leng.a73')}}&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a74') }}" data-html="true"></i></button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
            
        }
        if(tipo == 2)
        {
            $('#staticBackdropLabel').html('{{ trans('multi-leng.a86')}}');
            $('#modalbody').html(`<form>
                                        <input type="hidden" value="0" class="form-control" name="idacad" id="idacad">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a83')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" value="" class="form-control" name="name" id="name" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" required autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="selecttipo" class="form-label"><b>{{ __('multi-leng.a180') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a179') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <select class="form-control" id="selecttipo" name="selecttipo">
                                                <option value="">Seleccione....</option>
                                                <option value="Adjunto">Adjunto</option>
                                                <option value="Docente">Docente</option>
                                                <option value="Externo">Externo</option>
                                            </select>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>

                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a50')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="posicion" name="posicion" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje5" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a68')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="carrera" name="carrera" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje6" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a84')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="facultad" name="facultad" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" required>
                                            <small id="mensaje7" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="addacademic" class="btn btn-primary btn-sm btn-block" type="button">{{ trans('multi-leng.a86')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button onclick="addpending(2);" id="idpending" class="btn btn-warning btn-sm btn-block" type="button">{{ trans('multi-leng.a73')}}&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a74') }}" data-html="true"></i></button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
            
        }
    }
    $("#staticBackdrop").on('show.bs.modal', function() { 
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).on('click','#addacademic',function(e){
            $(this).prop( 'disabled', true );
            var error = "";
            $("#mensaje1").html('');
            $("#mensaje2").html('');
            $("#mensaje5").html('');
            $("#mensaje6").html('');
            $("#mensaje7").html('');

            if($.trim($("#name").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje1").html('{{ __('multi-leng.a89') }}');
            }
            if($.trim($("#selecttipo").val()) == "")
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje2").html('{{ __('multi-leng.a181') }}');
            }
            if($.trim($("#posicion").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje5").html('{{ __('multi-leng.a90') }}');
            }
            
            if($.trim($("#carrera").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje6").html('{{ __('multi-leng.a91') }}');
            }
            if($.trim($("#facultad").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje7").html('{{ __('multi-leng.a92') }}');
            }
            if(error != "")
            {
                $(this).prop( 'disabled', false );
                return false;
            }
            else
            {
                let info = [];
                info[0] = $.trim($("#idacad").val());
                info[1] = $.trim($("#name").val());
                info[2] = $.trim($("#posicion").val());
                info[3] = $.trim($("#carrera").val());
                info[4] = $.trim($("#facultad").val());
                info[5] = $.trim($("#selecttipo").val());
                
                console.log("disabled");
                actualizardatos(info, 0, "acadid", 0, 0, 0);
            }
        });
        $(document).on('click','#addstudent',function(e){
            $(this).prop( 'disabled', true );
            var error = "";
            $("#mensaje1").html('');
            $("#mensaje2").html('');
            $("#mensaje3").html('');
            $("#mensaje4").html('');
            $("#mensaje5").html('');
            $("#mensaje6").html('');
            $("#mensaje7").html('');
            $("#mensaje8").html('');
            if($.trim($("#name").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje1").html('{{ __('multi-leng.a75') }}');
            }
            if (!Fn.validaRut( $("#rut").val() ) && $.trim($("#rut").val()).length > 0)
            {
                error += "-. Ingrese un rut válido<br>";
                $("#mensaje2").html('{{ __('multi-leng.a76') }}');
            }
            if($.trim($("#telefono").val()).length < 9)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje3").html('{{ __('multi-leng.a77') }}');
            }
            if (!validaemail( `${$("#email").val()}`))
            {
                error += "-. Ingrese un rut válido<br>";
                $("#mensaje4").html('{{ __('multi-leng.a78') }}');
            }
            if($.trim($("#posicion").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje5").html('{{ __('multi-leng.a79') }}');
            }
            if($.trim($("#carrera").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje6").html('{{ __('multi-leng.a80') }}');
            }
            if($.trim($("#facultad").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje7").html('{{ __('multi-leng.a81') }}');
            }
            if($.trim($("#nivel").val()).length < 2)
            {
                error += "{{ __('multi-leng.formerror39') }}<br>";
                $("#mensaje8").html('{{ __('multi-leng.a82') }}');
            }
            if(error != "")
            {
                $(this).prop( 'disabled', false );
                return false;
            }
            else
            {
                let info = [];
                info[0] = $.trim($("#idest").val());
                info[1] = $.trim($("#name").val());
                info[2] = $.trim($("#rut").val());
                info[3] = $.trim($("#telefono").val());
                info[4] = $.trim($("#email").val());
                info[5] = $.trim($("#posicion").val());
                info[6] = $.trim($("#carrera").val());
                info[7] = $.trim($("#facultad").val());
                info[8] = $.trim($("#nivel").val());
                
                actualizardatos(info, 0, "estid", 0, 0, 0);
               
            }
        });
    });
    function addpending(tipo)
    {
        if(tipo == 1)
        {
            $("#idpending").prop( 'disabled', true );
            $("#addstudent").prop( 'disabled', true );
            actualizardatos("", "", "est", 0, 0, "pend");
        }
        if(tipo == 2)
        {
            $("#idpending").prop( 'disabled', true );
            $("#addstudent").prop( 'disabled', true );
            actualizardatos("", "", "acadpend", 0, 0, "pend");
        }
    }
    var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
            rutCompleto = rutCompleto.replace("‐","-");
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                return false;
            var tmp 	= rutCompleto.split('-');
            var digv	= tmp[1]; 
            var rut 	= tmp[0];
            if ( digv == 'K' ) digv = 'k' ;
            
            return (Fn.dv(rut) == digv );
        },
        dv : function(T){
            var M=0,S=1;
            for(;T;T=Math.floor(T/10))
                S=(S+T%10*(9-M++%6))%11;
            return S?S-1:'k';
        }
    }
    function validaemail(email)
    {
        var isProperEmail = new RegExp(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/);
        if(!isProperEmail.test(email)) 
        {
            return false;
        }
        else
        {
            return true;
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
    function valideKey(evt)
    {
        var code = (evt.which) ? evt.which : evt.keyCode;
    
        if(code==8) 
        { 
            return true;
        }
        else if(code==45) 
        {
            return true;
        }
        else if(code == 107) 
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

    function editest(id, nom, rut, tel, email, fun, car, fac, niv )
    {
        let msg;
        if(rut == "")
        {
            msg = "{{ trans('multi-leng.a131') }}";
        }
        else
        {
            msg = "{{ trans('multi-leng.a132') }}";
        }
        $('#staticBackdropLabel').html('{{ trans('multi-leng.a132')}}');
            $('#modalbody').html(`<form>
                            <input type="hidden" value="${id}" class="form-control" name="idest" id="idest">
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a49')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" value="${nom}" class="form-control" name="name" id="name" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" required autofocus>
                                            <small id="mensaje1" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>RUT:</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a63') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="rut" name="rut" placeholder="XXXXXXXX-X" minlength="9" maxlength="10" onkeypress="return valideKey(event);" value="${rut}" required>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a54')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a64') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="XXXXXXXXX" minlength="9" maxlength="9" onkeypress="return valideKeycel(event);" value="${tel}" required>
                                            <small id="mensaje3" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a55')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a65') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="email" name="email" minlength="6" placeholder="xxxxxx@xxxxxxxx.xxx" maxlength="70" value="${email}" required>
                                            <small id="mensaje4" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a68')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="posicion" name="posicion" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${fun}" required>
                                            <small id="mensaje5" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a69')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="carrera" name="carrera" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${car}" required>
                                            <small id="mensaje6" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a70')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="facultad" name="facultad" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${fac}" required>
                                            <small id="mensaje7" style="color:red"></small>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>{{ trans('multi-leng.a71')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <input type="text" class="form-control" id="nivel" name="nivel" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${niv}" required>
                                            <small id="mensaje8" style="color:red"></small>
                                        </div>
                                        <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                <button id="addstudent" class="btn btn-warning btn-sm btn-block" type="button">
                                                                ${msg}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i>
                                                                </button>
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
    function editacad(id, nom, niv, fun, car, fac )
    {
        let niv1, niv2, niv3, niv4;
        if(niv == '')
        {
            niv1 = "selected"; niv2 = ""; niv3 = ""; niv4 = "";
        }
        if(niv == 'Adjunto')
        {
            niv1 = ""; niv2 = "selected"; niv3 = ""; niv4 = "";
        }
        if(niv == 'Docente')
        {
            niv1 = ""; niv2 = ""; niv3 = "selected"; niv4 = "";
        }
        if(niv == 'Externo')
        {
            niv1 = ""; niv2 = ""; niv3 = ""; niv4 = "selected";
        }
        $('#staticBackdropLabel').html('{{ trans('multi-leng.a133')}}');
        $('#modalbody').html(`<form>
                                    <input type="hidden" value="${id}" class="form-control" name="idacadt" id="idacad">
                                    <div class="mb-3 form-group">
                                        <label class="form-label"><b>{{ trans('multi-leng.a49')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                        <input type="text" value="${nom}" class="form-control" name="name" id="name" placeholder="xxxxxxx xxxxxxxx xxxxxxx" minlength="2" maxlength="70" required autofocus>
                                        <small id="mensaje1" style="color:red"></small>
                                    </div>
                                    <div class="form-group">
                                            <label for="selecttipo" class="form-label"><b>{{ __('multi-leng.a180') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a179') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                            <select class="form-control" id="selecttipo" name="selecttipo">
                                                <option value="" ${niv1}>Seleccione....</option>
                                                <option value="Adjunto" ${niv2}>Adjunto</option>
                                                <option value="Docente" ${niv3}>Docente</option>
                                                <option value="Externo" ${niv4}>Externo</option>
                                            </select>
                                            <small id="mensaje2" style="color:red"></small>
                                        </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label"><b>{{ trans('multi-leng.a68')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                        <input type="text" class="form-control" id="posicion" name="posicion" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${fun}" required>
                                        <small id="mensaje5" style="color:red"></small>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label"><b>{{ trans('multi-leng.a69')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                        <input type="text" class="form-control" id="carrera" name="carrera" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${car}" required>
                                        <small id="mensaje6" style="color:red"></small>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label"><b>{{ trans('multi-leng.a84')}}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a72') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                        <input type="text" class="form-control" id="facultad" name="facultad" minlength="2" placeholder="xxxxxx xxxxxx xxxxxxxx" maxlength="100" value="${fac}" required>
                                        <small id="mensaje7" style="color:red"></small>
                                    </div>
                                    <div class="form-group mb-4">
                                            <div class="container-fluid">
                                                <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <button id="addacademic" class="btn btn-warning btn-sm btn-block" type="button">{{ trans('multi-leng.a133')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
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
    function deleteest(id, nombre)
    {
        actualizardatos(id, nombre, "delete", 0, 0, 0);
    }

    $( "#preg1et1" ).on( "keyup", function() {

        actualizardatos($(this).val(), "preg1et1", "answ", 0, 0, 0);
        
    } );

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
            url: '{{url("/")}}/actualizar-formulario-postulacion-docente-etapa-uno',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(respu)
            {
                
                let tr = "";
                let namefor, rutfor, telfor, emailfor, funcionfor, carrerafor, facultadfor, nivelfor;
                if(type == "est" || type == "estid")
                {
                    $('#tabla1').DataTable().destroy();
                    $("#tbodytable1").html('');
                    Object.keys(respu.est).forEach(key => {
                        
                        if(respu.est[key]['namedir'] == "" || respu.est[key]['namedir'] == null){ namefor = "{{ trans('multi-leng.a73')}}"; }else{ namefor = respu.est[key]['namedir']; }
                        if(respu.est[key]['rutdir'] == "" || respu.est[key]['rutdir'] == null){ rutfor = "{{ trans('multi-leng.a73')}}"; }else{ rutfor = respu.est[key]['rutdir']; }
                        if(respu.est[key]['teldir'] == "" || respu.est[key]['teldir'] == null){ telfor = "{{ trans('multi-leng.a73')}}"; }else{ telfor = respu.est[key]['teldir']; }
                        if(respu.est[key]['emaildir'] == "" || respu.est[key]['emaildir'] == null){ emailfor = "{{ trans('multi-leng.a73')}}"; }else{ emailfor = respu.est[key]['emaildir']; }
                        if(respu.est[key]['tipodir'] == "" || respu.est[key]['tipodir'] == null){ funcionfor = "{{ trans('multi-leng.a73')}}"; }else{ funcionfor = respu.est[key]['tipodir']; }
                        if(respu.est[key]['jordir'] == "" || respu.est[key]['jordir'] == null){ carrerafor = "{{ trans('multi-leng.a73')}}"; }else{ carrerafor = respu.est[key]['jordir']; }
                        if(respu.est[key]['faculdir'] == "" || respu.est[key]['faculdir'] == null){ facultadfor = "{{ trans('multi-leng.a73')}}"; }else{ facultadfor = respu.est[key]['faculdir']; }
                        if(respu.est[key]['niveldir'] == "" || respu.est[key]['niveldir'] == null){ nivelfor = "{{ trans('multi-leng.a73')}}"; }else{ nivelfor = respu.est[key]['niveldir']; }
                        tr += `<tr>
                            <td>${namefor}</td>
                            <td>${rutfor}</td>
                            <td>${telfor}</td>
                            <td>${emailfor}</td>
                            <td>${funcionfor}</td>}
                            <td>${carrerafor}</td>
                            <td>${facultadfor}</td>
                            <td>${nivelfor}</td>
                            <td>
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick='editest("${respu.est[key]['idansdir']}", "${namefor}", "${rutfor}", "${telfor}", "${emailfor}", "${funcionfor}", "${carrerafor}", "${facultadfor}", "${nivelfor}")'>{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick='deleteest(${respu.est[key]['idansdir']}, "est")'>{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
                    });
                    
                    $("#tbodytable1").html(tr);
                    $('#tabla1').DataTable({
                        //"dom": 'lfrtip'
                        "dom": 'frtip', 
                        fixedHeader: true,
                        responsive: true,      
                        "order": [[ 1, "desc" ]],
                        "language": {
                            "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                        }
                    });
                    $("#addstudent").removeClass( 'disabled' );
                    $( "#staticBackdrop" ).modal('hide');
                }
                if(type == "acadid" || type == "acadpend")
                {
                    $('#tabla2').DataTable().destroy();
                    $("#tbodytable2").html('');

                    Object.keys(respu.est).forEach(key => {
                        
                        if(respu.est[key]['namedir'] == "" || respu.est[key]['namedir'] == null){ namefor = "{{ trans('multi-leng.a73')}}"; }else{ namefor = respu.est[key]['namedir']; }
                        if(respu.est[key]['tipodir'] == "" || respu.est[key]['tipodir'] == null){ funcionfor = "{{ trans('multi-leng.a73')}}"; }else{ funcionfor = respu.est[key]['tipodir']; }
                        if(respu.est[key]['jordir'] == "" || respu.est[key]['jordir'] == null){ carrerafor = "{{ trans('multi-leng.a73')}}"; }else{ carrerafor = respu.est[key]['jordir']; }
                        if(respu.est[key]['faculdir'] == "" || respu.est[key]['faculdir'] == null){ facultadfor = "{{ trans('multi-leng.a73')}}"; }else{ facultadfor = respu.est[key]['faculdir']; }
                        if(respu.est[key]['niveldir'] == "" || respu.est[key]['niveldir'] == null){ nivelfor = "{{ trans('multi-leng.a73')}}"; }else{ nivelfor = respu.est[key]['niveldir']; }

                        tr += `<tr>
                            <td>${namefor}</td>
                            <td>${carrerafor}</td>
                            <td>${nivelfor}</td>
                            <td>${funcionfor}</td>
                            <td>${facultadfor}</td>
                            <td>
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick='editacad("${respu.est[key]['idansdir']}", "${namefor}", "${nivelfor}", "${funcionfor}", "${carrerafor}", "${facultadfor}")'>{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick='deleteest(${respu.est[key]['idansdir']}, "acadid")'>{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
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
                    $("#addacademic").prop( 'disabled', false );
                    $( "#staticBackdrop" ).modal('hide');
                }

                
                if(type == "delete")
                {
                    if(col == "est")
                    {
                        $('#tabla1').DataTable().destroy();
                        $("#tbodytable1").html('');
                        Object.keys(respu.est).forEach(key => {
                            
                            if(respu.est[key]['namedir'] == "" || respu.est[key]['namedir'] == null){ namefor = "{{ trans('multi-leng.a73')}}"; }else{ namefor = respu.est[key]['namedir']; }
                            if(respu.est[key]['rutdir'] == "" || respu.est[key]['rutdir'] == null){ rutfor = "{{ trans('multi-leng.a73')}}"; }else{ rutfor = respu.est[key]['rutdir']; }
                            if(respu.est[key]['teldir'] == "" || respu.est[key]['teldir'] == null){ telfor = "{{ trans('multi-leng.a73')}}"; }else{ telfor = respu.est[key]['teldir']; }
                            if(respu.est[key]['emaildir'] == "" || respu.est[key]['emaildir'] == null){ emailfor = "{{ trans('multi-leng.a73')}}"; }else{ emailfor = respu.est[key]['emaildir']; }
                            if(respu.est[key]['tipodir'] == "" || respu.est[key]['tipodir'] == null){ funcionfor = "{{ trans('multi-leng.a73')}}"; }else{ funcionfor = respu.est[key]['tipodir']; }
                            if(respu.est[key]['jordir'] == "" || respu.est[key]['jordir'] == null){ carrerafor = "{{ trans('multi-leng.a73')}}"; }else{ carrerafor = respu.est[key]['jordir']; }
                            if(respu.est[key]['faculdir'] == "" || respu.est[key]['faculdir'] == null){ facultadfor = "{{ trans('multi-leng.a73')}}"; }else{ facultadfor = respu.est[key]['faculdir']; }
                            if(respu.est[key]['niveldir'] == "" || respu.est[key]['niveldir'] == null){ nivelfor = "{{ trans('multi-leng.a73')}}"; }else{ nivelfor = respu.est[key]['niveldir']; }
                            tr += `<tr>
                                <td>${namefor}</td>
                                <td>${rutfor}</td>
                                <td>${telfor}</td>
                                <td>${emailfor}</td>
                                <td>${funcionfor}</td>
                                <td>${carrerafor}</td>
                                <td>${facultadfor}</td>
                                <td>${nivelfor}</td>
                                <td>
                                    <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick='editest("${respu.est[key]['idansdir']}", "${namefor}", "${rutfor}", "${telfor}", "${emailfor}", "${funcionfor}", "${carrerafor}", "${facultadfor}", "${nivelfor}")'>{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                    <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick='deleteest(${respu.est[key]['idansdir']}, "est")'>{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                </td>
                            </tr>`;
                        });
                        
                        $("#tbodytable1").html(tr);
                        $('#tabla1').DataTable({
                            //"dom": 'lfrtip'
                            "dom": 'frtip', 
                            fixedHeader: true,
                            responsive: true,      
                            "order": [[ 1, "desc" ]],
                            "language": {
                                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
                            }
                        });
                    }
                    else
                    {
                        $('#tabla2').DataTable().destroy();
                        $("#tbodytable2").html('');

                    Object.keys(respu.est).forEach(key => {
                        
                        if(respu.est[key]['namedir'] == "" || respu.est[key]['namedir'] == null){ namefor = "{{ trans('multi-leng.a73')}}"; }else{ namefor = respu.est[key]['namedir']; }
                        if(respu.est[key]['tipodir'] == "" || respu.est[key]['tipodir'] == null){ funcionfor = "{{ trans('multi-leng.a73')}}"; }else{ funcionfor = respu.est[key]['tipodir']; }
                        if(respu.est[key]['jordir'] == "" || respu.est[key]['jordir'] == null){ carrerafor = "{{ trans('multi-leng.a73')}}"; }else{ carrerafor = respu.est[key]['jordir']; }
                        if(respu.est[key]['faculdir'] == "" || respu.est[key]['faculdir'] == null){ facultadfor = "{{ trans('multi-leng.a73')}}"; }else{ facultadfor = respu.est[key]['faculdir']; }
                        if(respu.est[key]['niveldir'] == "" || respu.est[key]['niveldir'] == null){ nivelfor = "{{ trans('multi-leng.a73')}}"; }else{ nivelfor = respu.est[key]['niveldir']; }
                        tr += `<tr>
                            <td>${namefor}</td>
                            <td>${carrerafor}</td>
                            <td>${nivelfor}</td>
                            <td>${funcionfor}</td>
                            <td>${facultadfor}</td>
                            <td>
                                <button type='button' class='btn btn-warning btn-sm btn-block mb-1' onclick='editacad("${respu.est[key]['idansdir']}", "${namefor}", "${nivelfor}", "${funcionfor}", "${carrerafor}", "${facultadfor}")'>{{__('lang.editar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                <button type='button' class='btn btn-danger btn-sm btn-block mb-1' onclick='deleteest(${respu.est[key]['idansdir']}, "acadid")'>{{__('lang.eliminar')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                            </td>
                        </tr>`;
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
                    }
                }
                if(type == "val")   
                {
                    $('.statusval').html('{{ trans('multi-leng.a197')}}');
                    $('#staticBackdropLabel').html('{{ trans('multi-leng.a139')}}');
                    $('#modalbody').html(`<strong>{{ trans('multi-leng.a140')}}</strong>`);
                    $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
                    $('#staticBackdrop').modal('show');
                }
                
            }
        });
    }
    $(document).on('keyup','.comdir',function(e){
        let val1 = $(this).val();
        let val2 = $(this).attr("data-id");
        let val3 = $(this).attr("data-col");
        if($(this).attr("data-col") == "rutdir")
        {
            
            if( $(this).val().length == 9  && Fn.validaRut( $(this).val() ))
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
            else if( $(this).val().length == 10  && Fn.validaRut( $(this).val() ))
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
            else
            {
                
                actualizardatos("", `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
        }
        else if($(this).attr("data-col") == "emaildir")
        {
            if (validaemail( `${$(this).val()}`))
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
            else
            {
                actualizardatos("", `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
        }
        else if($(this).attr("data-col") == "teldir")
        {
            if ($(this).val().length == 9)
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
            else
            {
                actualizardatos("", `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
            }
        }
        else
        {
            actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "dir", $(this).attr("data-id"), 0, 0);
        }
        
    });
    $(document).on('keyup','.subcomdir',function(e){
        let val1 = $(this).val();
        let val2 = $(this).attr("data-id");
        let val3 = $(this).attr("data-col");
        if($(this).attr("data-col") == "rutdir")
        {
            
            if( $(this).val().length == 9  && Fn.validaRut( $(this).val() ))
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
            else if( $(this).val().length == 10  && Fn.validaRut( $(this).val() ))
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
            else
            {
                
                actualizardatos("", `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
        }
        else if($(this).attr("data-col") == "emaildir")
        {
            if (validaemail( `${$(this).val()}`))
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
            else
            {
                actualizardatos("", `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
        }
        else if($(this).attr("data-col") == "teldir")
        {
            if ($(this).val().length == 9)
            {
                actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
            else
            {
                actualizardatos("", `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
            }
        }
        else
        {
            actualizardatos($(this).val(), `${$(this).attr("data-col")}`, "subdir", $(this).attr("data-id"), 0, 0);
        }
        
    });
    $(document).on('click','#validardatos',function(e){
        let error = "";
        if($.trim($("#preg1et1").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a135')}}</strong><br>";
        }
        if($.trim($("#preg2et1").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a136')}}</strong><br>";
        }
        if($.trim($("#namedir").val()).length == 0 && $.trim($("#rutdir").val()).length == 0 && $.trim($("#faculdir").val()).length == 0 && $.trim($("#jordir").val()).length == 0 && $.trim($("#tipodir").val()).length == 0 && $.trim($("#antidir").val()).length == 0 && $.trim($("#teldir").val()).length == 0 && $.trim($("#emaildir").val()).length == 0 && $.trim($("#horasdir").val()).length == 0)
        {
            error += "<strong>{{ trans('multi-leng.a137')}}</strong><br>";
        }
        if(error != "")
        {
            $('#staticBackdropLabel').html('{{ trans('multi-leng.a139')}}');
            $('#modalbody').html(`{{ trans('multi-leng.a138')}} <br>${error}`);
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
