@extends('layouts.app')

@section('content')
<br><br>
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
                    <h4 class="" style="text-align:center;">{{trans('multi-leng.regnav') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label"><b>{{ __('lang.nombreuser') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{trans('lang.nombreuser') }}" minlength="2" maxlength="50" required autocomplete="{{trans('lang.nombreuser') }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><b>{{ __('lang.apellidouser') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input id="name" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" placeholder="{{trans('lang.apellidouser') }}" minlength="2" maxlength="50" required autocomplete="{{trans('lang.apellidouser') }}" autofocus>
                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><b>{{ __('lang.email') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('lang.emailuser') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" minlength="2" maxlength="50" required autocomplete="Email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><b>{{ __('lang.moviluser') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('lang.numceluser') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{old('mobile')}}" placeholder="{{trans('lang.moviluser') }}" minlength="9" maxlength="9" pattern="\d*" title="{{trans('lang.menemp') }}" onkeypress="return valideKeycel(event);"  required>
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><b>{{ __('multi-leng.formerror297') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror298') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                                <option value="1" selected>{{ __('multi-leng.formerror299') }}</option>
                                <option value="2">{{ __('multi-leng.formerror300') }}</option>
                                <option value="3">{{ __('multi-leng.formerror301') }}</option>
                                <option value="4">{{ __('multi-leng.formerror302') }}</option>
                                <option value="5">{{ __('multi-leng.formerror303') }}</option>
                            </select>
                            @error('tipo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="display:none;" id="divotros">
                            <label for="otros" class="col-form-label text-md-right"><b>{{ __('multi-leng.formerror304') }}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror298') }}" data-html="true"></i> &nbsp;<small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="text" class="form-control @error('otros') is-invalid @enderror" id="otros" name="otros" value="{{old('otros')}}" placeholder="{{ __('multi-leng.formerror304') }}" minlength="2" maxlength="50" title="{{trans('lang.menemp') }}">
                            @error('otros')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label text-md-right"><b>{{ __('multi-leng.pasuser') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracterespass') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="6" maxlength="12" placeholder="{{trans('lang.respassc') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label text-md-right"><b>{{ __('multi-leng.formerror305') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracterespass') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="{{ __('multi-leng.formerror305') }}" minlength="6" maxlength="12" required autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-success">{{trans('lang.textprof7') }}</button>
                    </form>
                </div>
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

    });
    $("#tipo").change(function(){
        if($(this).val() == 3 || $(this).val() == 4 || $(this).val() == 5)
        {
            $("#divotros").css("display", "block");
            $("#otros").val("");
        }
        else
        {
            $("#divotros").css("display", "none");
            $("#otros").val("");
        }
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

</script>

@endsection
