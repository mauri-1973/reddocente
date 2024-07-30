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

                    <h3>{{ trans('multi-leng.userdetal')}} ({{ trans('multi-leng.multi2')}})</h3>

                    @if($catego > 0)

                    <a href="{{ route('mostrar-formulario-tipo-usuario', ['tipo' => 'academicos']) }}" class="btn btn-success btn-sm">{{ trans('multi-leng.addnewuser')}}</a>
                    <!--<a href="{{ route('exportar-usuarios-excel-administrador') }}" class="btn btn-primary btn-sm">Importar Excel</a>-->

                    <button  class="btn btn-primary btn-sm importexcel" disabled>{{ trans("multi-leng.a264")}}</button>

                    <a href="{{ route('solicitudes-ingreso-docentes-formulario') }}" class="btn btn-warning btn-sm">{{ trans("multi-leng.a279")}}</a>

                    @else

                    <button class="btn btn-success btn-sm" disabled>{{ trans('multi-leng.addnewuser')}}</button>

                    <p id="nocat"><strong>{{ trans('multi-leng.noacademicos')}}</strong></p>

                    @endif

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

                                        <img style="width:100px;height:auto;" id="logouser" src="{{asset('storage/profile-pic/sinregistro.png')}}" alt="{{$row->name}}" class="avatar border-gray"/>

                                    @endif

                                </td>

                                <td>

                                    <div style="display:flex;">

                                    <a href="{{route('users.edit',$row->id)}}" class="btn btn-warning btn-sm">{{ trans('lang.editar') }}</a>

                                        &nbsp;

                                    <form id="delete_form{{$row->id}}" method="POST" action="{{ route('users.destroy',$row->id) }}" onclick="return confirm('{{ trans("multi-leng.areyousur")}}')">

                                        @csrf

                                        <input name="_method" type="hidden" value="DELETE">

                                        <input name="tipo" type="hidden" value="aca">

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

<div class="modal" tabindex="-1" role="dialog" id="modaliframe">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header" style="color:#fff;padding:9px 15px;border-bottom:1px solid #eee;background-color: #5cb85c; -webkit-border-top-left-radius: 5px;

            -webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;

            border-top-right-radius: 5px;">

                <h5 class="modal-title" id="modaltitle">Modal title</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="modalbody">

                

            </div>

            <div class="modal-footer" id="modalfooter">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('lang.cancelar') }}</button>

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

    $( ".importexcel" ).on( "click", function() {
        let cat = @json($arraycat);
        let html = '';
        Object.entries(cat).forEach(([key, value]) => {
            //console.log(`${key} ${value}`);
            html += '<optgroup label="'+cat[`${key}`]['nombrecat']+'">';
            Object.entries(cat[`${key}`]['arraysub']).forEach(([key1, value1]) => {
                html += '<option value="'+cat[`${key}`]['arraysub'][`${key1}`]['idsub']+'">'+cat[`${key}`]['arraysub'][`${key1}`]['nombresub']+'</option>';
            });
            html += '</optgroup>';
        });

        $( "#modaltitle" ).html('{{ trans("multi-leng.a264")}}');

        $( "#modalbody" ).html(`<form id="adddocexcel" method="POST" action="{{ route('agregar-usuarios-excel-administrador') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-2 mb-4">
                                    <label class="form-label"><b>{{ __('multi-leng.admsubcat') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror13') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                    <select class="form-control @error('subcat') is-invalid @enderror" data-btn-class="btn-success btn-block" id="subcat" name="subcat[]" multiple data-live-search="true" data-live-search-placeholder="{{ __('multi-leng.formerror12') }}">
                                    ${html}
                                    </select>
                                    <small id="error1" style="color:red"></small>
                                </div>
                                <div class="form-group mt-2 mb-4">
                                    <label class="form-label"><b>{{ __('multi-leng.a267') }}</b>&nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.a268') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                                    <div class="input-group custom-file-button">
                                        <label for="docexcel" class="form-control" id="docexcel-label" role="button">{{ __('multi-leng.a266') }}</label>
                                        <label class="input-group-text" for="review-image" role="button">{{ __('multi-leng.a265') }}</label>
                                        <input type="file" class="d-none" id="docexcel" name="docexcel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    </div>
                                    <small id="error2" style="color:red"></small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">{{ trans("multi-leng.a264")}}</button>
                                </form>`);
        $( "#modaliframe" ).modal('show');

    } );

    $('#modaliframe').on('show.bs.modal', function (e) {
        $(function () {

        $('[data-toggle="tooltip"]').tooltip()

        });

        $('#subcat').extendSelect({

        // Search input placeholder:

        search: '{{ __('multi-leng.formerror12') }}',

        // Title if option not selected:

        notSelectedTitle: '{{ __("multi-leng.formerror10") }}',

        // Message if select list empty:

        empty: '{{ __("multi-leng.formerror11") }}',

        // Class to active element

        activeClass: 'active',

        // Class to disabled element

        disabledClass: 'disabled',

        // Custom error message for all selects (use placeholder %items)

        maxOptionMessage: 'Max %items elements',

        // Delay to hide message

        maxOptionMessageDelay: 2000,

        // Popover logic (resize or save height)

        popoverResize: true,

        // Auto resize dropdown by button width

        dropdownResize: true

        }); 
        $('#docexcel').change(function(e) {
            $('#error2').html('');

            var file = $(this).val();

            if(this.files[0].size > 10000000) 
            {
                $('#error2').html('{{ __("multi-leng.a272") }}');
                $(this).val('');
            }
            else if (!(/\.(xlsx)$/i).test(file)) 
            {
                $('#error2').html('{{ __("multi-leng.a273") }}');
                $(this).val('');
            }
            else
            {
                let fileName = (e.target.files.length > 0) ? e.target.files[0].name : 'choose_file_not';
                $('#docexcel-label').text(fileName);
            }
            
        });

        $('#adddocexcel').on('submit', function(e){
            $('#error1').html('');
            $('#error2').html('');
            let file = $('#docexcel').val();
            e.preventDefault();
            if($.trim($("#subcat").val()).length == 0) {
                //this.submit();
                $('#error1').html('{{ __("multi-leng.a274") }}');
            }
            else if($.trim(file).length == 0) {
                //this.submit();
                $('#error2').html('{{ __("multi-leng.a275") }}');
            }
            else
            {
                this.submit();
            }
        });
    });
    
    

</script>

@endsection

