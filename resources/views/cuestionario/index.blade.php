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
                
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('revisor'))
                    <h3>{{ trans('multi-leng.a2')}}</h3>
                    @if(count($categories) == 0)
                    <h5 style="color:red;">{{ trans('multi-leng.a18')}}</h5><a class="btn btn-primary" href="{{url('')}}/agregar-nuevas-categorias-concursos" role="button">{{ trans('multi-leng.formerror224')}}</a>
                    @else
                    <a href="{{ route('agregar-nuevo-concurso-administrador') }}" class="btn btn-success btn-sm">{{ trans('multi-leng.a4')}}</a>
                    @endif
                @endif
                </div>
                <div class="card-body">
                            
                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{ trans('multi-leng.formerror29')}}</th>
                            <th>Bases</th>
                            <th>{{ trans('multi-leng.a33')}}</th>
                            <th>{{ trans('multi-leng.formerror25')}}</th>
                            <th>{{ trans('multi-leng.formerror22')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $po => $sli)
                            <tr>
                                <th scope="col">
                                    
                                    {{ $data[$po]['title'] }}
                                
                                </th>
                                <td>
                                    
                                    {{ $data[$po]['namecat'] }}
                                
                                </td>
                                <th scope="col">

                                    @if($data[$po]['status'] == "inicial")

                                        {{ trans('multi-leng.a40') }}

                                    @endif
                                    @if($data[$po]['status'] == "enrevision")

                                        {{ trans('multi-leng.a252') }}

                                    @endif
                                    @if($data[$po]['status'] == "rechazado")

                                        {{ trans('multi-leng.a244') }}

                                    @endif
                                    @if($data[$po]['status'] == "conobservaciones")

                                        {{ trans('multi-leng.a253') }}

                                    @endif
                                    @if($data[$po]['status'] == "aprobado")

                                        {{ trans('multi-leng.a246') }}

                                    @endif
                                </th>
                                <td>

                                    {{ $data[$po]['name'] }} 

                                </td>
                                <td>
                                    @foreach($data[$po]['answ'] as $an => $a) 

                                        @if( $an == 0) 

                                            @if($data[$po]['status'] == "inicial")

                                                <a class="btn btn-success btn-sm btn-block" href="{{ route('ver-formulario-docente-primera-etapa', Crypt::encrypt( $data[$po]['answ'][$an]['idansw'] ) ) }}" role="button">{{ trans('multi-leng.a203')}}</a>

                                            @endif
                                            @if($data[$po]['status'] == "enrevision")

                                                <a class="btn btn-warning btn-sm btn-block mt-1" href="{{ route('ver-formulario-docente-historico', 
                                                ['id' => Crypt::encrypt( $data[$po]['answ'][$an]['idansw'] ), 'version' => $data[$po]['answ'][$an]['version'], 'tipo' => 'enrevision' ] ) }}" role="button">{{ trans('multi-leng.a252') }}</a>

                                            @endif
                                            @if($data[$po]['status'] == "rechazado")

                                                <a class="btn btn-warning btn-sm btn-block mt-1" href="{{ route('ver-formulario-docente-historico', 
                                                ['id' => Crypt::encrypt( $data[$po]['answ'][$an]['idansw'] ), 'version' => $data[$po]['answ'][$an]['version'], 'tipo' => 'rechazado' ] ) }}" role="button">{{ trans('multi-leng.a244') }}</a>

                                            @endif
                                            @if($data[$po]['status'] == "conobservaciones")

                                                <a class="btn btn-success btn-sm btn-block" href="{{ route('ver-formulario-docente-primera-etapa', Crypt::encrypt( $data[$po]['answ'][$an]['idansw'] ) ) }}" role="button">{{ trans('multi-leng.a203')}}</a>

                                            @endif
                                            @if($data[$po]['status'] == "aprobado")

                                                <a class="btn btn-warning btn-sm btn-block mt-1" href="{{ route('ver-formulario-docente-historico', 
                                                ['id' => Crypt::encrypt( $data[$po]['answ'][$an]['idansw'] ), 'version' => $data[$po]['answ'][$an]['version'], 'tipo' => 'aprobado' ] ) }}" role="button">{{ trans('multi-leng.a246') }}</a>

                                            @endif

                                            

                                        @else

                                            <a class="btn btn-warning btn-sm btn-block mt-1" href="{{ route('ver-formulario-docente-historico', 
                                            ['id' => Crypt::encrypt( $data[$po]['answ'][$an]['idansw'] ), 'version' => $data[$po]['answ'][$an]['version'], 'tipo' => 'historial' ] ) }}" role="button">{{ trans('multi-leng.a251')}} <small style="color:#000;">(Versión - {{ $data[$po]['answ'][$an]['version'] }})</small></a>

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
            "order": [[ 0, "desc" ]],
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
    });
    
</script>
@endsection