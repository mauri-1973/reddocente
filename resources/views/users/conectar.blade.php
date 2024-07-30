@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

@endsection

@section('index')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="">
                    <h3>{{ trans('multi-leng.formerror244')}}</h3>

                    
                </div>
                <div class="card-body">
                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ trans('lang.nombreuser')}}</th>
                                <th>{{ trans('lang.apellidouser')}}</th>
                                <th>Email</th>
                                <th>{{ trans('lang.moviluser')}}</th>
                                <th>{{ trans('multi-leng.formerror233')}}</th>
                                <th>Avatar</th>
                                <th>Tags</th>
                                <th>Action</th>
                                <th>Oculto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($array as $row => $slice)
                            <tr>
                                <td>{{ $array[$row]['nombre'] }}</td>
                                <td>{{ $array[$row]['apellidos'] }}</td>
                                <td>{{ $array[$row]['email'] }}</td>
                                <td>{{ $array[$row]['movil'] }}</td>
                                <td>{{ $array[$row]['prof'] }}</td>
                                <td class="text-center">
                                <img src="{{ asset('storage/profile-pic')}}/{{ $array[$row]['avatar'] }}" alt="{{ $array[$row]['apellidos'] }}" data-email="{{ $array[$row]['email'] }}" style="width:85px;"> 
                                
                                </td>
                                <td>
                                    @foreach($array[$row]['tags'] as $r => $s)
                                    #{{ $array[$row]['tags'][$r]['tagnom'] }},&nbsp;
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn-block mb-1 sendmail" onclick="mostform('{{$array[$row]["nombre"].' '. $array[$row]["apellidos"]}}', '{{$array[$row]["email"]}}', '{{ Crypt::encrypt($array[$row]["idus"]) }}' )"  style="width:200px;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; {{ trans('multi-leng.formerror254')}}</button>
                                    @if($array[$row]['movil'] != '')
                                    <a href="tel:+56{{ $array[$row]['movil'] }}" role="button" class="btn btn-primary btn-sm mb-1" style="width:200px;"><i class="fa fa-phone" aria-hidden="true"></i>
                                    &nbsp;{{ trans('multi-leng.formerror255')}}</a>
                                    @endif
                                    @if(substr($array[$row]['movil'], -9, 1) == 9)
                                    <a href="https://api.whatsapp.com/send?phone=56{{ $array[$row]['movil'] }}&text=Hola%20,te%20contacto%20desde%20Red%20Docente%20Innovador%20para%20contactar%20por%20este%20canal." target="_blank" role="button" class="btn btn-sm mb-1" style="width:200px;background-color:#27d268"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Whatsapp</a>
                                    @endif
                                    
                                </td>
                                <td>
                                    @foreach($array[$row]['tags'] as $r => $s)
                                    {{ $array[$row]['tags'][$r]['tagnom'] }},&nbsp;
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
@endsection

@section('extra-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('#dt-mant-table').DataTable({
            //"dom": 'lfrtip'
            "dom": 'frtip', 
            "pageLength": 15,
            "fixedHeader": true,
            "responsive": true,      
            "order": [[ 1, "asc" ]],
            "columnDefs": [
                            {
                                "targets": [ 8 ],
                                "visible": false,
                                "searchable": true
                            },
                        ],  
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
    });

    function mostform(nombre, email, id)
    {
        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror239')}}"+nombre);

        $( "#modalbodyforo" ).html(`<form class="formdelcat" id="formdelcat" name="formdelcat" method="POST" action="{{ url('') }}/enviar-email-conectar-usuarios-registrados" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="idhacia" name="idhacia" value="`+id+`">
                                    <div class="form-group">
                                        <label for="name"><b>{{ trans('multi-leng.formerror81')}}</b></label>
                                        <input type="text" class="form-control" id="name" value="`+nombre+`" name="name" aria-describedby="nameHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required readonly>
                                        <small id="nameHelp" class="form-text text-danger" style="display:none;"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="emai"><b>{{ trans('multi-leng.formerror81')}}</b></label>
                                        <input type="text" class="form-control" id="email" value="`+email+`" name="email" aria-describedby="emailHelp" minlength="2" maxlength="50" size="50" placeholder="{{ __('multi-leng.namesubcat') }}" required readonly>
                                        <small id="emailHelp" class="form-text text-danger" style="display:none;"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag5"><b>{{ trans('multi-leng.formerror240')}}</b><small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror242') }}" data-html="true"></i></label> 
                                        <input type="text" class="form-control" id="asunto" name="asunto" minlength="2" maxlength="50" size="50" placeholder="{{ trans('multi-leng.formerror240')}}" aria-describedby="asuntoHelp">
                                        <small id="asuntoHelp" class="form-text text-danger" style="display:none;"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="summernote"><b>{{ trans('multi-leng.formerror241')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                                        <textarea class="form-control" id="summernote" name="summernote" aria-describedby="summernoteHelp"></textarea>
                                        <small id="summernoteHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror243') }}</small>
                                    </div>
                                    <button type="submit" class="btn btn-danger">{{ trans('lang.enviar')}}</button>
                                    </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');
    }

    $('#staticBackdropforo').on('show.bs.modal', function (event) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#summernote').summernote({
            dialogsInBody: true,
            placeholder: '{{ trans('multi-leng.formerror241')}}',
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

        $("#formdelcat").submit(function(e){

            $("#asuntoHelp").css("display", "none");
            $("#summernoteHelp").css("display", "none");
            var error = "";

            if($.trim($("#asunto").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror242') }}<br>";

                $("#asuntoHelp").html(error);

                $("#asuntoHelp").css("display", "block");

            }

            if($.trim($("#summernote").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror243') }}<br>";

                $("#summernoteHelp").html(error);

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

    });
    
</script>
@endsection
