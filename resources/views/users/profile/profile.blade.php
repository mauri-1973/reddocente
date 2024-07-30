@extends('home')

@section('title')
{{ trans('multi-leng.admprof')}}
@endsection

@section('extra-css')
@endsection

@section('index')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                </div>
                <div class="card-body">
                    <div class="author">
                    <a href="#">
                        <img id="logouser" src="{{asset('storage/profile-pic')}}/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="avatar border-gray"/>
                        <h5 class="title">{{ Auth::user()->name }}</h5>
                    </a>
                    <p class="description">
                        {{ Auth::user()->cargo_us }}
                    </p>
                    </div>
                    <p class="description text-center">
                    {{ Auth::user()->name }} {{ Auth::user()->surname }}<br>{{ Auth::user()->email }}<br>{{ Auth::user()->mobile }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="">
                    <h3>
                    {{ trans('multi-leng.admprof')}}
                    </h3>
                </div>
                <div class="body">
                    <form id="form_validation" method="POST" action="{{ route('profile.update',Crypt::encrypt($user->id)) }}" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <input name="tipo" type="hidden" value="1">
                        <div class="form-group ">
                            <label class="form-label">{{ __('lang.nombreuser') }} <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->name}}" placeholder="{{ __('lang.nombreuser') }}" minlength="2" maxlength="70" required autofocus>
                            @error('name')
                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('lang.apellidouser') }} <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{$user->surname}}" placeholder="{{ __('lang.apellidouser') }}" minlength="2" maxlength="100" required autofocus>
                            @error('surname')
                                <label id="surname-error" class="error" for="surname">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label class="form-label">{{ __('lang.moviluser') }} &nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('lang.numceluser') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$user->mobile?$user->mobile:old('mobile')}}" placeholder="{{ __('lang.moviluser') }}" minlength="9" maxlength="9" pattern="\d*" title="{{ __('lang.moviluser') }}" onkeypress="return valideKeycel(event);" required>
                            @error('mobile')
                                <label id="mobile-error" class="error" for="mobile">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label class="form-label">{{ __('lang.email') }} &nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('lang.emailuser') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="{{ __('lang.email') }}" maxlength="100">
                            @error('email')
                                <label id="email-error" class="error" for="email">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label class="form-label">{{ __('multi-leng.formerror233') }} &nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror234') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="profesion" class="form-control @error('profesion') is-invalid @enderror" name="profesion" value="{{$user->profesion}}" placeholder="{{ __('multi-leng.formerror233') }}" maxlength="100">
                            @error('profesion')
                                <label id="profesion-error" class="error" for="profesion">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group" style="display:none;">
                            <label class="form-label">Aparecer en la búsqueda de conexión con otros Usuarios &nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror235') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <div class="form-check">
                                @if($user->conectar == 1)
                                <label class="form-check-label">
                                <input class="form-check-input radio-inline" type="radio" name="conectar" id="gridRadios1" value="1" checked>
                                Sí</label>
                                <label class="form-check-label">
                                <input class="form-check-input radio-inline" type="radio" name="conectar" id="gridRadios2" value="0">
                                No</label>
                                @else
                                <label class="form-check-label">
                                <input class="form-check-input radio-inline" type="radio" name="conectar" id="gridRadios1" value="1">
                                Sí</label>
                                <label class="form-check-label">
                                <input class="form-check-input radio-inline" type="radio" name="conectar" id="gridRadios2" value="0" checked>
                                No</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><b>{{ __('lang.imgpro') }}</b>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('new.tipotar24') }}" data-html="true"></i></label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar" accept=".png, .jpg, .jpeg">
                            @error('avatar')
                                <label id="avatar-error" class="error" for="avatar">{{ $message }}</label>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-sm" id="submit" type="submit">{{ __('lang.act') }}</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="">
                    <h3>
                    {{ __('multi-leng.formerror236') }}
                    </h3>
                    <button class="btn btn-success btn-sm addtags" type="button">{{ __('multi-leng.formerror59') }}</button>
                </div>
                <div class="body">
                    <table id="dt-mant-table" class="table table-borderless display nowrap p-0 m-0" style="width:100%">
                        <thead class="p-0 m-0">
                            <tr class="p-0 m-0">
                                <th scope="col" class="p-0 m-0">id</th>
                                <th scope="col" class="p-0 m-0">{{ __('multi-leng.formerror60') }}</th>
                                <th scope="col" class="p-0 m-0">{{ __('multi-leng.fechcrecat') }}</th>
                                <th scope="col" class="p-0 m-0">{{ __('multi-leng.formerror22') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        @foreach($tags as $row) 
                            <tr class="p-0 m-0">
                                <td>
                                {{ $row->idtag }}
                                </td>
                                <td>
                                {{ $row->tagnom }}
                                </td>
                                <td>
                                {{ $row->created_at->diffForHumans() }}
                                </td>
                                <td>
                                <button type="button" class="btn btn-primary btn-sm btn-block editsubcat mb-1" data-id='{{ Crypt::encrypt($row->idtag)  }}' data-nombre='{{ $row->tagnom }}'>{{ trans('multi-leng.formerror62')}}</button>
                                <button type="button" class="btn btn-danger btn-sm btn-block delsubcat mb-1" data-id='{{ Crypt::encrypt($row->idtag) }}' data-nombre='{{ $row->tagnom }}'>{{ trans('multi-leng.formerror63')}}</button>
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
<input type="hidden" name="valavatar" id="valavatar" value="">
<input type="hidden" id="status" name="status">
<div class="modal" tabindex="-1" role="dialog" id="modaliframe">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success" style="color:#fff;padding:9px 15px;border-bottom:1px solid #eee; -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;
            border-top-right-radius: 5px;">
                <h5 class="modal-title" id="modaltitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#fff;">&times;</span>
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
<script>
    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table').DataTable({
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3],
                    "visible": true,
                    "searchable": false
                },
            ],
            "dom": 'frtip', 

            "fixedHeader": true,

            "responsive": false,      

            "order": [[ 1, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });
    
    function valideKey(evt){
        
        // code is the decimal ASCII representation of the pressed key.
        var code = (evt.which) ? evt.which : evt.keyCode;
        
        if(code==8) { // backspace.
        return true;
        }
        else if(code==45) { // is a number.
        return true;
        }
        else if(code == 107) { // is a number.
        return true;
        }
        else if(code>=48 && code<=57) { // is a number.
        return true;
        } 
        else{ // other keys.
        return false;
        }
    }
    function valideKeycel(evt)
    {

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) 
        { // backspace.
            return true;
        }
        else if(code>=48 && code<=57) 
        { // is a number.
            return true;
        } 
        else
        { // other keys.
            return false;
        }
    }
    $( "#avatar" ).change(function() {
        var fileUpload = $(this)[0];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
            if (regex.test(fileUpload.value.toLowerCase())) {
                //Check whether HTML5 is supported.
                if (typeof (fileUpload.files) != "undefined") {
                    //Initiate the FileReader object.
                    var reader = new FileReader();
                    //Read the contents of Image File.
                    reader.readAsDataURL(fileUpload.files[0]);
                    reader.onload = function (e) {
                        //Initiate the JavaScript Image object.
                        var image = new Image();
                        //Set the Base64 string return from FileReader as source.
                        image.src = e.target.result;
                        image.onload = function () {
                            //Determine the Height and Width.
                            var height = this.height;
                            var width = this.width;
                            if (height != 400 || width != 400) {
                                alert("{{__('lang.textprof1')}}");
                                $( "#valavatar" ).val("{{__('lang.textprof1')}}");
                                $('#logouser').attr('src', "{{asset('storage/profile-pic')}}/{{Auth::user()->avatar}}");
                                $("#avatar").val('');
                            }
                            else{
                                $( "#valavatar" ).val('');
                                $('#logouser').attr('src', e.target.result);
                            }
                        };
                    }
                } else {
                    alert("{{__('lang.textprof2')}}");
                    $( "#valavatar" ).val("{{__('lang.textprof2')}}");
                    $('#logouser').attr('src', "{{asset('storage/profile-pic')}}/{{Auth::user()->avatar}}");
                    $("#avatar").val('');
                }
            } else {
                alert("{{__('lang.textprof3')}}");
                $( "#valavatar" ).val("{{__('lang.textprof3')}}");
                $('#logouser').attr('src', "{{asset('storage/profile-pic')}}/{{Auth::user()->avatar}}");
                $("#avatar").val('');
            }
    });
    document.querySelector('#submit').addEventListener('click', function(event) {
        if($("#avatar").val() != "" && $("#valavatar").val() != "")
        {
            alert($("#valavatar").val());
            event.preventDefault();
            return false;
        }
        else
        {
            $( "#name" ).val(escapeHtml($( "#name" ).val()));
            $( "#surname" ).val(escapeHtml($( "#surname" ).val()));
            $( "#email" ).val(escapeHtml($( "#email" ).val()));
            $( "#mobile" ).val(escapeHtml($( "#mobile" ).val()));
            return true;
        }
    });
    function escapeHtml(str) {
        var output = str.replace(/<script[^>]*?>.*?<\/script>/gi, '').
                        replace(/<[\/\!]*?[^<>]*?>/gi, '').
                        replace(/<style[^>]*?>.*?<\/style>/gi, '').
                        replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '').
            replace(/&nbsp;/g, '');
            return output;
    }

    function actualizardatos(valor, columna, tabla, idtabla, keytabla)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        var formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append('valor', valor);
        formData.append('columna', columna);
        formData.append('tabla', tabla);
        formData.append('idtabla', idtabla);
        formData.append('keytabla', keytabla);
        $.ajax({
            type: "POST",
            url: "{{url('/')}}/actualizar-ver-imagen",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
                $("#modaltitle").html("");
                $("#modaltitle").html("Vista de su Tarjeta:");
                $("#modalbody").html("");
                $("#modalbody").html('<iframe src="'+data.url+'" style="width:100%;height:830px;"></iframe>');
                $("#modalfooter").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>');
                $("#modaliframe").modal("show");
                
            },
            error: function(data, textStatus, jqXHR) {
                console.log("error actualizardatos");
            },
        });
    }

    $(".addtags").click(function(e){
        $( "#modaltitle" ).html("{{ trans('multi-leng.formerror59')}}");
        $( "#modalbody" ).html(`<form class="formaddsub" id="formaddsub" method="POST" action="{{ route('profile.update',Crypt::encrypt($user->id)) }}" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input name="tipo" type="hidden" value="2">
            <div class="form-group">
                <label for="nametopic"><b>{{ __('multi-leng.formerror60') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror61') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror60') }}" required> 
                <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
            </form>`);

        $( "#modaliframe" ).modal('show');

    });

    $(".editsubcat").click(function(e){
        var id = $(this).data("id");
        $( "#modaltitle" ).html("{{ trans('multi-leng.formerror62')}}"+$(this).data("nombre"));

        $( "#modalbody" ).html(`<form class="formedit" id="formedit" method="POST" action="{{ url('') }}/profile/${$(this).data("id")}" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input name="tipo" type="hidden" value="3">
            <div class="form-group">
                <label for="nametopic"><b>{{ __('multi-leng.formerror60') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror61') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror60') }}" value="${$(this).data("nombre")}" required> 
                <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.editar')}}</button>
            </form>`);

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#modaliframe" ).modal('show');

    });

    $(".delsubcat").click(function(e){

        var id = $(this).data("id");
        $( "#modaltitle" ).html("{{ trans('lang.eliminar')}} : "+$(this).data("nombre"));

        $( "#modalbody" ).html(`<form class="formedit" id="formedit" method="POST" action="{{ url('') }}/profile/${$(this).data("id")}" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input name="tipo" type="hidden" value="4">
            <div class="form-group">
                <label for="nametopic"><b>{{ __('multi-leng.formerror60') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror61') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror60') }}" value="${$(this).data("nombre")}" readonly> 
                <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
            </div>
            <button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button>
            </form>`);

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#modaliframe" ).modal('show');

    });
    $('#modaliframe').on('show.bs.modal', function (event) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $("#formaddsub").submit(function(e){

            $("#nametopicHelp").css("display", "none");

            var error = "";

            var validate = validarnombre($.trim($("#nametopic").val()).toUpperCase());

            if($.trim($("#nametopic").val()).length < 2)

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

                $("#nametopicHelp").html(error);

                $("#nametopicHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#nametopic").val($.trim($("#nametopic").val()).toUpperCase());

                return true;

            }

            

        });
        $("#formedit").submit(function(e){

            $("#nametopicHelp").css("display", "none");

            var error = "";

            if($.trim($("#nametopic").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if(error != "")

            {

                $("#nametopicHelp").html(error);

                $("#nametopicHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#nametopic").val($.trim($("#nametopic").val()).toUpperCase());

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

            url: '{{route("validar-nombre-tags-usuario")}}',

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
