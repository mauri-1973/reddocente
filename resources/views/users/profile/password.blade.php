@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')

@endsection



@section('index')

<div class="content">

    <div class="row">

        <div class="col-md-4">

            <div class="card card-user">

                <div class="image">

                    <!-- <img src="../assets/img/damir-bosnjak.jpg" alt="..."> -->

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

                <div class="alert alert-info text-dark" role="alert">

                {{ __('lang.mensajeemail') }}

                </div>

                <div class="">

                    <h3>

                    {{ __('lang.chapass') }}

                    </h3>

                </div>

                <div class="body">

                    <form id="form_validation" method="POST" action="{{ route('profile-update-pass') }}" enctype="multipart/form-data">

                    @csrf

                    <input name="_method" type="hidden" value="PUT">

                    <input name="id" type="hidden" value="{{ $user->id }}">

                        <div class="form-group ">

                            <label class="form-label">{{ __('lang.chapassold') }}</label>

                            <input type="password" class="form-control @error('passwordold') is-invalid @enderror" name="passwordold" id="passwordold" value="" placeholder="{{ __('lang.chapassold') }}" required autofocus>

                            @error('passwordold')

                                <label id="passwordold-error" class="error" for="passwordold">{{ $message }}</label>

                            @enderror

                        </div>



                        <div class="form-group ">

                            <label class="form-label">{{ __('lang.chapassnew') }}</label>

                            <input type="password" class="form-control @error('passwordnew') is-invalid @enderror" name="passwordnew" id="passwordnew" value="" placeholder="{{ __('lang.chapassnew') }}"  minlength=6 maxlength=15  required autofocus>

                            @error('passwordnew')

                                <label id="passwordnew-error" class="error" for="passwordnew">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group ">

                            <label class="form-label">{{ __('lang.chapassnewc') }}</label>

                            <input type="password" class="form-control @error('passwordnewc') is-invalid @enderror" name="passwordnewc" id="passwordnewc" value="" placeholder="{{ __('lang.chapassnewc') }}"  minlength=6 maxlength=15 required autofocus>

                            @error('passwordnewc')

                                <label id="passwordnewc-error" class="error" for="passwordnewc">{{ $message }}</label>

                            @enderror

                        </div>

                        <div class="form-group ">

                            <button class="btn btn-primary btn-sm" id="submit" type="submit" disabled>{{ __('lang.act') }}</button>

                        </div>

                        



                        

                    </form>

                    @if (Session::has("failed"))

                        <div class="alert alert-danger alert-dismissible">

                            <button type="button" class="close" data-dismiss="alert">&times;</button>

                            <strong>Acción finalizada!</strong> {{ Session::get('failed') }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('extra-script')

<script>

    $(function () {

        $('[data-toggle="tooltip"]').tooltip()

    });

    document.querySelector('#submit').addEventListener('click', function(event) {

        

        $( "#passwordold" ).val(escapeHtml($( "#passwordold" ).val()));

        $( "#passwordnew" ).val(escapeHtml($( "#passwordnew" ).val()));

        $( "#passwordnewc" ).val(escapeHtml($( "#passwordnewc" ).val()));

        return true;

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







