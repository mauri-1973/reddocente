@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')

<style>

    #nocat

    {

       color: red;

    }

</style>

@endsection





@section('index')

<div class="content">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="">

                    <h3>{{ trans('multi-leng.formerror91')}}</h3>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>{{ trans('multi-leng.namecat')}}</th>

                                <th>{{ trans('multi-leng.namesubcat')}}</th>

                                <th>{{ trans('multi-leng.formerror277')}}</th>

                                <th>{{ trans('multi-leng.fechcrecat')}}</th>

                                <th>{{ trans('multi-leng.formerror22')}}</th>

                            </tr>

                        </thead>

                        <tbody>
                            @foreach($categories as $row => $slice)
                            <tr>

                                <td>
                                    Chat # {{ $categories[$row]['idcatchat'] }}
                                </td>

                                <td>
                                    {{ $categories[$row]['namecat'] }}
                                </td>

                                <td>
                                    {{ $categories[$row]['namesub'] }}
                                </td>

                                <td>
                                    {{ $categories[$row]['namecatchat'] }}
                                </td>

                                <td>
                                    {{ $categories[$row]['fecha'] }} {{$categories[$row]['statusus']}}
                                </td>

                                <td>
                                    @if($categories[$row]['statusus'] == 10)
                                        <button onclick="acciones('{{ Crypt::encrypt($categories[$row]['idcatchat'])  }}', {{$categories[$row]['statusus'] }} );" class="btn btn-success btn-sm btn-block">{{ trans('multi-leng.formerror176')}}</button>
                                    @endif
                                    @if($categories[$row]['statusus'] == 0)
                                        <button class="btn btn-dark btn-sm btn-block">{{ trans('multi-leng.formerror177')}}</button>
                                    @endif
                                    @if($categories[$row]['statusus'] == 1)
                                    <a href="{{url('ingresar-chat-usuario-registrado', ['idcatchat' => Crypt::encrypt($categories[$row]['idcatchat']) ] ) }}" role="button" class="btn btn-primary btn-sm btn-block">{{ trans('multi-leng.formerror278')}}</a>
                                    @endif
                                    @if($categories[$row]['statusus'] == 2)
                                    <button class="btn btn-danger btn-sm btn-block">{{ trans('multi-leng.formerror179')}}</button>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal -->

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">{{ trans('multi-leng.admcat')}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="modalbody">

                ...

            </div>

            <div class="modal-footer" id="footerbody">

                

            </div>

        </div>

    </div>

</div>

<input type="hidden" id="status" name="status">

@endsection



@section('extra-script')

<script type="text/javascript">

    

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table').DataTable({

            //"dom": 'lfrtip'

            "dom": 'frtip', 

            fixedHeader: true,

            responsive: true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });

    function acciones(id, tipo)
    {
        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

        }

        });

        $.ajax({

        url: '{{route("busquedas-info-chats-docentes")}}', 

        type: 'POST',

        async: false,

        dataType: 'json',

        data: {idcat: id, tipo: tipo},

        success: function(data) {

            if(data.count)
            {
                $( "#staticBackdropLabel" ).html("{{ __('multi-leng.formerror46') }}");

                $( "#modalbody" ).html("<strong>{{ __('multi-leng.formerror279') }}</strong>");

                $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                $( "#staticBackdrop" ).modal('show');
                
                    
            }
            else
            {
                $( "#staticBackdropLabel" ).html("{{ __('multi-leng.formerror146') }}");

                $( "#modalbody" ).html("<strong>{{ __('multi-leng.formerror181') }}</strong>");

                $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                $( "#staticBackdrop" ).modal('show');
            }
            setTimeout(function(){
                $( "#staticBackdrop" ).modal('hide');
                window.location.href = '{{ url("/") }}/buscar-chats-usuario-registrado-est';
            }, 4000);

        },

        error:function(x,xs,xt){

            //console.log(JSON.stringify(x));

            console.log("error validarnombre");

        }

        });
    }

</script>

@endsection

