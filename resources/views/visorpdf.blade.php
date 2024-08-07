<!DOCTYPE html>
<html lang="en-US">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <title>
    {{ trans('multi-leng.salwel3')}}
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

      <style>
        /* Force the body height to the size of the browser. */
        html,
        body {
          height: 100%;
        }

        /* Size the viewer as desired. In this case, we fill the browser window. */
        #viewer-container {
          height: 100%;
        }
      </style>
      
  </head>
  <body>
    
    <div id="viewer-container">
        <object data="{{ asset($url) }}" type="application/pdf" style="width:100%;height:100%">
        
        </object>
    </div>
  </body>
</html>