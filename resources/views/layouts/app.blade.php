<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">
<head>

  <!-- Meta Tags -->

  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />

  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <title>
    {{ trans('multi-leng.salwel3')}}
    @yield('title')
  </title>
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
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{asset('dashboard/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('dashboard/assets/css/paper-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
  
  <link href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-hardskilled-extend-select@latest/css/select.min.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('dashboard/assets/demo/demo.css')}}" rel="stylesheet" />
  
  <!-- Styles -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  @yield('extra-css')

</head>
<body class="">
    @yield('content')  
  <!--   Core JS Files   -->
  <script src="{{asset('dashboard/assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="{{asset('dashboard//assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('dashboard/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('dashboard/assets/js/paper-dashboard.min.js?v=2.0.0')}}"></script>

  <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <!-- <script src="{{asset('dashboard/assets/datatable/dataTables.rowReorder.min.js')}}"></script> -->
  <script src="{{asset('dashboard/assets/datatable/dataTables.responsive.min.js')}}"></script>

  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('dashboard/assets/demo/demo.js')}}"></script>  
  <!-- Scripts -->
  <script src="{{ asset('js/main.js') }}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-hardskilled-extend-select@latest/js/select.min.js"></script>
  <script>
    
  </script>
  @yield('extra-script')
</body>

</html>
