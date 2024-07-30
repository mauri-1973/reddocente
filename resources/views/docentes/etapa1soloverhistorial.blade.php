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
                                        <h4><strong class="statusval">{{ $ver }}</strong></h4>
                                        @if($tipo != 'enrevision')
                                        <a href="{{ route('imprimr-formulario-docente-observaciones', Crypt::encrypt($answ[0]->idansw)) }}" role="button" id="imprimir" class="btn btn-warning btn-sm btn-block" style="display:{{ $display }}">{{ trans('multi-leng.a249')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                        @endif
                                        <!--<a href="{{ route('iniciar-correciones-formulario-revisor', Crypt::encrypt($answ[0]->idansw) ) }}" class="btn btn-warning btn-sm btn-block" style="display:{{ $display }}">Iniciar Correcciones&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>-->
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
                                            <label for="preg1et1" class="textlabel"><b>{{ trans('multi-leng.a44')}}</b></label>
                                            <input class="form-control input-lg" id="preg1et1" name="preg1et1" type="text" minlength="2" maxlength="70" value="{{ $answ[0]->preg1et1 }}" placeholder="{{ trans('multi-leng.a150')}}" readonly>
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                        <div class="form-group mb-4">
                                            <label for="preg2et1" class="textlabel"><b>{{ trans('multi-leng.a45')}}</b></label>
                                            <textarea class="form-control input-lg textarea1" placeholder="{{ trans('multi-leng.a46')}}" id="preg2et1" name="preg2et1" rows="15" maxlength="500" readonly>{{ $answ[0]->preg2et1 }}</textarea>
                                            <span class="help-block">
                                                <p id="mensaje_ayuda" class="help-block" style="color:#fff;"></p>
                                            </span> 
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                        <div class="author text-white mb-3">
                                            <h5>{{ trans('multi-leng.a47')}}</h5>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="preg0" class="textlabel">{{ trans('multi-leng.a48')}}</b></label>
                                            <table class="table table-bordered table-sm" id="tablainicio" style="background-color:#fff;">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a49')}}
                                                        </th>
                                                        <td class="input-sm">
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="namedir" name="namedir" id="namedir" type="text" maxlength="70" value="{{ $dir->namedir}}" readonly> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RUT:
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="rutdir" id="rutdir" name="rutdir" type="text" minlength="9" maxlength="10" value="{{ $dir->rutdir }}" onkeypress="return valideKey(event);" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a50')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="faculdir" name="faculdir" id="faculdir" type="text" maxlength="70" value="{{ $dir->faculdir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a51')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="jordir" name="jordir" id="jordir" type="text" maxlength="70" value="{{ $dir->jordir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a52')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="tipodir" name="tipodir" id="tipodir" type="text" maxlength="70" value="{{ $dir->tipodir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a53')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="antidir" name="antidir" id="antidir" type="text" maxlength="70" value="{{ $dir->antidir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a54')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="teldir" name="teldir" id="teldir" type="text" maxlength="9" value="{{ $dir->teldir}}" onkeypress="return valideKeycel(event);" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a55')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="emaildir" name="emaildir" id="emaildir" type="text" maxlength="70" value="{{ $dir->emaildir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a56')}}&nbsp;&nbsp;
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="horasdir" name="horasdir" id="horasdir" type="text" maxlength="4" value="{{ $dir->horasdir}}" onkeypress="return valideKeycel(event);" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-3" scope="row" style="width:40%;">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a57')}}
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
                                            <label for="preg0" class="textlabel">{{ trans('multi-leng.a60')}}</label>
                                            <table class="table table-bordered table-sm" id="tablainicio2" style="background-color:#fff;">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a49')}}
                                                        </th>
                                                        <td class="input-sm">
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->idansdir }}" data-col="namedir" name="namesuddir" id="namesubdir" type="text" maxlength="70" value="{{ $subdir->namedir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RUT:
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->idansdir }}" data-col="rutdir" name="rutsubdir" id="namedir" type="text" maxlength="10" value="{{ $subdir->rutdir}}" onkeypress="return valideKey(event);" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a50')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->faculdir }}" data-col="faculdir" name="faculsubdir" id="faculsubdir" type="text" maxlength="70" value="{{ $subdir->faculdir}}"  readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a51')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->jordir }}" data-col="jordir" name="jorsubdir" id="jorsubdir" type="text" maxlength="70" value="{{ $subdir->jordir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a52')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->tipodir }}" data-col="tipodir" name="tiposubdir" id="tiposubdir" type="text" maxlength="70" value="{{ $subdir->jordir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a53')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->antidir }}" data-col="antidir" name="antisubdir" id="antisubdir" type="text" maxlength="70" value="{{ $subdir->antidir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a54')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->teldir }}" data-col="teldir" name="telsubdir" id="telsubdir" type="text" maxlength="9" value="{{ $subdir->teldir}}" onkeypress="return valideKeycel(event);" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a55')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->teldir }}" data-col="emaildir" name="emailsubdir" id="emailsubdir" type="text" maxlength="70" value="{{ $subdir->emaildir}}" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a56')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->idansdir }}" data-col="horasdir" name="horassubdir" id="horassubdir" type="text" maxlength="4" value="{{ $subdir->horasdir}}" onkeypress="return valideKeycel(event);" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="input-sm" scope="row" style="width:40%;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a57')}}
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
                                            <label for="preg0" class="textlabel">{{ trans('multi-leng.a66')}}</label>
                                            <table class="table table-bordered table-sm" id="tablainicio3" style="background-color:#fff;" id="tabla1">
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
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodytable1">
                                                
                                                    @foreach($est as $se)
                                                    <tr>
                                                        
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $se->namedir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->rutdir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->teldir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->emaildir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->tipodir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->jordir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->faculdir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->niveldir ?? 'Pendiente' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                        <div class="form-group mb-4">
                                            <label for="preg0" class="textlabel">{{ trans('multi-leng.a85')}}</label>
                                            <table class="table table-bordered table-sm" id="tablainicio4" style="background-color:#fff;" id="tabla2">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ trans('multi-leng.a83')}}</th>
                                                        <th scope="col">{{ trans('multi-leng.a50')}}</th>
                                                        <th scope="col">{{ trans('multi-leng.a180') }}</th>
                                                        <th scope="col">{{ trans('multi-leng.a68')}}</th>
                                                        <th scope="col">{{ trans('multi-leng.a84')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodytable2">
                                                    @foreach($acad as $se)
                                                    <tr>
                                                        
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $se->namedir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->jordir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->niveldir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->tipodir ?? 'Pendiente' }}</td>
                                                        <td>{{ $se->faculdir ?? 'Pendiente' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                        <div class="author text-white mb-3">
                                            <h5>{{ trans('multi-leng.a93')}} </h5>
                                        </div>
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
                                            
                                            <table class="table table-bordered table-sm" id="tablainicio5" style="background-color:#fff;" id="tabla2">
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
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $file->dirfile }} </td>
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
                                        <div class="author text-white mb-3">
                                            <h5>{{ trans('multi-leng.a115')}}</h5>
                                        </div>
                                        <hr style="border-top: 3px solid #fff;">
                                        <div class="form-group mb-4">
                                            <label for="preg0" class="textlabel"><b>{{ trans('multi-leng.a116')}}</b></label>
                                            <table class="table table-bordered table-sm" id="tablainicio6" style="background-color:#fff;">
                                                <thead>
                                                    <tr>
                                                        <th scope="row">Ítem</th>
                                                        <th scope="row">Total ($)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th class="input-sm" scope="row">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a117')}}
                                                        </th>
                                                        <td class="input-sm">
                                                            <input class="form-control form-control1 input-sm tab1" data-col="valor1"  id="valor1et4" name="valor1et4" type="text" maxlength="8" value="{{ $sumper }}" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a118')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm tab1" data-col="valor2"  id="valor2et4" name="valor2et4" type="text" maxlength="8" value="{{ $sumcom }}" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a119')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm tab1" data-col="valor3"  id="valor3et4" name="valor3et4" type="text" maxlength="8" value="{{ $sumfun }}" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a120')}}
                                                        </th>
                                                        <td>
                                                            <input class="form-control form-control1 input-sm tab1" data-col="valor4"  id="valor4et4" name="valor4et4" type="text" maxlength="8" value="{{ $sumotr }}" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans('multi-leng.a121')}}
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
                                            <table class="table table-bordered table-sm" id="tablainicio7" style="background-color:#fff;">
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
                                                        
                                                        <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tabla->descri }}</th>
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
                                            <table class="table table-bordered table-sm" id="tablainicio8" style="background-color:#fff;">
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
                                                        
                                                        <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tabla->descri }}</th>
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
                                            <table class="table table-bordered table-sm" id="tablainicio9" style="background-color:#fff;">
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
                                                        
                                                        <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tabla->descri }}</th>
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
                                            <table class="table table-bordered table-sm" id="tablainicio10" style="background-color:#fff;">
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
                                                        
                                                        <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tabla->descri }}</th>
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
                                        <div class="form-group mb-4">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <a href="{{ route('imprimr-formulario-docente', Crypt::encrypt($answ[0]->idansw)) }}" role="button" id="imprimir" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a204')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <a href="{{ route('buscar-concursos-registrados-revisor' ) }}" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.lognav')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
<input type="hidden" id="idansw" name="idansw" value="{{ Crypt::encrypt($answ[0]->idansw) }}">

@endsection

@section('extra-script')
<script type="text/javascript">
    
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        
        $('#tablainicio').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio2').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio3').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio4').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio5').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio6').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio7').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio8').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio9').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
        $('#tablainicio10').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
    });
    
    
</script>
@endsection
