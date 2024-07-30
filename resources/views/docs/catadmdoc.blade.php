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

                    <h3>{{ trans('multi-leng.formerror195')}}</h3>

                    <button  class="btn btn-success btn-sm addcat" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror192')}}" data-html="true">{{ trans('multi-leng.formerror189')}}</button>
                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans('multi-leng.namecat')}}</th>

                                <th>{{ trans('multi-leng.formerror80')}}</th>
                                
                                <th>{{ trans('multi-leng.fechcrecat')}}</th>

                                <th>{{ trans('multi-leng.formerror196')}}</th>

                                <th>{{ trans('multi-leng.formerror22')}}</th>

                            </tr>

                        </thead>

                            @foreach($cat as $row => $slice)
                            <tr>
                                <td>{{ $cat[$row]['namecatdoc'] }}</td>

                                <td>{{ $cat[$row]['nombreus'] }}</td>

                                <td>{{ $cat[$row]['fechaini'] }}</td>

                                <td>{{ $cat[$row]['fechafin'] }}</td>

                                <td> 
                                    
                                    <button class="btn btn-warning btn-block btn-sm mb-1 editcat" data-id="{{ $cat[$row]['idcatdoc'] }}" data-name="{{ $cat[$row]['namecatdoc'] }}"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;{{ trans('lang.editar')}}</button>
                                    <button class="btn btn-danger btn-block btn-sm mb-1 deletebook" data-id="{{ $cat[$row]['idcatdoc'] }}" data-name="{{ $cat[$row]['namecatdoc'] }}"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;{{ trans('lang.eliminar')}}</button>

                                </td>

                            </tr>
                            @endforeach

                        <tbody>
                            

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal -->

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

    $(function () {

        $('[data-toggle="tooltip"]').tooltip()

    });

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table').DataTable({

            //"dom": 'lfrtip'

            "dom": 'frti', 

            fixedHeader: true,

            responsive: true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });
    $(".editcat").click(function(e){

        var texto = $(this).data("name");

        $( "#staticBackdropLabelforo" ).html("{{ trans('lang.editar')}}");

        $( "#modalbodyforo" ).html(`
                            <form id="formedit" method="POST" action="{{ url('') }}/editar-categoria-admin-documentos" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="idcat" name="idcat" value="${$(this).data("id")}">
                            <div class="form-group">
                                <label for="namecat"><b>{{ trans('multi-leng.namecat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamecat') }}" data-html="true"></i></label>
                                <input type="text" class="form-control" id="namecat" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namecat') }}" value="${texto}" required>
                                <small id="nameHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror1') }}</small>
                            </div>
                            <button type="submit" class="btn btn-success">{{ trans('lang.editar')}}</button>
                            </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });
    $(".deletebook").click(function(e){

        var texto = $(this).data("name");

        $( "#staticBackdropLabelforo" ).html("{{ trans('lang.eliminar')}}");

        $( "#modalbodyforo" ).html(`
                            <form id="formeditdoc" method="POST" action="{{ url('') }}/eliminar-categoria-book-admin-documentos" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="idbook" name="idbook" value="${$(this).data("id")}">
                            <div class="form-group">
                                <label for="namebook"><b>{{ __('multi-leng.formerror97') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror99') }}" data-html="true"></i></label> 
                                <input type="text" class="form-control" id="namebook" name="namebook" aria-describedby="namebookHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.formerror98') }}" value="${texto}" readonly> 
                                <small id="namebookHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror97') }}</small>
                            </div>
                            <div class="form-group">
                                <p>{{ __('multi-leng.formerror266') }}</p>
                            </div>
                            <button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button>
                            </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });
    $(".addcat").click(function(e){

        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.admcat')}}");

        $( "#modalbodyforo" ).html('<form id="formadd" method="POST" action="{{ url('') }}/ingreso-categoria-admin-documentos" enctype="multipart/form-data">@csrf<div class="form-group"><label for="namecat"><b>{{ trans('multi-leng.namecat')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamecat') }}" data-html="true"></i></label><input type="text" class="form-control" id="namecat" name="namecat" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namecat') }}" required><small id="nameHelp" class="form-text text-danger" style="display:none;">Ingrese un nombre válido</small><button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button></form></div>');

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });

    $(".adddoc").click(function(e){
        var cat = @json($cat);
        var html = "";
        Object.keys(cat).forEach(key => {
            if(key == 0)
            {
                html += `<option value="${cat[key].idcatdoc}" selected>${cat[key].namecatdoc}</option>`;
            }
            else
            {
                html += `<option value="${cat[key].idcatdoc}">${cat[key].namecatdoc}</option>`;
            }
        });
        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror190')}}");

        $( "#modalbodyforo" ).html(`
                            <form id="formadddoc" method="POST" action="{{ url('') }}/ingreso-book-admin-documentos" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="selectcat"><b>{{ trans('multi-leng.namecat')}}</b><small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.infonamecat') }}" data-html="true"></i></label>
                                <select class="form-control" id="selectcat" name="selectcat" aria-describedby="selectcatHelp" required>
                                ${html}
                                </select>
                                <small id="selectcatHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror193') }}</small>
                            </div>
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

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });


       

    $('#staticBackdropforo').on('shown.bs.modal', function (e) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $("#formadd").submit(function(e){

            $("#nameHelp").css("display", "none");

            var error = "";

            var validate = validarnombre($.trim($("#namecat").val()).toUpperCase());

            if($.trim($("#namecat").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if($("#status").val() == 0)

            {

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($("#status").val() == 2)

            {

                error += "{{ __('multi-leng.formerror3') }}<br>";

            }

            if(error != "")

            {

                $("#nameHelp").html(error);

                $("#nameHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

                return true;

            }



        });
        $("#formedit").submit(function(e){

            $("#nameHelp").css("display", "none");

            var error = "";

            var validate = validarnombre($.trim($("#namecat").val()).toUpperCase());

            if($.trim($("#namecat").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

            if($("#status").val() == 0)

            {

                error += "{{ __('multi-leng.formerror2') }}<br>";

            }

            if($("#status").val() == 2)

            {

                error += "{{ __('multi-leng.formerror3') }}<br>";

            }

            if(error != "")

            {

                $("#nameHelp").html(error);

                $("#nameHelp").css("display", "block");

                return false;

            }

            else

            {

                $("#namecat").val($.trim($("#namecat").val()).toUpperCase());

                return true;

            }



        });

        $( ".formadddoc" ).on( "submit", function( event ) {

            
            $("#selectcatHelp").css("display", "none");

            $("#namebookHelp").css("display", "none");

            $("#autorbookHelp").css("display", "none");

            $("#descbookHelp").css("display", "none");

            $("#filebookHelp").css("display", "none");

            var error = "";

            if($.trim($("#selectcat").val()).length == 0)
            {

                $("#selectcatHelp").css("display", "block");

                error += "{{ __('multi-leng.formerror1') }}<br>";

            }

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

        $( ".formeditdoc" ).on( "submit", function( event ) {


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

    function validarnombre(nombre)

    {

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

            }

        });

        $.ajax({

            url: '{{route("validar-nombre-categoria-documentos")}}', 

            type: 'POST',

            async: false,

            dataType: 'json',

            data: {name: nombre},

            success: function(data) {

                $("#status").val(data.val);

            },

            error:function(x,xs,xt){

                //console.log(JSON.stringify(x));

                console.log("error validarnombre")

                $("#status").val(0);

            }

        });

    }
    

</script>

@endsection

