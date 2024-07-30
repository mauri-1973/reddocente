@extends('home')



@section('title')

	User

@endsection



@section('extra-css')



@endsection



@section('index')

<div class="content">



    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="">

                    <h3>

                    {{ __('lang.addnewuser') }} ({{ trans('multi-leng.menu1')}})

                    </h3>

                </div>

                <div class="card-body">

                    <form id="form_validation" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="tipo" id="tipo" value="5">

                        <div class="form-group">

                            <label class="form-label"><b>{{ __('lang.imgpro') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('new.tipotar24') }}" data-html="true"></i></label>

                            <img style="width:200px;border: 1px solid #555;" src="{{ asset('imagenes') }}/sinregistro.png" class="rounded mx-auto d-block mb-2" alt="..." id="cambiologo">

                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar" accept=".png, .jpg, .jpeg">

                            @error('avatar')

                                <label id="avatar-error" class="error" for="avatar">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group">

                            <div>

                                <label class="form-label"><b>{{ __('new.tipotar27') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('new.tipotar32') }}" data-html="true"></i></label>

                            </div>

                            <div class="form-check-inline pt-1">

                                <label class="form-check-label">

                                    <input type="radio" class="form-check-input" id="sendmail1" name="sendmail" value="1">&nbsp;{{ __('new.tipotar28') }}

                                </label>

                            </div>

                            <div class="form-check-inline pt-1">

                                <label class="form-check-label">

                                    <input type="radio" class="form-check-input" id="sendmail2" name="sendmail" value="0" checked>&nbsp;No

                                </label>

                            </div>

                        </div>

                        

                        <div class="form-group">

                            <label class="form-label"><b>{{ __('lang.nombreuser') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>

                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="{{ __('lang.nombreuser') }}" minlength="2" maxlength="70" required autofocus>

                            @error('name')

                                <label id="name-error" class="error" for="name">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group">

                            <label class="form-label"><b>{{ __('lang.apellidouser') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>

                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname')}}" placeholder="{{ __('lang.apellidouser') }}" minlength="2" maxlength="70" required autofocus>

                            @error('surname')

                                <label id="surname-error" class="error" for="surname">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group">

                            <label class="form-label"><b>{{ __('lang.moviluser') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('lang.numceluser') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>

                            <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{old('mobile')}}" placeholder="{{ __('lang.moviluser') }}" minlength="9" maxlength="9" pattern="\d*" title="{{ __('lang.moviluser') }}" onkeypress="return valideKeycel(event);" autofocus required>

                            @error('mobile')

                                <label id="mobile-error" class="error" for="mobile">{{ $message }}</label>

                            @enderror

                        </div>



                        <div class="form-group">

                            <label class="form-label"><b>{{ __('lang.email') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('lang.emailuser') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" placeholder="{{ __('lang.email') }}" maxlength="100" onfocus="this.value=''" autofocus required>

                            @error('email')

                                <label id="email-error" class="error" for="email">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group">

                            <label class="form-label"><b>{{ __('multi-leng.pasuser') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracterespass') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>

                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"  name="password" placeholder="Password" minlength="6" maxlength="10" onfocus="this.value=''" autofocus required>

                            @error('password')

                                <label id="password-error" class="error" for="name">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group" style="display:none;">

                            <label class="form-label"><b>Rol</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.indiquerol') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>

                            <select class="form-control" name="roles[]" id="roles" autofocus required>

                                @foreach($roles as $role)

                                    @if($role == "revisor")

                                    <option value="{{ $role }}" selected>{{ __('multi-leng.multi2') }}</option>

                                    @endif

                                @endforeach

                            </select>

                                @error('roles')

                                <label id="roles-error" class="error" for="email">{{ $message }}</label>

                            @enderror

                        </div>

                        <button class="btn btn-primary btn-sm" type="submit">{{ __('lang.addnewuser') }}</button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- #END# Vertical Layout -->



</div>

<input type="hidden" name="valavatar" id="valavatar" value="">

<div class="modal" tabindex="-1" role="dialog" id="modaliframe">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header" style="color:#fff;padding:9px 15px;border-bottom:1px solid #eee;background-color: #5cb85c; -webkit-border-top-left-radius: 5px;

            -webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;

            border-top-right-radius: 5px;">

                <h5 class="modal-title" id="modaltitle">Modal title</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

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

        $('#subcat').extendSelect({

            // Search input placeholder:

            search: '{{ __('multi-leng.formerror12') }}',

            // Title if option not selected:

            notSelectedTitle: '{{ __("multi-leng.formerror10") }}',

            // Message if select list empty:

            empty: '{{ __("multi-leng.formerror11") }}',

            // Class to active element

            activeClass: 'active',

            // Class to disabled element

            disabledClass: 'disabled',

            // Custom error message for all selects (use placeholder %items)

            maxOptionMessage: 'Max %items elements',

            // Delay to hide message

            maxOptionMessageDelay: 2000,

            // Popover logic (resize or save height)

            popoverResize: true,

            // Auto resize dropdown by button width

            dropdownResize: true

        }); 

       

    });

    var foption = $('#roles option:first');

    var soptions = $('#roles option:not(:first)').sort(function (a, b) {

        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1

    });

    $('#roles').html(soptions).prepend(foption);

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

                            $('#cambiologo').attr('src', "{{ asset('imagenes') }}/sinregistro.png");

                            $("#avatar").val('');

                        }

                        else{

                            $( "#valavatar" ).val('');

                            $('#cambiologo').attr('src', e.target.result);

                        }

                    };

                }

            } else {

                alert("{{__('lang.textprof2')}}");

                $( "#valavatar" ).val("{{__('lang.textprof2')}}");

                $('#cambiologo').attr('src', "{{ asset('imagenes') }}/sinregistro.png");

                $("#avatar").val('');

            }

        } else {

            alert("{{__('lang.textprof3')}}");

            $( "#valavatar" ).val("{{__('lang.textprof3')}}");

            $('#cambiologo').attr('src', "{{ asset('imagenes') }}/sinregistro.png");

            $("#avatar").val('');

        }

    });

    $( "#form_validation" ).submit(function( event ) 

        {

            var isProperEmail = new RegExp(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/);

            var error = "";

            if($.trim($("#name").val()).length < 2)

            {

                error += "-. Ingrese un nombre válido<br>";

            }

            if($.trim($("#surname").val()).length < 2)

            {

                error += "-. Ingrese un apellido válido<br>";

            }

            if($.trim($("#password").val()).length < 6)

            {

                error += "-. Ingrese una contaseña válido de al menos 6 caracteres.<br>";

            }

            if(!isProperEmail.test($("#email").val())) 

            {

                error += "-. El correo electrónico introducido no es correcto<br>";

            }

            if(error != "")

            {

                    $.notify({

                        // options

                        title: '<h5><strong>Estimado Usuario: </strong></h5>',

                        message: 'Para editar al usuario seleccionado debe solucionar los siguientes errores:<br>'+

                                  error+

                                 '<br><br><br>',

                        icon: 'fa fa-exclamation-circle'

                    },{

                        // settings

                        element: 'body',

                        //position: null,

                        type: "success",

                        //allow_dismiss: true,

                        //newest_on_top: false,

                        showProgressbar: true,

                        placement: {

                            from: "top",

                            align: "center"

                        },

                        offset: 20,

                        spacing: 20,

                        z_index: 1031,

                        delay: 3300,

                        timer: 2000,

                        mouse_over: null,

                        animate: {

                            enter: 'animated fadeInDown',

                            exit: 'animated fadeOutRight'

                        },

                        onShow: null,

                        onShown: null,

                        onClose: null,

                        onClosed: null,

                        icon_type: 'class',

                    });

                return false;

            }

            else

            {

                $( "#name" ).val(escapeHtml($( "#name" ).val()));

                $( "#surname" ).val(escapeHtml($( "#surname" ).val()));

                $( "#email" ).val(escapeHtml($( "#email" ).val()));

                $( "#mobile" ).val(escapeHtml($( "#mobile" ).val()));

                $( "#tipo" ).val(escapeHtml($( "#tipo" ).val()));

                $( "#password" ).val(escapeHtml($( "#password" ).val()));

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

</script>



@endsection

