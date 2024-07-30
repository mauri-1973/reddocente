@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<style>

    #nocat

    {

       color: red;

    }

    .text-success{
        color: #004238 !important;
    }

    .fa{
        color: #004238 !important;
    }

    .icon-1x {
    font-size: 32px;
    }
    
    .viewus:hover {
      background-color: #20c997 !important;
      transition: 0.7s;
  }


    .table-borderless>thead>tr>th
    .table-borderless>thead>tr>td
    .table-borderless>tbody>tr>th
    .table-borderless>tbody>tr>td
    .table-borderless>tfoot>tr>th
    .table-borderless>tfoot>tr>td {
    border: none;
}

</style>

@endsection





@section('index')



<div class="content">
    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0 card">
            <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;">
            </div>
            <div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 50px;">
                <div class="sticky-inner">
                    <button class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold addtopic" data-id="{{ Crypt::encrypt($cat->idcatfor) }}">{{ trans('multi-leng.formerror135')}}</button>
                    <div class="bg-white mb-3" style="border:1px solid #cccccc;">
                        <small class="px-3 py-2 op-5 m-0 text-success">
                            {{  \Carbon\Carbon::create($cat->fecha)->translatedFormat('l j F Y | H:i') }}
                        </small>
                        <h4 class="px-3 py-2 op-5 m-0 text-success">
                            {{ $cat->namecat }}
                        </h4>
                        <h6 class="px-3 py-2 m-0 roboto-bold text-success">
                            {{ $cat->namesubcat }}
                        </h6>
                        <hr class="my-0">
                        <div class="row text-center d-flex flex-row op-7 mx-0">
                            <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> 
                                <a class="d-block lead font-weight-bold text-success" href="#">{{ $votos }}</a> {{ trans('multi-leng.formerror131')}}
                            </div>
                            <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> 
                                <a class="d-block lead font-weight-bold text-success" href="#">{{ $totalcoment }}</a> {{ trans('multi-leng.formerror132')}} 
                            </div>
                        </div>
                        <div class="row d-flex flex-row op-7">
                            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> 
                                <a class="d-block lead font-weight-bold text-success" href="#">{{ $visitas }}</a> {{ trans('multi-leng.formerror133')}}
                            </div>
                            <div class="col-sm-6 flex-ew text-center py-3 mx-0"> 
                                <a class="d-block lead font-weight-bold text-success" href="#">{{ $part }}</a> {{ trans('multi-leng.formerror134')}} 
                            </div>
                        </div>
                        <div class="row d-flex flex-row op-7">
                            <div class="col-sm-12 flex-ew text-center py-4 border-top border-bottom">
                                <button class="btn btn-link lead font-weight-bold viewus" data-idus="{{ Crypt::encrypt($cat->idus) }}" style="color:#004238 !important;font-size:18px;" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror149')}}" data-html="true">{{ $cat->nameus }} {{ $cat->surname }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white text-sm">
                        <h4 class="px-3 py-4 op-5 m-0">
                            {{ trans('multi-leng.formerror136')}}
                        </h4>
                        @foreach($more as $row => $slice)
                        <hr class="m-0">
                        <div class="pos-relative px-3 py-3">
                            <h6 class="text-success text-sm">
                                <a href="{{ url('ver-contenido-tema-forum', ['idcomments' => $more[$row]['idcommentcryp'], 'idcat' => $idcat ] ) }}" class="text-success" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror164')}}" data-html="true">{{$more[$row]['title']}}</a>
                            </h6>
                            <p class="mb-0 text-sm">
                                <span class="op-6">{{ trans('multi-leng.formerror150')}}</span> 
                                <a class="text-black" href="{{ url('ver-contenido-tema-forum', ['idcomments' => $more[$row]['idcommentcryp'], 'idcat' => $idcat ] ) }}" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror164')}}" data-html="true">{{$more[$row]['fecha']}}</a> 
                                <span class="op-6">{{ trans('multi-leng.formerror151')}}</span> 
                                <a class="text-black" href="{{ url('ver-contenido-tema-forum', ['idcomments' => $more[$row]['idcommentcryp'], 'idcat' => $idcat ] ) }}" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror164')}}" data-html="true">{{$more[$row]['usuario']}}</a>
                            </p>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="col-lg-9">
            <div class="row text-left mb-5 m-1 mt-2 bg-white p-4">
                <div class="col-lg-12 mb-3 mb-sm-0">
                    <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">
                        <select id="filter" class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50 pl-3" data-toggle="select" tabindex="-98">
                            <option value="0" selected>{{ trans('multi-leng.formerror166')}}</option>
                            <option value="1">{{ trans('multi-leng.formerror167')}}</option>
                            <option value="2">{{ trans('multi-leng.formerror168')}}</option>
                            <option value="3">{{ trans('multi-leng.formerror169')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 m-0 p- pb-3 table-responsive">
                <table id="dt-mant-table" class="table table-borderless display nowrap p-0 m-0" style="width:100%">
                    <thead class="p-0 m-0">
                        <tr class="p-0 m-0">
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach($topic as $row => $slice) 
                        <tr class="p-0 m-0">
                            <td>
                                {{ $topic[$row]['idcomment'] }}
                            </td>
                            <td class="p-0 m-0">
                                <!-- End of post 1 -->
                                <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                                    <div class="row align-items-center">
                                        <div class="col-12 mb-3">
                                            <h5>
                                                <a href="{{ url('ver-contenido-tema-forum', ['idcomments' => $topic[$row]['idcommentcryp'], 'idcat' => $idcat ] ) }}" class="text-success pb-5" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror164')}}" data-html="true">{{$topic[$row]['title']}}</a>
                                            </h5>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <p><strong>{{ trans('multi-leng.formerror165')}}:</strong> {{$topic[$row]['contenido']}}</p>
                                        </div>
                                        <div class="col-md-8 mb-3 mb-sm-0">
                                            <p class="text-sm">
                                                <span class="op-6">{{ trans('multi-leng.formerror150')}}</span> 
                                                <span class="op-6 text-primary">{{$topic[$row]['fecha']}}</span> 
                                                <span class="op-6">{{ trans('multi-leng.formerror151')}}</span> 
                                                <button class="btn btn-link viewus" data-idus="{{$topic[$row]['idus']}}" style="color:#004238 !important;" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror149')}}" data-html="true">{{$topic[$row]['usuario']}}</button>
                                            </p>
                                            <div class="text-sm op-5">
                                                @foreach($topic[$row]['tags'] as $rowt  => $slicet )
                                                    <span class="mr-2 text-primary">#{{ $topic[$row]['tags'][$rowt]['nametag'] }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4 op-7">
                                            <div class="row text-center op-7">
                                                <div class="col px-1"> 
                                                    <i class="fa fa-star fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror155')}}" data-html="true"></i>
                                                    <span class="d-block text-sm">{{$topic[$row]['votos']}} {{ trans('multi-leng.formerror153')}}</span> 
                                                </div>
                                                <div class="col px-1"> 
                                                    <i class="fa fa-comment fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror156')}}" data-html="true"></i>
                                                    <span class="d-block text-sm">{{$topic[$row]['respuestas']}} {{ trans('multi-leng.formerror154')}}</span> 
                                                </div>
                                                <div class="col px-1"> 
                                                    <i class="fa fa-eye fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror157')}}" data-html="true"></i>
                                                    <span class="d-block text-sm">{{$topic[$row]['visitas']}} {{ trans('multi-leng.formerror28')}}</span>  

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            
                                            <a class="btn btn-success btn-sm float-right mr-1" href="{{ url('ver-contenido-tema-forum', ['idcomments' => $topic[$row]['idcommentcryp'], 'idcat' => $idcat ] ) }}" role="button" style="width:200px;" data-toggle="tooltip" data-placement="top" title="Haga click para ver el contenido completo del tema ingresado por el usuario" data-html="true">{{ trans('multi-leng.formerror70')}}</a>
                                            @if($topic[$row]['idusreal'] == Auth::user()->id)
                                            <button type="button" class="btn btn-danger btn-sm float-right mr-1" onclick="eliminarforum('{{ $topic[$row]['idforpar'] }}')">{{ trans('lang.eliminar')}}</button>
                                            <button type="button" class="btn btn-warning btn-sm float-right mr-1" onclick="editarforum('{{ $topic[$row]['idcommentcryp'] }}')">{{ trans('lang.editar')}}</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /End of post 1 -->
                            </td>
                            <td>
                            @foreach($topic[$row]['tags'] as $rowt  => $slicet )
                                {{ $topic[$row]['tags'][$rowt]['nametag'] }}&nbsp;
                            @endforeach
                            </td>
                            <td>
                                {{$topic[$row]['votos']}}
                            </td>
                            <td>
                                {{$topic[$row]['respuestas']}}
                            </td>
                            <td>
                                {{$topic[$row]['visitas']}}
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form name="delete-forum" id="delete-forum" method="post" action="{{ url('') }}/eliminar-nuevo-tema-forum">
@csrf
<input type="hidden" id="idcat" name="idcat" value="{{ $idcat }}">
<input type="hidden" id="idforumpart" name="idforumpart">
</form> 

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script type="text/javascript">

    

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table').DataTable({

            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [2],
                    "visible": false,
                    "searchable": true
                },
                {
                    "targets": [3],
                    "visible": false,
                    "searchable": true
                },
                {
                    "targets": [4],
                    "visible": false,
                    "searchable": true
                },
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": true
                },
            ],

            "dom": 'frtip', 

            "fixedHeader": true,

            "responsive": false,      

            "order": [[ 0, "desc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

        

    });
    function eliminarforum(idcript)
    {
        $( "#staticBackdropLabelforo" ).html("{{ trans('lang.eliminar')}}");
        $( "#modalbodyforo" ).html(`Está seguro de eliminar este tema, esta acción no es reversible. <input type="hidden" id="idforumparttemp" name="idforumparttemp" value="${idcript}">`);
        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-danger" id="formelim" name="formelim">{{ trans('lang.eliminar')}}</button><button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');
    }
    function editarforum(idcript)
    {
        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

        }

        });

        $.ajax({

        url: '{{ route("busquedas-info-forums-docentes") }}',

        type: 'POST',

        async: false,

        dataType: 'json',

        data: {idcat: idcript, tipo: 5},

        success: function(data) {

            $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror135')}}");

            $( "#modalbodyforo" ).html(`<form class="formeditsub" id="formeditsub" method="POST" action="{{ url('') }}/editar-nuevo-tema-forum" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="idcript" name="idcript" value="${idcript}">
                <input type="hidden" id="idcat" name="idcat" value="{{ $idcat }}">
                
                <div class="form-group">
                    <label for="nametopic"><b>{{ __('multi-leng.formerror141') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror142') }}" data-html="true"></i></label> 
                    <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="250" size="100" placeholder="{{ __('multi-leng.formerror141') }}" value="${data.forum[0].titulo}" required> 
                    <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
                </div> 
                <div class="form-group">
                    <label for="tag1"><b>Tag 1</b></label> 
                    <input type="text" class="form-control" id="tag1" name="tag1" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}" value="${data.tags[0].tag1}"> 
                </div>
                <div class="form-group">
                    <label for="tag2"><b>Tag 2</b></label> 
                    <input type="text" class="form-control" id="tag2" name="tag2" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}" value="${data.tags[0].tag2}"> 
                </div>
                <div class="form-group">
                    <label for="tag3"><b>Tag 3</b></label> 
                    <input type="text" class="form-control" id="tag3" name="tag3" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}" value="${data.tags[0].tag3}">
                </div>
                <div class="form-group">
                    <label for="tag4"><b>Tag 4</b></label> 
                    <input type="text" class="form-control" id="tag4" name="tag4" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}" value="${data.tags[0].tag4}">
                </div>
                <div class="form-group">
                    <label for="tag5"><b>Tag 5</b></label> 
                    <input type="text" class="form-control" id="tag5" name="tag5" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}" value="${data.tags[0].tag5}">
                </div>
                <div class="form-group">
                    <label for="summernote"><b>{{ trans('multi-leng.formerror137')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                    <textarea class="form-control" id="summernote" name="summernote" aria-describedby="summernoteHelp">${data.forum[0].contenido}</textarea>
                    <small id="summernoteHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
                </div>
                <button type="submit" class="btn btn-warning">{{ trans('lang.editar')}}</button>
                </form>`);

            $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

            $( "#staticBackdropforo" ).modal('show');

        },

        error:function(x,xs,xt){

            //console.log(JSON.stringify(x));

            console.log("error validarnombre")

            $("#status").val(0);

        }

        });
        
    }
    $(".addtopic").click(function(e){

        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror135')}}");

        $( "#modalbodyforo" ).html(`<form class="formaddsub" id="formaddsub" method="POST" action="{{ url('') }}/agregar-nuevo-tema-forum" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="idcat" name="idcat" value="${$(this).data("id")}">
            <div class="form-group">
                <label for="nametopic"><b>{{ __('multi-leng.formerror141') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror142') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="250" size="100" placeholder="{{ __('multi-leng.formerror141') }}" required> 
                <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
            </div> 
            <div class="form-group">
                <label for="tag1"><b>Tag 1</b></label> 
                <input type="text" class="form-control" id="tag1" name="tag1" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}"> 
            </div>
            <div class="form-group">
                <label for="tag2"><b>Tag 2</b></label> 
                <input type="text" class="form-control" id="tag2" name="tag2" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}"> 
            </div>
            <div class="form-group">
                <label for="tag3"><b>Tag 3</b></label> 
                <input type="text" class="form-control" id="tag3" name="tag3" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}">
            </div>
            <div class="form-group">
                <label for="tag4"><b>Tag 4</b></label> 
                <input type="text" class="form-control" id="tag4" name="tag4" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}">
            </div>
            <div class="form-group">
                <label for="tag5"><b>Tag 5</b></label> 
                <input type="text" class="form-control" id="tag5" name="tag5" minlength="2" maxlength="25" size="25" placeholder="{{ __('multi-leng.formerror59') }}">
            </div>
            <div class="form-group">
                <label for="summernote"><b>{{ trans('multi-leng.formerror137')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                <textarea class="form-control" id="summernote" name="summernote" aria-describedby="summernoteHelp"></textarea>
                <small id="summernoteHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
            </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });

    $(".viewus").click(function(e){

        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

        }

        });

        $.ajax({

        url: '{{route("buscar-informacion-usuario-contacto")}}',

        type: 'POST',

        async: false,

        dataType: 'json',

        data: {idus: $(this).data("idus")},

        success: function(data) {

            $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror135')}}");

            $( "#modalbodyforo" ).html(`<div class="card" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-sm-5">
                        <img class="card-img" src="{{ asset('storage/profile-pic') }}/${data.avatar}" alt="${data.name}">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title">${data.name}</h5>
                            <p class="card-text">Email: ${data.email}</p>
                            <p class="card-text">Teléfono: ${data.mobile}</p>
                            <p class="card-text">Profesión: ${data.profesion}</p>
                        </div>
                    </div>
                </div>
            </div>`);

            $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

            $( "#staticBackdropforo" ).modal('show');

        },

        error:function(x,xs,xt){

            //console.log(JSON.stringify(x));

            console.log("error validarnombre")

            $("#status").val(0);

        }

        });

        

    });
    
    
    $('#staticBackdropforo').on('show.bs.modal', function (event) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#summernote').summernote({
            placeholder: '{{ trans('multi-leng.formerror137')}}',
            tabsize: 2,
            fontNames: ['Arial', 'Arial Black', 'Calibri', 'Comic Sans MS', 'Courier New', 'Elephant', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman'],
            fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Calibri', 'Comic Sans MS', 'Courier New', 'Elephant', 'Impact', 'Tahoma', 'Times New Roman'],
            height: 400,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['operation', ['undo', 'redo']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });

        $("#formaddsub").submit(function(e){

            $("#nametopicHelp").css("display", "none");
            $("#summernoteHelp").css("display", "none");
            console.log($("#summernote").val().length);
            var error = "";
            
            if($.trim($("#nametopic").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";
                $("#nametopicHelp").html("{{ __('multi-leng.formerror1') }}");
                $("#nametopicHelp").css("display", "block");

            }

            if($("#summernote").val().length == 0)

            {

                error += "{{ __('multi-leng.formerror144') }}<br>";
                $("#summernoteHelp").html("{{ __('multi-leng.formerror144') }}");
                $("#summernoteHelp").css("display", "block");

            }

            if(error != "")

            {

                return false;

            }

            else

            {

                return true;

            }

            

        });
        $("#formeditsub").submit(function(e){

            $("#nametopicHelp").css("display", "none");
            $("#summernoteHelp").css("display", "none");
            console.log($("#summernote").val().length);
            var error = "";

            if($.trim($("#nametopic").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";
                $("#nametopicHelp").html("{{ __('multi-leng.formerror1') }}");
                $("#nametopicHelp").css("display", "block");

            }

            if($("#summernote").val().length == 0)

            {

                error += "{{ __('multi-leng.formerror144') }}<br>";
                $("#summernoteHelp").html("{{ __('multi-leng.formerror144') }}");
                $("#summernoteHelp").css("display", "block");

            }

            if(error != "")

            {

                return false;

            }

            else

            {

                return true;

            }



        });
        
        $( "#formelim" ).on( "click", function() {
            
            $("#idforumpart").val($("#idforumparttemp").val());
            $('#delete-forum').trigger('submit');

        } );


    });

    $('#filter').on('change', function() {
        const data = @json($topic);

        var html = "";
        Object.entries(data).forEach(entry => {
            const [key, value] = entry;
            html += `<tr class="p-0 m-0">
                            <td>
                                ${value.idcomment}
                            </td>
                            <td>
                            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                                <div class="row align-items-center">
                                    <div class="col-12 mb-3">
                                        <h5>
                                            <a href="{{ url('ver-contenido-tema-forum')}}/${value.idcommentcryp}/${value.idcat}" class="text-success pb-5" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror164')}}" data-html="true">${value.title}</a>
                                        </h5>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <p><strong>{{ trans('multi-leng.formerror165')}}:</strong> ${value.contenido}</p>
                                    </div>
                                    <div class="col-md-8 mb-3 mb-sm-0">
                                        <p class="text-sm">
                                            <span class="op-6">{{ trans('multi-leng.formerror150')}}</span> 
                                            <span class="op-6 text-primary">${value.fecha}</span> 
                                            <span class="op-6">{{ trans('multi-leng.formerror151')}}</span> 
                                            <button class="btn btn-link viewus" data-idus="${value.idus}" style="color:#004238 !important;" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror149')}}" data-html="true">${value.usuario}</button>
                                        </p>
                                        <div class="text-sm op-5">`;

                                        Object.entries(value.tags).forEach(entry1 => {
                                                const [key1, value1] = entry1;
                                                html += `<span class="mr-2 text-primary"> #${value1.nametag}</span>`;
                                        });

                                        html += `</div>
                                    </div>
                                    <div class="col-md-4 op-7">
                                        <div class="row text-center op-7">
                                            <div class="col px-1"> 
                                                <i class="fa fa-star fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror155')}}" data-html="true"></i>
                                                <span class="d-block text-sm">${value.votos} {{ trans('multi-leng.formerror153')}}</span> 
                                            </div>
                                            <div class="col px-1"> 
                                                <i class="fa fa-comment fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror156')}}" data-html="true"></i>
                                                <span class="d-block text-sm">${value.respuestas} {{ trans('multi-leng.formerror154')}}</span> 
                                            </div>
                                            <div class="col px-1"> 
                                                <i class="fa fa-eye fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror157')}}" data-html="true"></i>
                                                <span class="d-block text-sm">${value.visitas} {{ trans('multi-leng.formerror28')}}</span>  

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <a class="btn btn-success btn-sm float-right" href="{{ url('ver-contenido-tema-forum')}}/${value.idcommentcryp}/${value.idcat}" role="button" style="width:200px;" data-toggle="tooltip" data-placement="top" title="Haga click para ver el contenido completo del tema ingresado por el usuario" data-html="true">{{ trans('multi-leng.formerror70')}}</a>
                                    </div>
                                </div>
                            </div>
                            </td>
                            <td>`;
                                         Object.entries(value.tags).forEach(entry1 => {
                                                const [key1, value1] = entry1;
                                                html += `${value1.nametag}&nbsp;`;
                                        });
                            html += `</td>
                            <td>
                                ${value.votos}
                            </td>
                            <td>
                                ${value.respuestas}
                            </td>
                            <td>
                                ${value.visitas}
                            </td>
                        </tr>`;
            
        });
        $('#dt-mant-table').DataTable().clear();
        $('#dt-mant-table').DataTable().destroy();
        $('#tbody').html(html);
        $('#tbody').css("width", "100%");
        
        
        if($('#filter').val() == 0)
        {
            $('#dt-mant-table').DataTable({

                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [2],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [3],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [4],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": true
                    },
                ],

                "dom": 'frtip', 

                "fixedHeader": true,

                "responsive": false,      

                "order": [[ 0, "desc" ]],

                "language": {

                    "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

                }

            });
        }
        if($('#filter').val() == 1)
        {
            $('#dt-mant-table').DataTable({

                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [2],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [3],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [4],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": true
                    },
                ],

                "dom": 'frtip', 

                "fixedHeader": true,

                "responsive": false,      

                "order": [[ 3, "desc" ]],

                "language": {

                    "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

                }

            });
        }
        if($('#filter').val() == 2)
        {
            $('#dt-mant-table').DataTable({

                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [2],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [3],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [4],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": true
                    },
                ],

                "dom": 'frtip', 

                "fixedHeader": true,

                "responsive": false,      

                "order": [[ 4, "desc" ]],

                "language": {

                    "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

                }

            });
        }
        if($('#filter').val() == 3)
        {
            $('#dt-mant-table').DataTable({

                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [2],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [3],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [4],
                        "visible": false,
                        "searchable": true
                    },
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": true
                    },
                ],

                "dom": 'frtip', 

                "fixedHeader": true,

                "responsive": false,      

                "order": [[ 5, "desc" ]],

                "language": {

                    "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

                }

            });
        }
    });

</script>

@endsection

