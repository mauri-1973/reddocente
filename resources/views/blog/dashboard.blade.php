@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')

@endsection



@section('index')

<div class="content">

    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6">

            <div class="card card-stats">

                <a href="{{ route('ver-publicaciones-blog') }}">

                    <div class="card-body ">

                        <div class="row">

                            <div class="col-5 col-md-4">

                                <div class="icon-big text-center icon-warning">

                                    <i class="nc-icon nc-globe text-warning"></i>

                                </div>

                            </div>

                            <div class="col-7 col-md-8">

                                <div class="numbers">

                                    <p class="card-category">{{ __('multi-leng.formerror68') }}</p>

                                    <p class="card-title">{{ $post }}<p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer ">

                        <hr>

                        <div class="stats">

                            <i class="fa fa-refresh"></i> {{ __('multi-leng.formerror70') }}

                        </div>

                    </div>

                </a>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">

            <div class="card card-stats">

                <a href="{{ route('ver-categorias-blog') }}">

                     <div class="card-body ">

                        <div class="row">

                            <div class="col-5 col-md-4">

                                <div class="icon-big text-center icon-warning">

                                    <i class="nc-icon nc-vector text-success"></i>

                                </div>

                            </div>

                            <div class="col-7 col-md-8">

                                <div class="numbers">

                                    <p class="card-category">{{ __('multi-leng.admcat') }}</p>

                                    <p class="card-title">{{ $cat }}<p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer ">

                        <hr>

                        <div class="stats">

                            <i class="fa fa-calendar-o"></i> {{ __('multi-leng.formerror70') }}

                        </div>

                    </div>

                </a>                    

            </div>

        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">

            <div class="card card-stats">

                <a href="{{ route('ver-tags-blog') }}">

                    <div class="card-body ">

                        <div class="row">

                            <div class="col-5 col-md-4">

                                <div class="icon-big text-center icon-warning">

                                    <i class="nc-icon nc-tag-content text-danger"></i>

                                </div>

                            </div>

                            <div class="col-7 col-md-8">

                                <div class="numbers">

                                    <p class="card-category">Tags</p>

                                    <p class="card-title">{{ $tags }}<p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer ">

                        <hr>

                        <div class="stats">

                            <i class="fa fa-calendar-o"></i> {{ __('multi-leng.formerror70') }}

                        </div>

                    </div>

                </a> 

            </div>

        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">

            <div class="card card-stats">

                <div class="card-body ">

                    <div class="row">

                        <div class="col-5 col-md-4">

                            <div class="icon-big text-center icon-warning">

                                <i class="nc-icon  nc-glasses-2 text-primary"></i>

                            </div>

                        </div>

                        <div class="col-7 col-md-8">

                            <div class="numbers">

                                <p class="card-category">{{ __('multi-leng.formerror69') }}</p>

                                <p class="card-title">{{ $visit }}<p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer ">

                    <hr>

                    <div class="stats">

                        <i class="fa fa-refresh"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card ">

                <div class="card-header ">

                    <h5 class="card-title">{{ __('multi-leng.formerror71') }}</h5>

                    <p class="card-category">{{ __('multi-leng.formerror72') }}</p>

                </div>

                <div class="card-body ">

                    <canvas id="chartHours" width="800" height="450"></canvas>

                </div>

                <div class="card-footer ">

                    <hr>

                    <div class="stats">

                        <i class="fa fa-history"></i> {{ __('multi-leng.formerror73') }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row" style="display:none;">

        <div class="col-md-4">

            <div class="card ">

                <div class="card-header ">

                    <h5 class="card-title">Email Statistics</h5>

                    <p class="card-category">Last Campaign Performance</p>

                </div>

                <div class="card-body ">

                    <canvas id="chartEmail"></canvas>

                </div>

                <div class="card-footer ">

                    <div class="legend">

                        <i class="fa fa-circle text-primary"></i> Opened

                        <i class="fa fa-circle text-warning"></i> Read

                        <i class="fa fa-circle text-danger"></i> Deleted

                        <i class="fa fa-circle text-gray"></i>

                    </div>

                    <hr>

                    <div class="stats">

                        <i class="fa fa-calendar"></i> Number of emails sent

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card card-chart">

                <div class="card-header">

                    <h5 class="card-title">NASDAQ: AAPL</h5>

                    <p class="card-category">Line Chart with Points</p>

                </div>

                <div class="card-body">

                    <canvas id="speedChart" width="400" height="100"></canvas>

                </div>

                <div class="card-footer">

                    <div class="chart-legend">

                        <i class="fa fa-circle text-info"></i>

                        <i class="fa fa-circle text-warning"></i>

                    </div>

                    <hr/>

                    <div class="card-stats">

                        <i class="fa fa-check"></i> Data information certified

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modalgenerico" tabindex="-1" role="dialog" aria-labelledby="modaltitulo" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success">

                <h5 class="modal-title" id="modaltitulo" style="color:#fff;"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="modalbody">

                

            </div>

            <div class="modal-footer" id="modalfooter">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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

        estadisticasinicialesblog();

    });

    function estadisticasinicialesblog()

    {

        $.ajaxSetup({

        headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        var formData = new FormData();

        formData.append('tipo', "panelbloginicio");

        var type = "POST";

        var ajaxurl = "{{route('estadisticas-generales-segun-tipo-de-usuario')}}";

        $.ajax({

            type: type,

            url: ajaxurl,

            data:formData,

            processData: false,

            contentType: false,

            dataType: 'json',

            success: function (datos) {

                var oilCanvas = document.getElementById("chartHours");

                Chart.defaults.global.defaultFontFamily = "Lato";

                Chart.defaults.global.defaultFontSize = 18;



                var oilData = {

                    labels: datos.name,

                    datasets: [

                        {

                            data: datos.cant,

                            backgroundColor: datos.color

                        }]

                };



                var pieChart = new Chart(oilCanvas, {

                type: 'pie',

                data: oilData

                });

                   

            },

            error: function (data) {

                console.log("Error estadisticasinicialesblog");

            }

        });

    }

    const timeoutId = setTimeout(function(){

        estadisticasinicialesblog();

    }, 100000);





    

    

</script>

@endsection

