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

                    <h3>{{ trans('multi-leng.formerror174')}}</h3>

                    <a href="{{ url('/') }}/home" class="btn btn-success btn-sm" role="button">{{ trans('lang.volver')}}</a>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>
                        
                        <tr>
                            <th>#</th>

                            <th>{{ trans('multi-leng.namecat')}}</th>

                            <th>{{ trans('multi-leng.namesubcat')}}</th>

                            <th>{{ trans('multi-leng.formerror175')}}</th>

                            <th>{{ trans('multi-leng.formerror83')}}</th>

                            <th>{{ trans('multi-leng.formerror22')}}</th>

                        </tr>

                        </thead>

                        <tbody>
                            @foreach($array as $row => $slice)
                            <tr>

                                <td>{{ $array[$row]['idcatfor']}}</td>

                                <td>{{ $array[$row]['namecat']}}</td>

                                <td>{{ $array[$row]['namesub']}}</td>

                                <td>{{ $array[$row]['namecatforo']}}</td>

                                <td>{{ $array[$row]['namedocente']}}</td>

                                <td>
                                    @if($array[$row]['numfor'] === "no")
                                    <a href="{{ url('/') }}/solicitar-acceso-foro-docentes/{{Crypt::encrypt($array[$row]['idcatfor'])}}" class="btn btn-success btn-sm btn-block" role="button">{{ trans('multi-leng.formerror176')}}</a>
                                    @endif
                                    @if($array[$row]['numfor'] === 0)
                                    <button class="btn btn-warning btn-sm btn-block" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror182')}}" data-html="true">{{ trans('multi-leng.formerror177')}}</button>
                                    @endif
                                    @if($array[$row]['numfor'] === 1)
                                    <a href="{{ url('/') }}/acceder-forum-usuarios-activos/{{Crypt::encrypt($array[$row]['idcatfor'])}}" class="btn btn-success btn-sm btn-block" role="button">{{ trans('multi-leng.formerror178')}}</a>
                                    @endif
                                    @if($array[$row]['numfor'] === 2)
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

            "fixedHeader": true,

            "responsive": true, 

            "columnDefs": [
                        {
                            "targets": [0],
                            "visible": false,
                            "searchable": false
                        },
                    ],     

            "order": [[ 4, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        }); 

    });

</script>

@endsection

