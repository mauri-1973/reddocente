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

                    <h3>{{ trans('multi-leng.formerror74')}}</h3>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans('multi-leng.admcat')}}</th>

                                <th>{{ trans('multi-leng.admsubcat')}}</th>

                                <th>{{ trans('multi-leng.formerror191')}}</th>
                                
                                <th>{{ trans('multi-leng.formerror80')}}</th>

                                <th>{{ trans('multi-leng.formerror26')}}</th>

                                <th>{{ trans('multi-leng.formerror22')}}</th>

                            </tr>

                        </thead>

                        <tbody>
                            @foreach($book as $row)
                            <tr>
                                <td>{{ $row->namecat }}</td>

                                <td>{{ $row->subcat }}</td>

                                <td>{{ $row->nombre }}</td>

                                <td>{{ $row->autor }}</td>

                                <td>{{ $row->descripcion }}</td>

                                <?php $val = url('/').'/visor-pdf-documentos-digitales-externo/'.$row->key;  ?>

                                <td> 
                                    <a class="btn btn-primary btn-block btn-sm mb-1" href="{{url('')}}/storage/DocAdm/{{ $row->carpeta }}" download="{{ $row->nombre }}" role="button"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{ trans('multi-leng.formerror93')}}</a>
                                    <a class="btn btn-success btn-block btn-sm mb-1" target="_blank" href="{{url('/')}}/visor-pdf-documentos-digitales/{{ Crypt::encryptString('/storage/DocAdm/'.$row->carpeta) }}" role="button"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;{{ trans('multi-leng.formerror263')}}</a>
                                    <a class="btn btn-warning btn-block btn-sm mb-1"  href='javascript:getlink("{{ $val }}" )' role="button"><i class="fa fa-share-alt" aria-hidden="true"></i>&nbsp;{{ trans('multi-leng.formerror198')}}</a>
                                     
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
            //"dom": 'lfrtip'
            "columnDefs": [
                            {
                                "targets": [ 3 ],
                                "visible": false,
                                "searchable": true
                            },
                        ],

            "dom": 'frti', 

            "fixedHeader": true,

            "responsive": true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });
    
    function compartir(url)
    {
        var texto = url;

        $( "#staticBackdropLabelforo" ).html("{{ __('multi-leng.formerror198') }}");

        $( "#modalbodyforo" ).html(`
                            
                            <div class="form-group">
                                <label for="namecat"><b>{{ trans('multi-leng.formerror201')}}</b></label>
                                
                                <p class="form-control" id="copytextarea">${texto}</p>
                                <small id="nameHelp" class="form-text text-danger" style="display:none;">{{ trans("multi-leng.formerror200")}}</small>
                            </div>
                            <button id="copy" class="btn btn-success" onclick="copyClipboard('#copytextarea')">{{ trans("multi-leng.formerror199")}}</button>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans("lang.cancelar")}}</button>');

        $( "#staticBackdropforo" ).modal('show');
    }
    
    $('#staticBackdropforo').on('shown.bs.modal', function (e) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        document.getElementById('copy').addEventListener('click', copiarAlPortapapeles);  
            

    });

</script>
<script>//<![CDATA[
    function getlink(link) 
    {
        var aux = document.createElement("input");
        aux.setAttribute("value", link.split("?")[0].split("#")[0]);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        var css = document.createElement("style");
        var estilo = document.createTextNode("#aviso {position:fixed; z-index: 9999999; widht: 120px; top:30%;left:50%;margin-left: -60px;padding: 20px; background: #004238;border-radius: 8px;font-size: 14px;font-family: sans-serif;color:#fff;}");
        css.appendChild(estilo);
        document.head.appendChild(css);
        var aviso = document.createElement("div");
        aviso.setAttribute("id", "aviso");
        var contenido = document.createTextNode("{{ trans('multi-leng.formerror200')}}");
        aviso.appendChild(contenido);
        document.body.appendChild(aviso);
        window.load = setTimeout("document.body.removeChild(aviso)", 2000);
    }
//]]></script>
@endsection

