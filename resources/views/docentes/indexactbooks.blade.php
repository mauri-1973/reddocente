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

                    <h3>{{ trans('multi-leng.formerror90')}}</h3>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                        <tr>

                            <th style="width:35%">{{ trans('multi-leng.formerror81')}}</th>

                            <th>{{ trans('multi-leng.formerror82')}}</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($array as $row => $slice)

                        <tr>

                            <td style="white-space:normal;">{{ $array[$row]['namesub'] }}</td>

                            <td style="white-space:normal;">

                                <button data-idrec="{{ $array[$row]['idrec'] }}" data-idsub="{{ $array[$row]['idsub'] }}" data-namesub="{{ $array[$row]['namesub'] }}" class="btn btn-success btn-sm btn-block mt-2 mb-2 addbook">{{ trans('multi-leng.formerror94')}}</button>

                                @foreach($array[$row]['arreglolib'] as $books => $book)

                                    <div class="container table-responsive">

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('multi-leng.formerror81')}}</strong>

                                            </div>

                                            <div class="col-8" style="white-space:normal;">

                                                <strong>{{ $array[$row]['arreglolib'][$books]['nombre'] }}</strong>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('multi-leng.formerror80')}}</strong>

                                            </div>

                                            <div class="col-8" style="white-space:normal;">

                                                <strong>{{ $array[$row]['arreglolib'][$books]['autor'] }}</strong>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('multi-leng.formerror79')}}</strong>

                                            </div>

                                            <div class="col-8" style="white-space:normal;">

                                                <strong>{{ $array[$row]['arreglolib'][$books]['desc'] }}</strong>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('multi-leng.formerror78')}}</strong>

                                            </div>

                                            <div class="col-8" style="white-space:normal;">

                                                <strong>{{ $array[$row]['arreglolib'][$books]['fecha'] }}</strong>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>Link</strong>

                                            </div>

                                            <div class="col-8 pt-1 pb-1" style="white-space:normal;">

                                                <a class="btn btn-primary btn-block btn-sm" href="{{url('')}}/{{ $array[$row]['arreglolib'][$books]['folder'] }}" download="{{ $array[$row]['arreglolib'][$books]['nombre'] }}" role="button">{{ trans('multi-leng.formerror93')}}</a>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('multi-leng.formerror76')}}</strong>

                                            </div>

                                            <div class="col-8 pt-1 pb-1" style="white-space:normal;">

                                                <a class="btn btn-success btn-block btn-sm" target="_blank" href="{{url('/')}}/visor-pdf-documentos-digitales/{{ $array[$row]['arreglolib'][$books]['string'] }}" role="button">{{ $array[$row]['arreglolib'][$books]['nombre'] }}</a>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('lang.editar')}}</strong>

                                            </div>

                                            <div class="col-8 pt-1 pb-1" style="white-space:normal;">

                                                <button class="btn btn-warning btn-block btn-sm editbook" data-id="{{ $array[$row]['arreglolib'][$books]['idbook'] }}" data-name="{{ str_replace('.pdf', '', $array[$row]['arreglolib'][$books]['nombre'] ) }}" data-autor="{{ $array[$row]['arreglolib'][$books]['autor'] }}" data-desc="{{ $array[$row]['arreglolib'][$books]['desc'] }}" data-folder="{{ $array[$row]['arreglolib'][$books]['string'] }}">{{ trans('lang.editar')}}</a>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-4" style="white-space:normal;">

                                                <strong>{{ trans('lang.eliminar')}}</strong>

                                            </div>

                                            <div class="col-8 pt-1 pb-1" style="white-space:normal;">

                                                <button class="btn btn-danger btn-block btn-sm delbook" data-id="{{ $array[$row]['arreglolib'][$books]['idbook'] }}" data-name="{{ str_replace('.pdf', '', $array[$row]['arreglolib'][$books]['nombre'] ) }}" data-autor="{{ $array[$row]['arreglolib'][$books]['autor'] }}" data-desc="{{ $array[$row]['arreglolib'][$books]['desc'] }}" data-folder="{{ $array[$row]['arreglolib'][$books]['string'] }}">{{ trans('lang.eliminar')}}</button>

                                            </div>

                                        </div>

                                    </div>

                                    <hr>

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

            responsive: true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });

    $(".addbook").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.formerror94')}}: "+$(this).data("namesub"));

        $( "#modalbody" ).html(`<form class="formaddbook" method="POST" action="{{ url('') }}/ingresar-documento-biblioteca-docente" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="idrec" name="idrec" value="${$(this).data("idrec")}">
            <input type="hidden" id="idsub" name="idsub" value="${$(this).data("idsub")}"> 
            <div class="form-group">
                <label for="namebook"><b>{{ __('multi-leng.formerror97') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror99') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="namebook" name="namebook" aria-describedby="namebookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror98') }}" required> 
                <small id="namebookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror97') }}</small>
            </div> 
            <div class="form-group">
                <label for="autorbook"><b>{{ __('multi-leng.formerror100') }}</b>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror102') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="autorbook" name="autorbook" aria-describedby="autorbookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror101') }}">
                <small id="autorbookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror108') }}</small>
            </div> 
            <div class="form-group">
                <label for="descbook"><b>{{ __('multi-leng.formerror26') }}</b>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror104') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="descbook" name="descbook" aria-describedby="descbookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror103') }}">
                <small id="descbookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror109') }}</small>
            </div> 
            <div class="form-group">
                <label for="filebook"><b>{{ __('multi-leng.formerror105') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror106') }}" data-html="true"></i></label> 
                <input type="file" class="form-control" id="filebook" name="filebook" aria-describedby="filebookHelp" accept=".pdf" required>
                <small id="filebookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror107') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
        </form>`);

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });
    $(".editbook").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('lang.editar')}}: "+$(this).data("name"));

        $( "#modalbody" ).html(`<form class="formeditbook" method="POST" action="{{ url('') }}/editar-documento-biblioteca-docente" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="idbook" name="idbook" value="${$(this).data("id")}">
            <input type="hidden" id="folder" name="folder" value="${$(this).data("folder")}"> 
            <div class="form-group">
                <label for="namebook"><b>{{ __('multi-leng.formerror97') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror99') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="namebook" name="namebook" aria-describedby="namebookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror98') }}" value="${$(this).data("name")}" required> 
                <small id="namebookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror97') }}</small>
            </div> 
            <div class="form-group">
                <label for="autorbook"><b>{{ __('multi-leng.formerror100') }}</b>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror102') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="autorbook" name="autorbook" aria-describedby="autorbookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror101') }}" value="${$(this).data("autor")}">
                <small id="autorbookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror108') }}</small>
            </div> 
            <div class="form-group">
                <label for="descbook"><b>{{ __('multi-leng.formerror26') }}</b>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror104') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="descbook" name="descbook" aria-describedby="descbookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror103') }}" value="${$(this).data("desc")}">
                <small id="descbookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror109') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
        </form>`);

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });

    $(".delbook").click(function(e){

        $( "#staticBackdropLabel" ).html("{{ trans('lang.eliminar')}}: "+$(this).data("name"));

        $( "#modalbody" ).html(`<form class="formelibook" method="POST" action="{{ url('') }}/eliminar-documento-biblioteca-docente" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="idbook" name="idbook" value="${$(this).data("id")}">
            <input type="hidden" id="folder" name="folder" value="${$(this).data("folder")}"> 
            <div class="form-group">
            <p><strong class="form-text text-danger">Está seguro de eliminar, este recurso digital, pues esta accion es irreversible.</strong></p><br>
            </div>
            <button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button>
        </form>`);

        $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdrop" ).modal('show');

    });
    $('#staticBackdrop').on('show.bs.modal', function (event) {
        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });
        $( ".formaddbook" ).on( "submit", function( event ) {

            $("#namebookHelp").css("display", "none");

            $("#autorbookHelp").css("display", "none");

            $("#descbookHelp").css("display", "none");

            $("#filebookHelp").css("display", "none");

            var error = "";

            if($.trim($("#namebook").val()).length < 2)
            {

                $("#namebookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if($.trim($("#autorbook").val()).length > 0 && $.trim($("#autorbook").val()).length < 2)
            {

                $("#autorbookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($.trim($("#descbook").val()).length > 0 && $.trim($("#descbook").val()).length < 2)
            {

                $("#descbookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($('#filebook').get(0).files.length === 0)
            {

                $("#filebookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror3') }}<br>";

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
        $( ".formeditbook" ).on( "submit", function( event ) {

            $("#namebookHelp").css("display", "none");

            $("#autorbookHelp").css("display", "none");

            $("#descbookHelp").css("display", "none");

            var error = "";

            if($.trim($("#namebook").val()).length < 2)
            {
                $("#namebookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror1') }}<br>";
            }

            if($.trim($("#autorbook").val()).length > 0 && $.trim($("#autorbook").val()).length < 2)
            {
                $("#autorbookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($.trim($("#descbook").val()).length > 0 && $.trim($("#descbook").val()).length < 2)
            {
                $("#descbookHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror2') }}<br>";

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
    });

    
    

</script>

@endsection

