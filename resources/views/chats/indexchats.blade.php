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

                    <h3>{{ __('multi-leng.formerror91')}}</h3>

                    <button onclick="addcat();" class="btn btn-success btn-sm">{{ trans('multi-leng.formerror92')}}</button>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans('multi-leng.namecat')}}</th>

                                <th>{{ trans('multi-leng.fechcrecat')}}</th>

                                <th>{{ trans('multi-leng.formerror112')}}</th>

                                <th>{{ trans('multi-leng.formerror113')}}</th>

                                <th>{{ trans('multi-leng.formerror114')}}</th>

                                <th>{{ trans('multi-leng.formerror22')}}</th>

                            </tr>

                        </thead>

                        <tbody>
                            @foreach($categories as $row => $slice)
                            <tr>

                                <td>{{ $categories[$row]['namecat'] }}</td>

                                <td>{{ $categories[$row]['fecha'] }}</td>

                                <td>
                                    
                                    <button onclick="searchus('{{ Crypt::encrypt($categories[$row]['idcat'])  }}', 0);" class="btn btn-success btn-sm btn-block">{{ trans('multi-leng.formerror125')}} ({{ $categories[$row]['usact'] }})</button>

                                </td>

                                <td>
                                
                                    <button onclick="searchus('{{ Crypt::encrypt($categories[$row]['idcat'])  }}', 1);" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.formerror125')}} ({{ $categories[$row]['uspen'] }})</button>

                                </td>

                                <td>

                                    <button onclick="searchus('{{ Crypt::encrypt($categories[$row]['idcat'])  }}', 2);" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.formerror125')}} ({{ $categories[$row]['useli'] }})</button>

                                </td>

                                <td>
                                    @if($categories[$row]['usact'] > 0 )
                                    <a href="{{url('ingresar-chat-usuario-registrado', ['idcat' => Crypt::encrypt($categories[$row]['idcat'])] ) }}" class="btn btn-dark btn-sm btn-block mb-1">{{ trans('multi-leng.formerror259') }}</a>
                                    @endif
                                    <button onclick="editcat('{{ $categories[$row]['namecat'] }}', '{{ Crypt::encrypt($categories[$row]['idcat'])  }}' )" class="btn btn-info btn-sm btn-block mb-1">{{ trans('multi-leng.editarcateg') }}</button>

                                    <button onclick="elicat('{{ $categories[$row]['namecat'] }}', '{{ Crypt::encrypt($categories[$row]['idcat'])  }}' )" class="btn btn-danger btn-sm btn-block mb-1">{{ trans('multi-leng.eliminarcateg') }}</button>
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

    

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table').DataTable({

            //"dom": 'lfrtip'
            "columnDefs": [
                            { "responsivePriority": 1, targets: 0 },
                            { "responsivePriority": 2, targets: -1 },
                            { "responsivePriority": 3, targets: 2 },
                            { "responsivePriority": 4, targets: 3 },
                            { "responsivePriority": 5, targets: 4 },
                            { "responsivePriority": 6, targets: 1 },
                            
                        ],

            "dom": 'frtip', 

            "fixedHeader": true,

            "responsive": true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });

    function addcat()

    {
        var html = "";

        var select = @json($rec);

        Object.keys(select).forEach(key => {
            if(key == 0)
            {
                html += "<option value="+select[key][0]['id_sub']+" selected>"+select[key][0]['name']+"</option>";
            }
            else
            {
                html += "<option value="+select[key][0]['id_sub']+">"+select[key][0]['name']+"</option>";
            }
            
        });

        $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.admcat')}} {{ trans('multi-leng.formerror256') }}");

        $( "#modalbody" ).html(`<form id="formadd" method="POST" action="{{url('/')}}/agregar-categoria-chat-docente" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="namecat"><b>{{ trans('multi-leng.formerror257') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamecat') }}" data-html="true"></i></label>
                                    <input type="text" class="form-control" id="namecat" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror257') }}" required>
                                    <small id="nameHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror1') }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="selectcat"><b>{{ trans('multi-leng.namesubcat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror258') }}" data-html="true"></i></label>
                                    <select class="form-control" id="selectcat" name="selectcat" aria-describedby="selectHelp" required>
                                        `+html+`
                                    </select>
                                    <small id="selectHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror116') }}</small>
                                </div>
                                <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
                            </form>`);

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

        

    }

    $('#staticBackdrop').on('show.bs.modal', function (event) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $("#formadd").submit(function(e){

            $("#nameHelp").css("display", "none");
            $("#selectHelp").css("display", "none");

            var error = "";
            
            var validate = validarnombre($.trim($("#namecat").val()).toUpperCase(), $("#selectcat").val());

            if($.trim($("#namecat").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";
                $("#nameHelp").html("{{ __('multi-leng.formerror1') }}");
                $("#nameHelp").css("display", "block");

            }

            if($("#selectcat").val() == "")

            {

                error += "{{ __('multi-leng.formerror116') }}<br>";
                $("#nameHelp").html("{{ __('multi-leng.formerror116') }}");
                $("#selectHelp").css("display", "block");

            }

            if($("#status").val() == 0)

            {

                $("#nameHelp").html("{{ __('multi-leng.formerror3') }}");
                $("#nameHelp").css("display", "block");

            }

            if($("#status").val() == 2)

            {

                error += "{{ __('multi-leng.formerror3') }}<br>";
                $("#nameHelp").html("{{ __('multi-leng.formerror3') }}");
                $("#nameHelp").css("display", "block");

            }

            if(error != "")

            {

                return false;

            }

            else

            {

                $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

                return true;

            }

        });
        $("#formedit").submit(function(e){

            $("#nameHelp").css("display", "none");

            var error = "";

            var validate = validarnombre($.trim($("#namecat").val()).toUpperCase(), $("#selectcat").val());

        if($.trim($("#namecat").val()).length < 2)

        {

            error += "{{ __('multi-leng.formerror1') }}<br>";
            $("#nameHelp").html("{{ __('multi-leng.formerror1') }}");
            $("#nameHelp").css("display", "block");

        }

        if($("#selectcat").val() == "")

        {

            error += "{{ __('multi-leng.formerror116') }}<br>";
            $("#nameHelp").html("{{ __('multi-leng.formerror116') }}");
            $("#selectHelp").css("display", "block");

        }

        if($("#status").val() == 0)

        {

            $("#nameHelp").html("{{ __('multi-leng.formerror3') }}");
            $("#nameHelp").css("display", "block");

        }

        if($("#status").val() == 2)

        {

            error += "{{ __('multi-leng.formerror3') }}<br>";
            $("#nameHelp").html("{{ __('multi-leng.formerror3') }}");
            $("#nameHelp").css("display", "block");

        }

        if(error != "")

        {

            return false;

        }

        else

        {

            $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

            return true;

        }

        });

    });

    function validarnombre(nombre, categoria)

    {

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

            }

        });

        $.ajax({

            url: '{{route("validar-nombre-categoria-chats")}}',

            type: 'POST',

            async: false,

            dataType: 'json',

            data: {name: nombre, selectcat: categoria},

            success: function(data) {

                $("#status").val(data.status);

            },

            error:function(x,xs,xt){

                //console.log(JSON.stringify(x));

                console.log("error validarnombre")

                $("#status").val(0);

            }

        });

    }

    function searchus(idcar, tipo)
    {
        
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

            }

        });

        $.ajax({

            url: '{{route("busquedas-info-chats-docentes")}}',

            type: 'POST',

            async: false,

            dataType: 'json',

            data: {idcat: idcar, tipo: tipo},

            success: function(data) {

                if(data.tipo == 0)
                {
                    if(data.count == 0)
                    {
                        $( "#staticBackdropLabel" ).html("{{ __('multi-leng.formerror121') }}");

                        $( "#modalbody" ).html("<strong>{{ __('multi-leng.formerror260') }}</strong>");

                        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                        $( "#staticBackdrop" ).modal('show');
                    }
                    else
                    {
                        window.location.href = '{{ url("/") }}/listado-usuarios-estado-ingreso-chat-docentes/'+idcar+'/'+tipo;
                    }
                }
                if(data.tipo == 1)
                {
                    if(data.count == 0)
                    {
                        $( "#staticBackdropLabel" ).html("{{ __('multi-leng.formerror121') }}");

                        $( "#modalbody" ).html("<strong>{{ __('multi-leng.formerror261') }}</strong>");

                        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                        $( "#staticBackdrop" ).modal('show');
                        
                    }
                    else
                    {
                        window.location.href = '{{ url("/") }}/listado-usuarios-estado-ingreso-chat-docentes/'+idcar+'/'+tipo;
                    }
                }
                if(data.tipo == 2)
                {
                    if(data.count == 0)
                    {
                        $( "#staticBackdropLabel" ).html("{{ __('multi-leng.formerror121') }}");

                        $( "#modalbody" ).html("<strong>{{ __('multi-leng.formerror262') }}</strong>");

                        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                        $( "#staticBackdrop" ).modal('show');
                    }
                    else
                    {
                        window.location.href = '{{ url("/") }}/listado-usuarios-estado-ingreso-chat-docentes/'+idcar+'/'+tipo;
                    }
                }
                if(data.tipo == 3)
                {
                    if(data.count == 0)
                    {
                        $( "#staticBackdropLabel" ).html("{{ __('multi-leng.formerror121') }}");

                        $( "#modalbody" ).html("<strong>{{ __('multi-leng.formerror126') }}</strong>");

                        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                        $( "#staticBackdrop" ).modal('show');
                    }
                    else
                    {

                    }
                }

            },

            error:function(x,xs,xt){

                //console.log(JSON.stringify(x));

                console.log("error validarnombre");

            }

        });
        
    } 

</script>

@endsection
