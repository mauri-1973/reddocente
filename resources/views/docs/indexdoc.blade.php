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

                    <h3>{{ trans('multi-leng.formerror188')}}</h3>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans('multi-leng.admcat')}}</th>

                                <th>{{ trans('multi-leng.admsubcat')}}</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($arreglo as $p => $slice)

                            <tr> 

                                <td style="width:35%;">

                                    <table class="table table-borderless">

                                        <thead>

                                            <tr>

                                                <th scope="col">

                                                    {{ $arreglo[$p]['nombrecat'] }}

                                                </th>

                                            </tr>

                                        </thead>

                                    </table>

                                </td>

                                <td>

                                    <div class="container">

                                        <div class="row">

                                            @foreach($arreglo[$p]['arreglosub'] as $d => $sli)

                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                <table class="table table-striped">

                                                    <thead>

                                                        <tr>

                                                            <th scope="col">{{ $arreglo[$p]['arreglosub'][$d]["nombresub"] }}</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <button type="button" class="btn btn-success btn-sm btn-block editsubcat" id="link{{ $arreglo[$p]['arreglosub'][$d]['idsub']  }}" data-id='{{ $arreglo[$p]['arreglosub'][$d]['idsub']  }}' data-nombre='{{ $arreglo[$p]['arreglosub'][$d]['nombresub'] }}'>{{ trans('multi-leng.dusdocbtn')}}</button>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </table>

                                                <hr style="height:2px; width:100%; border-width:0; color:gray; background-color:gray">

                                            </div>

                                            @endforeach

                                        </div>

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

  <div class="modal-dialog modal-lg">

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

<input type="hidden" id="urlconfig" name="urlconfig">

<input type="hidden" id="subcatid" name="subcatid">

<input type="hidden" id="subcatname" name="subcatname">

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

    

    

    $(".editsubcat").click(function(e){

        let nombre = $(this).data("nombre");

        let id = $(this).data("id");

        $("#subcatid").val(id);

        $("#subcatname").val(nombre);

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     

            }

        });

        $.ajax({

            url: '{{route("buscar-docentes-sub-categoria-id")}}',

            type: 'POST',

            async: false,

            dataType: 'json',

            data: {id: $("#subcatid").val()},

            success: function(data) {

                let mensaje = "";

                if(data.num == 0)

                {

                    mensaje = "{{ trans('multi-leng.formerror84')}}"+nombre;

                }

                else

                {

                    

                    mensaje +=  `<table id="dt-mant-table-doc" class="table-hover display responsive nowrap" style="width:100%">

                                    <thead>

                                        <tr>

                                            <th style="width:40%">{{ trans('multi-leng.formerror83')}}</th>

                                            <th>{{ trans('multi-leng.formerror82')}}</th>

                                        </tr>

                                    </thead>

                                    <tbody>`; 

                    Object.keys(data.arrayfinal).forEach(key => {

                        mensaje +=  `<tr>

                                        <td style="white-space:normal;" class="text-center"><strong>${data.arrayfinal[key]['nombre']}</strong></td>

                                        <td style="white-space:normal;">`;

                                            if(data.numbooks > 0)

                                            {

                                                Object.keys(data.arrayfinal[key]['arreglolib']).forEach(key1 => {
                                                var url = `{{url('/')}}/visor-pdf-documentos-digitales-externo-docentes/${data.arrayfinal[key]['arreglolib'][key1]['key']}`;

                                                mensaje += `
                                                <div class="table-responsive">

                                                    <table class="table table-borderless" style="width:100%">

                                                        <tr>

                                                            <td><strong>{{ trans('multi-leng.formerror81')}}</strong></td>

                                                            <td style="white-space:normal;"><strong>${data.arrayfinal[key]['arreglolib'][key1]['nombre']}</strong></td>

                                                        </tr>

                                                        <tr>

                                                            <td><strong>{{ trans('multi-leng.formerror80')}}</strong></td>

                                                            <td style="white-space:normal;"><strong>${data.arrayfinal[key]['arreglolib'][key1]['autor']}</strong></td>

                                                        </tr>

                                                        <tr>

                                                            <td><strong>{{ trans('multi-leng.formerror79')}}</strong></td>

                                                            <td style="white-space:normal;"><strong>${data.arrayfinal[key]['arreglolib'][key1]['desc']}</strong></td>

                                                        </tr>

                                                        <tr>

                                                            <td><strong>{{ trans('multi-leng.formerror78')}}</strong></td>

                                                            <td style="white-space:normal;"><strong>${data.arrayfinal[key]['arreglolib'][key1]['fecha']}</strong></td>

                                                        </tr>

                                                        <tr>

                                                            <td><strong>Link</strong></td>

                                                            <td style="white-space:normal;">

                                                                <a class="btn btn-primary btn-block btn-sm" href="{{url('')}}/${data.arrayfinal[key]['arreglolib'][key1]['folder']}" download="${data.arrayfinal[key]['arreglolib'][key1]['nombre']}" role="button">{{ trans('multi-leng.formerror93')}}</a>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td><strong>{{ trans('multi-leng.formerror76')}}</strong></td>

                                                            <td style="white-space:normal;">

                                                                <a class="btn btn-success btn-block btn-sm" target="_blank" href="{{url('/')}}/visor-pdf-documentos-digitales/${data.arrayfinal[key]['arreglolib'][key1]['string']}" role="button">${data.arrayfinal[key]['arreglolib'][key1]['nombre']}</a>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td><strong>{{ trans('multi-leng.formerror201')}}</strong></td>

                                                            <td style="white-space:normal;">

                                                                <button class="btn btn-warning btn-block btn-sm mb-1" onclick="oculto('${url}');getlink();"  href='javascript:getlink()' role="button"><i class="fa fa-share-alt" aria-hidden="true"></i>&nbsp;{{ trans('multi-leng.formerror198')}}</bitton>

                                                            </td>

                                                        </tr>
                                                        

                                                    </table>
                                                </div>`;

                                            });

                                        }

                                        else

                                        {

                                            mensaje += ` <p> <strong>{{ trans('multi-leng.formerror77')}} </strong> </p>`;

                                        }

                                        

                        mensaje +=     `</td>

                                    </tr>`;

                        console.log(key, data.arrayfinal[key]);

                    });

                    mensaje +=      `</tbody>

                                </table>`;

                }

                

                $( "#staticBackdropLabel" ).html("{{ trans('multi-leng.dusdocbtn')}}: "+$("#subcatname").val());

                $( "#modalbody" ).html('<p><b>'+mensaje+'</b></p>');

                $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

                $( "#staticBackdrop" ).modal('show');

            },

            error:function(x,xs,xt){

                //console.log(JSON.stringify(x));

                console.log("error buscar docentes editsubcat");

            }

        });

        

    });

       

    $('#staticBackdrop').on('shown.bs.modal', function (e) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#dt-mant-table-doc').DataTable({

            //"dom": 'lfrtip'

            "dom": 'frti', 

            fixedHeader: true,

            responsive: true,      

            "order": [[ 0, "asc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

        console.log("OK");

    });

    function oculto(url)
    {
        $("#urlconfig").val(url);
        console.log("oculto", $("#urlconfig").val());
    }

</script>

<script>//<![CDATA[
    function getlink() 
    {
        $( "#staticBackdrop" ).modal('hide');
        var link = $("#urlconfig").val();
        console.log("link", link);
        var aux = document.createElement("input");
        aux.setAttribute("value", link.split("?")[0].split("#")[0]);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        var css = document.createElement("style");
        var estilo = document.createTextNode("#aviso {position:fixed; z-index: 9999999; widht: 120px; top:30%;left:50%;margin-left: -60px;padding: 20px; background: #fc9209;border-radius: 8px;font-size: 14px;font-family: sans-serif;color:#000;}");
        css.appendChild(estilo);
        document.head.appendChild(css);
        var aviso = document.createElement("div");
        aviso.setAttribute("id", "aviso");
        var contenido = document.createTextNode("{{ trans('multi-leng.formerror200')}}");
        aviso.appendChild(contenido);
        document.body.appendChild(aviso);
        window.load = setTimeout("document.body.removeChild(aviso)", 2500);
        var idnew = $("#subcatid").val();
        window.load = setTimeout(eventclick, 2510, idnew);
        
         console.log("idlink", 'link'+idnew, "temporizado externo")
    }
//]]>
function eventclick(id){
    $("#link"+id).click();
}
</script>

@endsection

