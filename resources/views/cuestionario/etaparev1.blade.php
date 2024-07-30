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
                                                    <tbody>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a49')}}
                                                            </th>
                                                            <td class="input-sm">
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="namedir" name="namedir" id="namedir" type="text" maxlength="70" value="{{ $dir->namedir}}" readonly> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                RUT:
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="rutdir" id="rutdir" name="rutdir" type="text" minlength="9" maxlength="10" value="{{ $dir->rutdir }}" onkeypress="return valideKey(event);" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a50')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="faculdir" name="faculdir" id="faculdir" type="text" maxlength="70" value="{{ $dir->faculdir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a51')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="jordir" name="jordir" id="jordir" type="text" maxlength="70" value="{{ $dir->jordir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a52')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="tipodir" name="tipodir" id="tipodir" type="text" maxlength="70" value="{{ $dir->tipodir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a53')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="antidir" name="antidir" id="antidir" type="text" maxlength="70" value="{{ $dir->antidir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a54')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="teldir" name="teldir" id="teldir" type="text" maxlength="9" value="{{ $dir->teldir}}" onkeypress="return valideKeycel(event);" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a55')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="emaildir" name="emaildir" id="emaildir" type="text" maxlength="70" value="{{ $dir->emaildir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a56')}}&nbsp;&nbsp;
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $dir->idansdir }}" data-col="horasdir" name="horasdir" id="horasdir" type="text" maxlength="4" value="{{ $dir->horasdir}}" onkeypress="return valideKeycel(event);" readonly>
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
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->idansdir }}" data-col="namedir" name="namesuddir" id="namesubdir" type="text" maxlength="70" value="{{ $subdir->namedir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                RUT:
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->idansdir }}" data-col="rutdir" name="rutsubdir" id="namedir" type="text" maxlength="10" value="{{ $subdir->rutdir}}" onkeypress="return valideKey(event);" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a50')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->faculdir }}" data-col="faculdir" name="faculsubdir" id="faculsubdir" type="text" maxlength="70" value="{{ $subdir->faculdir}}"  readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a51')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->jordir }}" data-col="jordir" name="jorsubdir" id="jorsubdir" type="text" maxlength="70" value="{{ $subdir->jordir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a52')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->tipodir }}" data-col="tipodir" name="tiposubdir" id="tiposubdir" type="text" maxlength="70" value="{{ $subdir->jordir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a53')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->antidir }}" data-col="antidir" name="antisubdir" id="antisubdir" type="text" maxlength="70" value="{{ $subdir->antidir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a54')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->teldir }}" data-col="teldir" name="telsubdir" id="telsubdir" type="text" maxlength="9" value="{{ $subdir->teldir}}" onkeypress="return valideKeycel(event);" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a55')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->teldir }}" data-col="emaildir" name="emailsubdir" id="emailsubdir" type="text" maxlength="70" value="{{ $subdir->emaildir}}" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="input-sm" scope="row" style="width:40%;">
                                                                {{ trans('multi-leng.a56')}}
                                                            </th>
                                                            <td>
                                                                <input class="form-control form-control1 input-sm comdir" data-id="{{ $subdir->idansdir }}" data-col="horasdir" name="horassubdir" id="horassubdir" type="text" maxlength="4" value="{{ $subdir->horasdir}}" onkeypress="return valideKeycel(event);" readonly>
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
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a66')}}</label>
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
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a85')}}</label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla2">
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
                                                            
                                                            <td>{{ $se->namedir ?? 'Pendiente' }}</td>
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
                                            <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <a href="{{ route('imprimr-formulario-docente', Crypt::encrypt($answ[0]->idansw)) }}" role="button" id="imprimir" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.a204')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></a>
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
       
        
    });
    
</script>
@endsection
