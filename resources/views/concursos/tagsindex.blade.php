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
                    <h3>{{ trans('multi-leng.formerror59')}}</h3>
                    <button onclick="addcat();" class="btn btn-success btn-sm">{{ trans('multi-leng.formerror59')}}</button>
                </div>
                <div class="card-body">
                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{ trans('multi-leng.formerror60')}}</th>
                            <th>{{ trans('multi-leng.fechcrecat')}}</th>
                            <th style="width: 40px">{{ trans('multi-leng.formerror22')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->tagnom }}</td>
                                <td>{{ $tag->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    @if($tag->tagidus == Auth::user()->id)
                                    <button type="button" class="btn btn-success btn-sm btn-block editcat mb-1" data-id='{{ $tag->idtag }}' data-nombre='{{ $tag->tagnom }}'>{{ trans('multi-leng.formerror62')}}</button>
                                    <button type="button" class="btn btn-danger btn-sm btn-block delcat" data-id='{{ $tag->idtag }}' data-nombre='{{ $tag->tagnom  }}'>{{ trans('multi-leng.formerror63')}}</button>
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
        $( "#staticBackdropLabel" ).html("Tags");
        $( "#modalbody" ).html('<form id="formadd" method="POST" action="{{ url('') }}/ingreso-tag-administrador" enctype="multipart/form-data">@csrf<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror59')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror61') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror59') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button></form></div>');
        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
        $( "#staticBackdrop" ).modal('show');
        
    }
    $(".editcat").click(function(e){
        $( "#staticBackdropLabel" ).html("{{ trans('lang.editar')}}: "+$(this).data("nombre"));
        $( "#modalbody" ).html('<form class="formeditcat" method="POST" action="{{ url('') }}/editar-tag-administrador" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror62')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror61') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" value="'+$(this).data("nombre")+'" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror62') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button></form></div>');
        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
        $( "#staticBackdrop" ).modal('show');
    });
    $(".delcat").click(function(e){
        $( "#staticBackdropLabel" ).html("{{ trans('lang.eliminar')}}: "+$(this).data("nombre"));
        $( "#modalbody" ).html('<form class="formdelcat" method="POST" action="{{ url('') }}/eliminar-tag-administrador" enctype="multipart/form-data">@csrf<input type="hidden" id="idcat" name="idcat" value="'+$(this).data("id")+'"><div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.formerror62')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror61') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" value="'+$(this).data("nombre")+'" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror62') }}" required readonly><small id="nameHelp" class="form-text text-danger" style="display:none;"></small></div><div class="form-group"><p><b>{{ __('multi-leng.formerror9') }}</b></p><button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button></form></div>');
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
            url: '{{route("validar-nombre-tag-administrador")}}',
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
