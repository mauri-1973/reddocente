<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ trans('multi-leng.salwel3')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{
          margin-top: 150px;
          background-color: #C4CCD9;
        }
        .error-main{
          background-color: #fff;
          box-shadow: 0px 10px 10px -10px #5D6572;
        }
        .error-main h1{
          font-weight: bold;
          color: #444444;
          font-size: 150px;
          text-shadow: 2px 4px 5px #6E6E6E;
        }
        .error-main h6{
          color: #42494F;
          font-size: 20px;
        }
        .error-main p{
          color: #9897A0;
          font-size: 15px; 
        }
    </style>
</head>
<body>
  
    <div class="container">
        <div class="jumbotron">
            <div class="lc-block d-grid gap-2 d-sm-flex justify-content-sm-center mb-1 mt-2"> 
                <div class="row text-center">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1 error-main">
                        <div class="row">
                            <h1 class="m-0">403</h1>
                            <h6>{{ trans('multi-leng.nologet')}} - Universidad Santo Tomás</h6>
                            <p>{{ trans('multi-leng.voling')}} <span class="text-info"><a href="{{url('/')}}">{{ trans('multi-leng.ingnav')}}</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lc-block d-grid gap-2 d-sm-flex justify-content-sm-center">
                <div class="overflow-hidden" style="max-height: 70vh;">
                    <div class="container px-5">
                        <img class="img-fluid border rounded-3 shadow-lg mb-4" src="{{url('imagenes/logotipo.svg')}}" alt="Photo by Pankaj Patel">
                    </div>
                </div>
            </div>
            
        </div>
      
    </div>
      
</body>
</html>
