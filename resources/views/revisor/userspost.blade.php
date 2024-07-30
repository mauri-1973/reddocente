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
                <h3>{{ trans('multi-leng.a211')}}</h3>
                @if(Auth::user()->hasRole('revisor'))
                <a href="{{ route('buscar-concursos-registrados-revisor') }}" class="btn btn-success btn-sm">{{ trans('lang.volver')}}</a>
                @endif
                </div>
                <div class="card-body">
                            
                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col">{{ trans('multi-leng.a208')}}</th>
                            <th>Bases</th>
                            <th>{{ trans('multi-leng.a209')}}</th>
                            <th>{{ trans('multi-leng.a210')}}</th>
                            <th>{{ trans('multi-leng.a211')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($array1 as $arr)
                            <tr>
                                <th scope="row">
                                    {{ $arr['titlecat']}}
                                </th>
                                <td >
                                    {{ $arr['namecat']}}
                                </td>
                                <th scope="row">
                                    {{ $arr['user']}}
                                </th>
                                <td >
                                    @if($arr['status'] == 'inicial')
                                        Información incompleta
                                    @endif
                                    @if($arr['status'] == 'enrevision')
                                        Lista para revisar
                                    @endif
                                    @if($arr['status'] == 'rechazado')
                                        Rechazada
                                    @endif
                                    @if($arr['status'] == 'aprobado')
                                        Aprobada
                                    @endif
                                    @if($arr['status'] == 'conobservaciones')
                                        Con Observaciones
                                    @endif
                                </td>
                                <td>
                                    @foreach($arr['answ'] as $an => $slice)
                                    @if($an == 0 && $arr['status'] == 'inicial')
                                    <a href="{{ route('ver-informacion-ingresada-docente', ['tipo' => 'inicial', 'idpost' => $arr['idpost'], 'idansw' => Crypt::encrypt($arr['answ'][$an]['idansw'])]) }}" class="btn btn-primary btn-sm btn-block">Ver Avances</a>
                                    @endif
                                    @if($an == 0 && $arr['status'] == 'enrevision')
                                    <a href="{{ route('ver-informacion-ingresada-docente', ['tipo' => 'revision', 'idpost' => $arr['idpost'], 'idansw' => Crypt::encrypt($arr['answ'][$an]['idansw'])]) }}" class="btn btn-success btn-sm btn-block">Iniciar Revisión</a>
                                    @endif
                                    @if($an == 0 && $arr['status'] == 'rechazado')
                                    <a href="{{ route('ver-informacion-ingresada-docente', ['tipo' => 'rechazado', 'idpost' => $arr['idpost'], 'idansw' => Crypt::encrypt($arr['answ'][$an]['idansw'])]) }}" class="btn btn-success btn-sm btn-block">Volver a Revisar</a>
                                    @endif
                                    @if($an == 0 && $arr['status'] == 'aprobado')
                                    <a href="{{ route('ver-informacion-ingresada-docente', ['tipo' => 'aprobado', 'idpost' => $arr['idpost'], 'idansw' => Crypt::encrypt($arr['answ'][$an]['idansw'])]) }}" class="btn btn-success btn-sm btn-block">Volver a Revisar</a>
                                    @endif
                                    @if($an == 0 && $arr['status'] == 'conobservaciones')
                                    <a href="{{ route('ver-informacion-ingresada-docente', ['tipo' => 'conobservaciones', 'idpost' => $arr['idpost'], 'idansw' => Crypt::encrypt($arr['answ'][$an]['idansw'])]) }}" class="btn btn-success btn-sm btn-block">Ver Avances</a>
                                    @endif
                                    @if($an > 0)
                                    <a href="{{ route('ver-informacion-ingresada-docente', ['tipo' => 'historial', 'idpost' => $arr['idpost'], 'idansw' => Crypt::encrypt($arr['answ'][$an]['idansw'])]) }}" class="btn btn-warning btn-sm btn-block mt-1">Historial</a>
                                    @endif
                                    @endforeach
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
            "order": [[ 2, "desc" ]],
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
    });
    
</script>
@endsection