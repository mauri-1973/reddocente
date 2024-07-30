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

                    <h3>{{ trans('multi-leng.userdetal')}} ({{ trans('multi-leng.multi4')}})</h3>

                    @if($catego > 0)

                    <a href="{{ route('mostrar-formulario-tipo-usuario', ['tipo' => 'estudiantes']) }}" class="btn btn-success btn-sm">{{ trans('multi-leng.addnewuser')}}</a>

                    @else

                    <button class="btn btn-success btn-sm" disabled>{{ trans('multi-leng.addnewuser')}}</button>

                    <p id="nocat"><strong>{{ trans('multi-leng.noacademicos1')}}</strong></p>

                    @endif

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{trans('lang.nombreuser') }}</th>

                                <th>{{trans('lang.apellidouser') }}</th>

                                <th>Email</th>

                                <th>{{trans('lang.moviluser') }}</th>

                                <th>{{trans('lang.cargouser') }}</th>

                                <th>{{trans('lang.imguser') }}</th>

                                <th>{{trans('lang.opcionesuser') }}</th>

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

                                        <input name="tipo" type="hidden" value="est">

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

