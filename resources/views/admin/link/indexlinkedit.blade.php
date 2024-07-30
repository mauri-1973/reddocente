@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')

@endsection

@section('index')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="">
                    <h3>{{ trans('multi-leng.formerror223')}}</h3>
                </div>
                <div class="card-body">
                    <form id="form_validation" method="POST" action="{{ url('') }}/agregar-link-redireccion-admin" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="form-label"><b>URL/LINK</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror226') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="{{ __('multi-leng.formerror225') }}" aria-describedby="nameHelp" minlength="4" maxlength="70" required autofocus>
                            @error('name')
                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                            @enderror
                            <small id="nameHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">{{ trans('multi-leng.formerror227')}} URL/LINK</button>
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
    $("#form_validation").submit(function(e){

        $("#nameHelp").css("display", "none");
        var error = "";
        Var str = $.trim($("#name").val());
        if($.trim($("#name").val()).length < 4)

        {

            error += "{{ __('multi-leng.formerror228') }}<br>";
            $("#nameHelp").html("{{ __('multi-leng.formerror228') }}");
            $("#nameHelp").css("display", "block");

        }
        if(str.startsWith("www."))

        {

            error += "{{ __('multi-leng.formerror228') }}<br>";
            $("#nameHelp").html("{{ __('multi-leng.formerror228') }}");
            $("#nameHelp").css("display", "block");

        }

        if(error != "")

        {

            return false;

        }

        else

        {

            return true;

        }



    });
    
</script>
@endsection
