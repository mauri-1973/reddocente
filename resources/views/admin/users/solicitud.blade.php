@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')

<style>

    #nocat

    {

       color: red;

    }

</style>

@endsection



@section('index')

<div class="content">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="">

                <a href="{{ route('agregar-usuarios-academicos') }}" class="btn btn-success btn-sm">{{ trans("multi-leng.a278")}}</a> 

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans("multi-leng.nomuser")}}</th>

                                <th>Email</th>

                                <th>Rut</th>

                                <th>{{ trans("multi-leng.a270")}}</th>

                                <th>{{ trans("multi-leng.a280")}}</th>

                                <th>{{ trans("multi-leng.admcat")}}</th>

                                <th>{{ trans("multi-leng.formerror22")}}</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($datos as $row => $r)

                            <tr>

                                <td>{{ $r['nombre'] }}</td>

                                <td>{{ $r['email'] }}</td>

                                <td>{{ $r['rut'] }}</td>

                                <td>{{ $r['tel'] }}</td>

                                <td id="td{{ $r['idsol'] }}">
                                    @if($r['estado'] == 1)
                                    Ingresada
                                    @elseif($r['estado'] == 2)
                                    Eliminada
                                    @else
                                    Sin Ingresar
                                    @endif
                                    
                                </td>

                                <td class="text-center">
                                    <div class="table-responsive">
                                        <table id="tablecat" class="table table-sm" style="width:100%">
                                        @foreach($r["cat"] as $row => $ro)
                                            <tr id="tr{{ $ro['idus'] }}{{ $ro['idcat'] }}{{ $ro['idsub'] }}tr" class="table-light">
                                                <td class="text-left">
                                                    <p><strong>{{ $ro['namecat'] }}</strong></p>
                                                    <p><strong>{{ $ro['namesub'] }}</strong></p>
                                                </td>
                                                <td id="{{ $ro['idus'] }}{{ $ro['idcat'] }}{{ $ro['idsub'] }}td">
                                                @if($ro['estadocat'] == 0)
                                                <button  class="btn btn-info btn-sm btn-block mb-1" onclick="agragarsubcat({{ $ro['idus'] }}, {{ $ro['idcat'] }}, {{ $ro['idsub'] }}, '{{ $ro['namesub'] }}', '{{ Crypt::encrypt( $ro['solicitudid'] ) }}', 'add' , {{ $r['idsol'] }} )">Agregar</button>
                                                <button  class="btn btn-warning btn-sm btn-block mb-1" onclick="agragarsubcat({{ $ro['idus'] }}, {{ $ro['idcat'] }}, {{ $ro['idsub'] }}, '{{ $ro['namesub'] }}', '{{ Crypt::encrypt( $ro['solicitudid'] ) }}', 'del', {{ $r['idsol'] }}  )">Eliminar</button>
                                                @elseif($ro['estadocat'] == 1)
                                                    Agregada
                                                @else
                                                    Eliminada
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </table>
                                    </div>
                                </td>

                                <td>

                                    @if($r['estado'] == 0)
                                    <button  class="btn btn-primary btn-sm btn-block mb-1" onclick="agragarsubcat('{{ $r['nombre'] }}', 0, 0, '{{ $r['rut'] }}', '{{ Crypt::encrypt( $r['idsol'] ) }}', 'addus', 0  )">Finalizar Solicitud</button>
                                    <button  class="btn btn-danger btn-sm btn-block" onclick="agragarsubcat('{{ $r['nombre'] }}', 0, 0, '{{ $r['rut'] }}', '{{ Crypt::encrypt( $r['idsol'] ) }}', 'delus', 0  )">Eliminar Solicitud</button>
                                    @endif
                                    @if($r['estado'] == 1)
                                    Solicitud Procesada
                                    @endif
                                    @if($r['estado'] == 2)
                                    Solicitud Eliminada
                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="modaliframe" data-backdrop="static">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header" style="color:#fff;padding:9px 15px;border-bottom:1px solid #eee;background-color: #5cb85c; -webkit-border-top-left-radius: 5px;

            -webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;

            border-top-right-radius: 5px;">

                <h5 class="modal-title" id="modaltitle">Modal title</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarmodal">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="modalbody">

                

            </div>

            <div class="modal-footer" id="modalfooter">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('lang.cancelar') }}</button>

            </div>

        </div>

    </div>

</div>

@endsection



@section('extra-script')

<script type="text/javascript">

    

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table').DataTable({

            //"dom": 'lfrtip'

            "dom": 'frtip', 

            fixedHeader: true,

            responsive: true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function agragarsubcat(idus, idcat, idsub, nombre, solicitudid, acc, idpad)
    {
        
        var url = "{{ url('/')}}/ingresar-categoria-solicitud-docente";
        let formData = new FormData();
        formData.append('idus', idus);
        formData.append('idcat', idcat);
        formData.append('idsub', idsub);
        formData.append('nametipo', nombre);
        formData.append('solicitudid', solicitudid);
        formData.append('acc', acc);
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                switch (acc) 
                {
                    case 'add':
                            
                            switch (true) 
                            {
                                case (response.status == "okingresada"):

                                    $( "#cerrarmodal" ).css('display', 'none');

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">

                                        <label class="form-label"><b>La Subcategoría, fue ingresada correctamente.</b></label>
                                        
                                    </div>`);

                                    $( "#modalfooter" ).html(` <button type="button" class="btn btn-secondary" id="btncerrar">{{ __('lang.cancelar') }}</button>`);

                                    $( "#modaliframe" ).modal('show');

                                break;

                                case (response.status == "errorcat"):
                                    
                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>La Categoría no fue encontrada</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');
                                    
                                break;

                                case (response.status == "errorresorce"):
                                    
                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>No pudo ser creado el recurso correctamente.</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');
                                    
                                break;

                                case (response.status == "errorsolicitudid"):
                                    
                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>No se encuentra disponible la solicitud.</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');
                                    
                                break

                                case (response.status == "errorsubcat"):

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>Error con la subcategoría ingresada. Inténtelo más tarde.</b></label>
                                                                
                                                            </div>`);

                                    $( "#modaliframe" ).modal('show');

                                break;

                                default:
                                $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                            <label class="form-label"><b>Error al procesar su solicitud. Inténtelo más tarde.</b></label>
                                                            
                                                        </div>`);

                                $( "#modaliframe" ).modal('show');

                                break;
                            }
                        
                    break;

                    case 'del':
                            
                            switch (true) 
                            {
                                case (response.status == "errorsolid"):
                                    
                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">

                                                                <label class="form-label"><b>Error al eliminar la Subcategoría</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');

                                break;
                                case (response.status == "soleliminada"):

                                    $( "#cerrarmodal" ).css('display', 'none');

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">

                                        <label class="form-label"><b>La Subcategoría, fue eliminada correctamente.</b></label>
                                        
                                    </div>`);

                                    $( "#modalfooter" ).html(` <button type="button" class="btn btn-secondary" id="btncerrar">{{ __('lang.cancelar') }}</button>`);

                                    $( "#modaliframe" ).modal('show');

                                break;
                                case (response.status == "errorsoleli"):
                                    
                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">

                                                                <label class="form-label"><b>Error al actualizar el estado de la subcategoría</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');

                                break;
                                case (response.status == "erroridrec"):
                                    
                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">

                                                                <label class="form-label"><b>Error al actualizar el estado de la subcategoría, al buscar el recurso asociado a ella.</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');

                                break;
                                default:

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>{{ trans("multi-leng.a14")}}</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');

                                break;
                            }
                    break;
                    case 'addus':
                            
                            switch (true) 
                            {
                                case (response.status == "erroriduser"):

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>La solicitud no puede ser ingresada mientras, no se registre al menos una subcategoría a la cual pertenesca este nuevo usuario.</b></label>
                                                            </div>`);

                                    $( "#modaliframe" ).modal('show');

                                break;
                                case (response.status == "errornumrec"):

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>Debe ingresar al menos una categoría de las indicadas en la solicitud del docente.</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');

                                break;
                                case (response.status == "okfinalizada"):

                                    $( "#cerrarmodal" ).css('display', 'none');

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>Se finalizó correctamente la solicitud de ingreso. ${response.email}</b></label>
                                                                
                                                            </div>`);
                                    $( "#modalfooter" ).html(` <button type="button" class="btn btn-secondary" id="btncerrar">{{ __('lang.cancelar') }}</button>`);

                                    $( "#modaliframe" ).modal('show');

                                break;

                                case (response.status == "errorsolicitudesdocentes"):

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>Error al finalizar el ingreso de la solicitud. Inténtelo más tarde.</b></label>
                                                                
                                                            </div>`);

                                    $( "#modaliframe" ).modal('show');

                                break;

                                default:

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                            <label class="form-label"><b>Error al procesar su solicitud. Inténtelo más tarde.</b></label>
                                                            
                                                        </div>`);

                                    $( "#modaliframe" ).modal('show');

                                break;
                                
                            }
                    break;

                    case 'delus':
                            
                            switch (true) 
                            {
                                case (response.status == "okeliminada" || response.status == "sinsol"):
                                    
                                    $( "#cerrarmodal" ).css('display', 'none');

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>La solicitud de ingreso a sido eliminada correctamente</b></label>
                                                                
                                                            </div>`);
                                    $( "#modalfooter" ).html(` <button type="button" class="btn btn-secondary" id="btncerrar">{{ __('lang.cancelar') }}</button>`);

                                    $( "#modaliframe" ).modal('show');

                                break;

                               default:

                                    $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                                    $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                                <label class="form-label"><b>{{ trans("multi-leng.a14")}}</b></label>
                                                                
                                                            </div>`);
                                    $( "#modaliframe" ).modal('show');

                                break;
                            }
                    break;
                    

                    default:
                        $( "#modaltitle" ).html('{{ trans("multi-leng.formerror46")}}');

                        $( "#modalbody" ).html(`<div class="form-group mt-2 mb-4">
                                                    <label class="form-label"><b>{{ trans("multi-leng.a14")}}</b></label>
                                                    
                                                </div>`);
                        $( "#modaliframe" ).modal('show');

                    break;
                }
            },
            error: function(response) 
            {
                console.log(response);
            }
        });
    }

    $( ".importexcel" ).on( "click", function() {
        /*let cat = json(arraycat);
        let html = '';
        Object.entries(cat).forEach(([key, value]) => {
            //console.log(`${key} ${value}`);
            html += '<optgroup label="'+cat[`${key}`]['nombrecat']+'">';
            Object.entries(cat[`${key}`]['arraysub']).forEach(([key1, value1]) => {
                html += '<option value="'+cat[`${key}`]['arraysub'][`${key1}`]['idsub']+'">'+cat[`${key}`]['arraysub'][`${key1}`]['nombresub']+'</option>';
            });
            html += '</optgroup>';
        });*/

        $( "#modaltitle" ).html('{{ trans("multi-leng.a264")}}');

        $( "#modalbody" ).html(`<form id="adddocexcel" method="POST" action="{{ route('agregar-usuarios-excel-administrador') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-2 mb-4">
                                    <label class="form-label"><b>{{ __('multi-leng.admsubcat') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror13') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                    <select class="form-control @error('subcat') is-invalid @enderror" data-btn-class="btn-success btn-block" id="subcat" name="subcat[]" multiple data-live-search="true" data-live-search-placeholder="{{ __('multi-leng.formerror12') }}">
                                    ${html}
                                    </select>
                                    <small id="error1" style="color:red"></small>
                                </div>
                                <div class="form-group mt-2 mb-4">
                                    <label class="form-label"><b>{{ __('multi-leng.a267') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a268') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                    <div class="input-group custom-file-button">
                                        <label for="docexcel" class="form-control" id="docexcel-label" role="button">{{ __('multi-leng.a266') }}</label>
                                        <label class="input-group-text" for="review-image" role="button">{{ __('multi-leng.a265') }}</label>
                                        <input type="file" class="d-none" id="docexcel" name="docexcel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    </div>
                                    <small id="error2" style="color:red"></small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">{{ trans("multi-leng.a264")}}</button>
                                </form>`);
        $( "#modaliframe" ).modal('show');

    } );

    $('#modaliframe').on('show.bs.modal', function (e) {
        $(function () {

        $('[data-toggle="tooltip"]').tooltip()

        });
         	

        $( "#btncerrar" ).on( "click", function() {

            window.location.reload();

        } );
    });
    
    

</script>

@endsection

