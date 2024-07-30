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

                    <h3>{{ trans('multi-leng.userdetal')}} ({{ trans('multi-leng.menu1')}})</h3>

                    <a href="{{ route('mostrar-formulario-tipo-usuario', ['tipo' => 'revisor']) }}" class="btn btn-success btn-sm">{{ trans('multi-leng.addnewuser')}}</a>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans("multi-leng.nomuser")}}</th>

                                <th>{{ trans("multi-leng.suruser")}}</th>

                                <th>Email</th>

                                <th>{{ trans("multi-leng.a270")}}</th>

                                <th>{{ trans("multi-leng.a271")}}</th>

                                <th>Avatar</th>

                                <th>{{ trans("multi-leng.formerror22")}}</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($users as $row)

                            <tr>

                                <td>{{ $row->name }}</td>

                                <td>{{ $row->surname }}</td>

                                <td>{{ $row->email }}</td>

                                <td>{{ $row->mobile }}</td>

                                <td>

                                    {{ $row->cargo_us }}

                                </td>

                                <td class="text-center">

                                    @if (file_exists(public_path('storage/profile-pic/').$row->avatar))

                                        <img style="width:100px;height:auto;" id="logouser" src="{{asset('storage/profile-pic')}}/{{$row->avatar}}" alt="{{$row->name}}" class="avatar border-gray"/>

                                    @else

                                        <img style="width:100px;height:auto;" id="logouser" src="{{asset('/imagenes/sinregistro.png')}}" alt="{{$row->name}}" class="avatar border-gray"/>

                                    @endif

                                </td>

                                <td>

                                    <div style="display:flex;">

                                    <a href="{{route('users.edit',$row->id)}}" class="btn btn-warning btn-sm">{{ trans('lang.editar')}}</a>

                                        &nbsp;

                                    <form id="delete_form{{$row->id}}" method="POST" action="{{ route('users.destroy',$row->id) }}" onclick="return confirm('{{ trans("multi-leng.areyousur")}}')">

                                        @csrf

                                        <input name="_method" type="hidden" value="DELETE">

                                        <input name="tipo" type="hidden" value="rev">

                                        <button class="btn btn-danger btn-sm" type="submit">{{ trans('lang.eliminar')}}</button>

                                    </form>

                                    </div>

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

    

</script>

@endsection

