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

                    <h3>{{ trans('multi-leng.admcat')}}</h3>

                    <button onclick="addcat();" class="btn btn-success btn-sm">{{ trans('multi-leng.addadmcat')}}</button>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans('multi-leng.admcat')}}</th>

                                <th>{{ trans('multi-leng.admsubcat')}}</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($arreglo as $p => $slice)

                            <tr> 

                                <td style="width:35%;">

                                    <table class="table table-borderless">

                                        <thead>

                                            <tr>

                                                <th scope="col">

                                                    {{ $arreglo[$p]['nombrecat'] }}

                                                </th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td>

                                                    {{ trans('multi-leng.fechcrecat')}} <b>{{ $arreglo[$p]['fechacat'] }}</b>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <button type="button" class="btn btn-primary btn-sm btn-block editcat" data-id='{{ $arreglo[$p]["idcat"] }}' data-nombre='{{ $arreglo[$p]["nombrecat"] }}'>{{ trans('multi-leng.editarcateg')}}</button>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <button type="button" class="btn btn-danger btn-sm btn-block delcat" data-id='{{ $arreglo[$p]["idcat"] }}' data-nombre='{{ $arreglo[$p]["nombrecat"] }}'>{{ trans('multi-leng.eliminarcateg')}}</button>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                <button type="button" data-id='{{ $arreglo[$p]["idcat"] }}' data-nombre='{{ $arreglo[$p]["nombrecat"] }}' class="btn btn-success btn-sm btn-block btnadd" >{{ trans('multi-leng.addsubcatbtn')}}</button>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </td>

                                <td>

                                    <div class="container">

                                        <div class="row">

                                            @foreach($arreglo[$p]['arreglosub'] as $d => $sli)

                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                <table class="table table-striped">

                                                    <thead>

                                                        <tr>

                                                            <th scope="col">{{ $arreglo[$p]['arreglosub'][$d]["nombresub"] }}</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                {{ trans('multi-leng.fechcrecat')}} <b>{{ $arreglo[$p]['arreglosub'][$d]['fechasub'] }}</b>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                <button type="button" class="btn btn-primary btn-sm btn-block editsubcat" data-id='{{ $arreglo[$p]['arreglosub'][$d]['idsub']  }}' data-nombre='{{ $arreglo[$p]['arreglosub'][$d]['nombresub'] }}'>{{ trans('multi-leng.editarsubcateg')}}</button>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                <button type="button" class="btn btn-danger btn-sm btn-block delsubcat" data-id='{{ $arreglo[$p]['arreglosub'][$d]['idsub']  }}' data-nombre='{{ $arreglo[$p]['arreglosub'][$d]['nombresub'] }}'>{{ trans('multi-leng.eliminarsubcateg')}}</button>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </table>

                                                <hr style="height:2px; width:100%; border-width:0; color:gray; background-color:gray">

                                            </div>

                                            @endforeach

                                        </div>

                                    </div>

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

<!-- Modal -->

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

  <div class="modal-dialog">

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

<input type="hidden" id="status" name="status">

@endsection



@section('extra-script')

<script type="text/javascript">

    $(function () {

        $('[data-toggle="tooltip"]').tooltip()

    });

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

    function addcat()

    {

        $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.admcat')}}");

        $( "#modalbody" ).html('<form id="formadd" method="POST" action="{{ url('') }}/ingreso-categoria-admin" enctype="multipart/form-data">@csrf<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namecat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamecat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namecat') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button></form></div>');

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

        

    }

    

    $(".btnadd").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.addsubcatto')}}"+$(this).data("nombre"));

        $( "#modalbody" ).html('<form class="formaddsub" method="POST" action="{{ url('') }}/ingreso-sub-categoria-admin" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namesubcat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamesubcat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button></form></div>');

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });

    

    $(".editsubcat").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.textosref1')}}"+$(this).data("nombre"));

        $( "#modalbody" ).html('<form class="formaddsub" method="POST" action="{{ url('') }}/editar-sub-categoria-admin" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namesubcat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamesubcat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" name="namecat" value="'+$(this).data("nombre")+'" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.editar')}}</button></form></div>');

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });



    $(".editcat").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('lang.editar')}}: "+$(this).data("nombre"));

        $( "#modalbody" ).html('<form class="formeditcat" method="POST" action="{{ url('') }}/editar-categoria-admin" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namecat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamecat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" value="'+$(this).data("nombre")+'" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button></form></div>');

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });



    $(".delcat").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('lang.eliminar')}}: "+$(this).data("nombre"));

        $( "#modalbody" ).html('<form class="formdelcat" method="POST" action="{{ url('') }}/eliminar-categoria-admin" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namesubcat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamesubcat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" value="'+$(this).data("nombre")+'" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required readonly><small id="nameHelp" class="form-text text-danger" style="display:none;"></small></div><div class="form-group"><p>{{ __('multi-leng.formerror4') }}</p><p><b>{{ __('multi-leng.formerror5') }}</b></p><p><b>{{ __('multi-leng.formerror6') }}</b></p><p><b>{{ __('multi-leng.formerror7') }}</b></p><p><b>{{ __('multi-leng.formerror8') }}</b></p><p><b>{{ __('multi-leng.formerror9') }}</b></p><button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button></form></div>');

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });



    $(".delsubcat").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('lang.eliminar')}}: "+$(this).data("nombre"));

        $( "#modalbody" ).html('<form class="formdelcat" method="POST" action="{{ url('') }}/eliminar-sub-categoria-admin" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namesubcat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamesubcat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" value="'+$(this).data("nombre")+'" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required readonly><small id="nameHelp" class="form-text text-danger" style="display:none;"></small></div><div class="form-group"><p>{{ __('multi-leng.formerror4') }}</p><p><b>{{ __('multi-leng.formerror5') }}</b></p><p><b>{{ __('multi-leng.formerror6') }}</b></p><p><b>{{ __('multi-leng.formerror7') }}</b></p><p><b>{{ __('multi-leng.formerror8') }}</b></p><p><b>{{ __('multi-leng.formerror9') }}</b></p><button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button></form></div>');

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });

    

    $('#staticBackdrop').on('show.bs.modal', function (event) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $("#formadd").submit(function(e){

            $("#nameHelp").css("display", "none");

            var error = "";

            var validate = validarnombre($.trim($("#namecat").val()).toUpperCase());

            if($.trim($("#namecat").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if($("#status").val() == 0)

            {

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($("#status").val() == 2)

            {

                error += "{{ __('multi-leng.formerror3') }}<br>";

            }

            if(error != "")

            {

                $("#nameHelp").html(error);

                $("#nameHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

                return true;

            }

            

        });

        $(".formeditcat").submit(function(e){

            $("#nameHelp").css("display", "none");

            var error = "";

            var validate = validarnombre($.trim($("#namecat").val()).toUpperCase());

            if($.trim($("#namecat").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if($("#status").val() == 0)

            {

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($("#status").val() == 2)

            {

                error += "{{ __('multi-leng.formerror3') }}<br>";

            }

            if(error != "")

            {

                $("#nameHelp").html(error);

                $("#nameHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

                return true;

            }

        });



        $(".formaddsub").submit(function(e){

            $("#nameHelp").css("display", "none");

            var error = "";

            if($.trim($("#namecat").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if(error != "")

            {

                $("#nameHelp").html(error);

                $("#nameHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

                return true;

            }

            

        });

        

    });

    function validarnombre(nombre)

    {

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

            }

        });

        $.ajax({

            url: '{{route("validar-nombre-categoria")}}',

            type: 'POST',

            async: false,

            dataType: 'json',

            data: {name: nombre},

            success: function(data) {

                $("#status").val(data.val);

            },

            error:function(x,xs,xt){

                //console.log(JSON.stringify(x));

                console.log("error validarnombre")

                $("#status").val(0);

            }

        });

    }

    

</script>

@endsection

