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
                        @if($tipo == 0)
                            <h3>{{ trans('multi-leng.formerror170') }}</h3>
                        @endif
                        @if($tipo == 1)
                            <h3>{{ trans('multi-leng.formerror171') }}</h3>
                        @endif
                        @if($tipo == 2)
                            <h3>{{ trans('multi-leng.formerror172') }}</h3>
                        @endif
                    <a href="{{url('/')}}/categorias-forums-docentes-registrados" class="btn btn-success btn-sm" role="button">{{ trans('lang.volver')}}</a>
                    
                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>
                            <tr>
                               
                                <th>{{ trans('multi-leng.formerror81')}}</th>

                                <th>{{ trans('multi-leng.formerror173')}}</th>

                                <th>{{ trans('multi-leng.formerror22')}}</th>

                            </tr>

                        </thead>

                        <tbody>
                            @foreach($array as $row => $slice)

                            <tr>
                               
                                <td>{{ $array[$row]['nombre'] }}</td>

                                <td>{{ $array[$row]['fecha'] }}</td>

                                @if($tipo == 0)
                                <td>
                                    <a href="{{url('/')}}/acciones-usuarios-docentes-forums/2/{{ Crypt::encrypt($array[$row]['idforpar'] )}}" class="btn btn-danger btn-sm btn-block mt-1" role="button">{{ trans('multi-leng.formerror186')}}</a>
                                </td>
                                @endif
                                @if($tipo == 1)
                                <td>
                                    <a href="{{url('/')}}/acciones-usuarios-docentes-forums/1/{{ Crypt::encrypt($array[$row]['idforpar'] )}}" class="btn btn-success btn-sm btn-block mt-1" role="button">{{ trans('multi-leng.formerror185')}}</a>
                                    <a href="{{url('/')}}/acciones-usuarios-docentes-forums/2/{{ Crypt::encrypt($array[$row]['idforpar'] )}}" class="btn btn-danger btn-sm btn-block mt-1" role="button">{{ trans('multi-leng.formerror186')}}</a>
                                </td>
                                
                                @endif
                                @if($tipo == 2)
                                <td>
                                    <a href="{{url('/')}}/acciones-usuarios-docentes-forums/1/{{ Crypt::encrypt($array[$row]['idforpar'] )}}" class="btn btn-success btn-sm btn-block mt-1" role="button">{{ trans('multi-leng.formerror185')}}</a>
                                </td>
                                @endif
                            
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

<div class="modal fade" id="staticBackdropforo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelforo" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabelforo">{{ trans('multi-leng.admcat')}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="modalbodyforo">

                ...

            </div>

            <div class="modal-footer" id="footerbodyforo">

                

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

        const divs = document.querySelectorAll('.editcat');

        divs.forEach(el => el.addEventListener('click', event => {
            console.log("ok");
        }));
        

    });


    
    </script>

@endsection