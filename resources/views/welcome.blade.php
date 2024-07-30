<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">
<head>

  <!-- Meta Tags -->

  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />

  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <title>{{ trans('multi-leng.salwel3')}}</title>
  <link rel="icon" href="{{asset('imagenes')}}/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('imagenes')}}/favicon1.ico" type="image/x-icon">
  <meta name="msapplication-square150x150logo" content="{{asset('imagenes')}}/ms-icon-150x150.png">
  <meta name="msapplication-square310x310logo" content="{{asset('imagenes')}}/ms-icon-310x310.png">
  <link rel="apple-touch-icon" href="{{asset('imagenes')}}/apple-icon.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('imagenes')}}/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('imagenes')}}/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('imagenes')}}/apple-icon-152x152.png">
  <link rel="icon" href="{{asset('imagenes')}}/cropped-favicon-UST-32x32.png" sizes="32x32" />

  
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('dashboard/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />  
  <style type="text/css">  
    i{  
        font-size: 50px !important;  
        padding: 10px;  
    }  
  </style>

</head>
<body style="background-color:#6922a9;">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4c0987;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
      <img src="{{url('imagenes/logo-ust.svg')}}" alt="" width="50" height="44" class="d-inline-block align-text-top">
      Universidad Santo Tomás
  </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
    </ul>
    <ul class="navbar-nav ml-auto">
    
      @if (Route::has('login'))
          @auth
            
          @else
            

          @if (Route::has('register'))
          <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{trans('multi-leng.regnav') }}</a>
          </li>
          @endif

          @endauth 
      @endif
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        {{trans('multi-leng.idi') }}
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('language','es')}}">
              {{trans('multi-leng.esp') }}
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('language','en')}}">
            {{trans('multi-leng.ing') }}
          </a>
        </div>
      </div>
    </div>

    
  </div>
</nav>

<br><br>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <div class="jumbotron" style="background-color:#6922a9;">
        <div class="lc-block d-grid gap-2 d-sm-flex justify-content-sm-center">
            <div class="overflow-hidden" style="max-height: 70vh;">
                <div class="container px-5">
                    <img class="img-fluid border rounded-3 shadow-lg mb-4" src="{{url('imagenes/docentesinno.png')}}" alt="Photo by Pankaj Patel">
                </div>
            </div>
        </div>
        <div class="lc-block d-grid gap-2 d-sm-flex justify-content-sm-center mb-1 mt-2"> 
            @auth
            <a class="btn btn-primary btn-sm px-4 gap-3" href="{{ url('/home') }}" role="button">{{ trans('multi-leng.salwel1')}} {{ Auth::user()->name }}{{ trans('multi-leng.salwel2')}}</a>
            @else
            <a class="btn btn-success btn-sm px-4" href="/login" role="button">{{trans('multi-leng.ingpla') }}</a>
            @endauth
        </div>
      </div>
    </div>
  </div>
</div>

</body>

<script src="{{asset('dashboard/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/core/bootstrap.min.js')}}"></script>

</html>
