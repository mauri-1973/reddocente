@extends('layouts.app')
@section('extra-css')


<link href="https://cdn.staticfile.org/select2/3.4.1/select2.css" rel="stylesheet" type="text/css"/>
<style>
    select {
  width: 100%;
}
</style>
@endsection
@section('content')
<br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header bg-success my-auto">
                    <a href="{{ route('welcome') }}" class="my-auto" style="font-size:18px;">
                        <img src="{{url('imagenes/logo-ust.svg')}}" alt="" width="50" height="44" class="d-inline-block align-text-top">
                        Universidad Santo Tomás
                    </a>
                </div>
                <div class="card-header">                     
                    <h4 class="" style="text-align:center;">{{trans('multi-leng.ingnav') }}</h4>
                </div>

               
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('multi-leng.emadir') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('multi-leng.emadir') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('multi-leng.pasuser') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('multi-leng.pasuser') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="display:none;">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-control" type="checkbox" name="remember" id="remember" checked>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                {{trans('multi-leng.ingnav') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link bg-success btn-sm text-white" href="{{ route('password.request') }}">
                                        {{ trans('multi-leng.olvcon') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-dark btn-sm btn-block" id="modalup">
                                    Solicitud de Registro sólo Docentes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="sendModalBody">
        
            
      </div>
      <div class="modal-footer" id="sendModalFooter">
        
      </div>
    </div>
  </div>
</div>
@endsection



@section('extra-script')

<script src="https://cdn.staticfile.org/select2/3.4.1/select2.js"></script>


<script type="text/javascript">

    

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip();

        });
        (function() 
        {
            $(function() {
                return $('select').select2({
                width: 'resolve'
                });
            });

        }).call(this); 
    }); 
    function valideKeycel(evt)

    {

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
    document.querySelector('#modalup').addEventListener('click', function(event) {
        $("#sendModalLabel").html('Solicitud Ingreso Sólo Docentes');
        $("#sendModalBody").html(`<div class="form-group">
                <label for="nombre"><b>Ingrese su Nombre</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre completo" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="xxxxxxxxxx xxxxxxxx xxxxxxxxx" minlength="75" maxlength="75">
                <span>
                    <strong class="text-danger" id="error1"></strong>
                </span>
            </div>
            <div class="form-group">
                <label for="emailform"><b>Ingrese su Email</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Ingrese un email válido" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="email" class="form-control" id="emailform" name="emailform" placeholder="xxxxxxxxxx@reddocente.cl" minlength="100" maxlength="100">
                <span>
                    <strong class="text-danger" id="error2"></strong>
                </span>
            </div>
            <div class="form-group">
                <label for="rut"><b>Ingrese su Rut</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Ingrese su rut válido con formato chileno, sin puntos." data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="rut" name="rut" placeholder="11111111-1" minlength="9" maxlength="10"  onkeypress="return valideKey(event);">
                <span>
                    <strong class="text-danger" id="error3"></strong>
                </span>
            </div>
            <div class="form-group">
                <label for="rut"><b>Ingrese su Tel/Cel</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Ingrese su número telefónico de contacto de 9 dígitos" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="935648836" minlength="9" maxlength="9" onkeypress="return valideKeycel(event);" pattern="\d*" title="{{ __('lang.moviluser') }}">
                <span>
                    <strong class="text-danger" id="error4"></strong>
                </span>
            </div>
            <div class="form-group" id="divotros" style="display:none;">
                <label for="rut"><b>Otras Áreas</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Ingrese el ärea no registrada a la cual Usted pertenece" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="otrascat" name="otrascat" placeholder="XXXXXXXXXXXXXXX" minlength="2" maxlength="50">
                <span>
                    <strong class="text-danger" id="error5"></strong>
                </span>
            </div>
            <div class="form-group">
                <label for="subcat" class="form-label"><b>Seleccione su Área</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror13') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <select data-placeholder="{{ __('multi-leng.formerror12') }}" class="form-control @error('subcat') is-invalid @enderror" id="subcat" name="subcat[]" multiple>
                    @foreach($arraycat as $p => $slice)
                    <optgroup label="{{ $arraycat[$p]['nombrecat'] }}">
                        @foreach($arraycat[$p]['arraysub'] as $d => $sli)
                        <option value="({{ $arraycat[$p]['nombrecat'] }})-{{ $arraycat[$p]['arraysub'][$d]["nombresub"] }}*{{$arraycat[$p]['idcat']}}-{{ $arraycat[$p]['arraysub'][$d]["idsub"]  }}">{{ $arraycat[$p]['arraysub'][$d]["nombresub"] }}</option>
                        @endforeach idcat
                    </optgroup>
                    
                    @endforeach
                    <option value="(otras)" id="mostrarinput">Otras.....</option>
                </select>
                <span>
                    <strong class="text-danger" id="error6"></strong>
                </span>
            </div>`);
            $("#sendModalFooter").html(`<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-sm" id="enviar">Enviar</button>`);
        $("#sendModal").modal('show');
    });

    $('#sendModal').on('show.bs.modal', function (e) {
        $(function () {

            $('[data-toggle="tooltip"]').tooltip();

        });
        document.querySelector('#mostrarinput').addEventListener('click', function(event) {
            $("#divotros").css('display', 'block');
        });
        (function() {
            $(function() {
                return $('select').select2({
                width: 'resolve'
                });
            });

        }).call(this);
        document.querySelector('#enviar').addEventListener('click', function(event) {
            
            $("#error1").html('');
            $("#error2").html('');
            $("#error3").html('');
            $("#error4").html('');
            $("#error5").html('');
            $("#error6").html('');
            
            var isProperEmail = new RegExp(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/);
            let otra = '';
            var error = "";
            $('#subcat > :selected').each(function() {
                if($(this).text() == 'Otras.....')
                {
                    otra = 'ok';
                    $("#divotros").css('display', 'block');
                }
            });
            if(otra == '')
            {
                $("#divotros").css('display', 'none');
                $("#otrascat").val('');
                $("#error5").html('');
            }
            if($.trim($("#nombre").val()).length < 2)
            {
                $("#error1").html('-. Ingrese un nombre de al menos 2 caracteres');
                error += "-. Ingrese un nombre de al menos 2 caracteres";
            }
            if(!isProperEmail.test($("#emailform").val())) 
            {
                $("#error2").html('-. El correo electrónico (email 1) introducido no es correcto');
                error += "-. El correo electrónico introducido no es correcto<br>";
            }
            if (!Fn.validaRut( $("#rut").val() ) && $.trim($("#rut").val()).length >= 0)
            {
                $("#error3").html('-. Ingrese un rut válido');
                error += "-. Ingrese un rut válido";
            }
            if($.trim($("#tel").val()).length < 9)
            {
                $("#error4").html('-. Ingrese un número telefónico válido');
                error += "-. Ingrese un número telefónico válido<br>";
            }
            if($.trim($("#subcat").val()).length == 0)
            {
                $("#error6").html('-. Seleccione al menos un Área');
                error += "-. Ingrese una dirección válida<br>";
            }
            if($.trim($("#otrascat").val()).length == 0 && otra != '')
            {
                $("#error5").html('-. Ingrese su Área manualmente');
                error += "-. Ingrese una dirección válida<br>";
            }
            if(error != "")
            {
                
                return false;
            }
            else
            {
                
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var formData = new FormData();

                formData.append('nombre', $("#nombre").val());
                formData.append('email', $("#emailform").val());
                formData.append('rut', $("#rut").val());
                formData.append('tel', $("#tel").val());
                formData.append('subcat', $("#subcat").val());
                formData.append('otra', otra);
                formData.append('otrascat', $("#otrascat").val());
                
                
                var type = "POST";
                var ajaxurl = `{{ url('/') }}/ingresar-solicitud-docente-cuenta`;
                $.ajax({
                type: type,
                url: ajaxurl,
                data:formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (data) {
                    if(data.status == '')
                    {
                        $("#sendModalLabel").html('Estimado(a): '+$("#nombre").val());
                        $("#sendModalBody").html(`<div class="form-group">
                                <span>
                                    <strong class="text-danger" id="error1">Se ha enviado la información al administrador de la Plataforma de manera correcta. Pronto tendrá noticias sobre su solicitud en el email ${$("#emailform").val()}</strong>
                                </span>
                            </div>`);
                            $("#sendModalFooter").html(`<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>`);
                    }
                    else
                    {
                        $("#error2").html(data.email);
                        $("#error3").html(data.rut);
                        $("#error4").html(data.cel);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
                });
            }
        });
    })

</script>



@endsection
