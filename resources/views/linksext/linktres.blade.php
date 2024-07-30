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

                    <h3>{{ trans('multi-leng.formerror264')}} {{ $tipo }}</h3>
                    @if(Auth::user()->cargo_us == "Administrador")
                    <button  class="btn btn-success btn-sm" onclick="addlink('{{$tipo}}','', '', 0, '{{Crypt::encrypt(0)}}')">{{ trans('multi-leng.addsubcatbtn')}}</button>
                    @endif
                
                </div>

                <div class="card-body">
                    @foreach($link as $li)
                    <p>{{ $li->nombresub }} : 
                        @if($li->tipo == 1)

                        <a class="btn btn-link btn-sm"  href="{{ $li->urlext }}"  target="_blank" role="button">{{ trans('multi-leng.formerror292')}} {{ substr($li->urlext, 0, 13) }}...</a>

                        @else
                            @if($li->urlext != '#' && $li->urlext != '')
                                <a class="btn btn-link btn-sm" href="{{url('ver-link-embed-administrador-web', ['id' => Crypt::encrypt($li->idlinkext) ])}}" role="button">{{ trans('multi-leng.formerror292')}} {{ substr($li->urlext, 0, 13) }}...</a>
                            @else
                                <a class="btn btn-link btn-sm" href="#" role="button">{{ $li->urlext }}</a>
                            @endif

                        @endif
                        @if(Auth::user()->cargo_us == "Administrador")
                        <button type="button" class="btn btn-success btn-sm" onclick="editarlink('{{$li->nombreini}}','{{$li->nombresub}}', '{{$li->urlext}}', {{$li->tipo}}, '{{Crypt::encrypt($li->idlinkext)}}')">{{ trans('lang.editar')}}</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarlink('{{$li->nombreini}}','{{$li->nombresub}}', '{{$li->urlext}}', {{$li->tipo}}, '{{Crypt::encrypt($li->idlinkext)}}')">{{ trans('lang.eliminar')}}</button>
                        @endif
                    </p>
                    @endforeach

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

            <button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>

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

    });

    function addlink(nombreprin, nombreseh, url, tipo, id)
    {
        var html = "";
        var html1 = "";
        if(url == "#")
        {
            html1 += ``;
        }
        else
        {
            html1 += url;
        }
        if(tipo == 0)
        {
            html += `<div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" checked>
                        <label class="form-check-label" for="inlineRadio1">{{ trans('multi-leng.formerror290')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1">
                        <label class="form-check-label" for="inlineRadio2">{{ trans('multi-leng.formerror291')}}</label>
                    </div>`;
        }
        else
        {
            html += `<div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0">
                        <label class="form-check-label" for="inlineRadio1">{{ trans('multi-leng.formerror290')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" checked>
                        <label class="form-check-label" for="inlineRadio2">{{ trans('multi-leng.formerror291')}}</label>
                    </div>`;
        }
        $('#staticBackdropLabelforo').html('{{ trans('multi-leng.formerror227')}} : '+nombreprin);
        $('#modalbodyforo').html(`
        <form id="form_validation" method="POST" action="{{url('editar-sub-categoria-link-externo')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="idlink" name="idlink" value="${id}">
            <input type="hidden" class="form-control" id="tipoact" name="tipoact" value="2">
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror283')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="cat" name="cat" aria-describedby="catHelp" placeholder="Categoría" value="${nombreprin}" readonly>
                <small style="display:none;color:red" id="catHelp" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror284')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="catsub" name="catsub" aria-describedby="catsubHelp" placeholder="{{ trans('multi-leng.formerror284')}}" value="${nombreseh}">
                <small style="display:none;color:red" id="catsubHelp" class="form-text text-danger">{{ trans('multi-leng.formerror293')}}</small>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror285')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror286')}}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="urlcatsub" name="urlcatsub" aria-describedby="urlcatsubHelp" placeholder="{{ trans('multi-leng.formerror287')}}" value="${html1}">
                <small style="display:none;color:red" id="urlcatsubHelp" class="form-text text-danger">{{ trans('multi-leng.formerror228')}}</small>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror288')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror289')}}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <br>
                ${html}
            </div>
            <button type="submit" class="btn btn-success">{{ trans('multi-leng.formerror227')}}</button>
        </form>
        `);
        $('#staticBackdropforo').modal('show');
    }

    function editarlink(nombreprin, nombreseh, url, tipo, id)
    {
        var html = "";
        var html1 = "";
        if(url == "#")
        {
            html1 += ``;
        }
        else
        {
            html1 += url;
        }
        if(tipo == 0)
        {
            html += `<div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" checked>
                        <label class="form-check-label" for="inlineRadio1">{{ trans('multi-leng.formerror290')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1">
                        <label class="form-check-label" for="inlineRadio2">{{ trans('multi-leng.formerror291')}}</label>
                    </div>`;
        }
        else
        {
            html += `<div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0">
                        <label class="form-check-label" for="inlineRadio1">{{ trans('multi-leng.formerror290')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" checked>
                        <label class="form-check-label" for="inlineRadio2">{{ trans('multi-leng.formerror291')}}</label>
                    </div>`;
        }
        $('#staticBackdropLabelforo').html('{{ trans('lang.editar')}} : '+nombreseh);
        $('#modalbodyforo').html(`
        <form id="form_validation" method="POST" action="{{url('editar-sub-categoria-link-externo')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="idlink" name="idlink" value="${id}">
            <input type="hidden" class="form-control" id="tipoact" name="tipoact" value="0">
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror283')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="cat" name="cat" aria-describedby="catHelp" placeholder="Categoría" value="${nombreprin}" readonly>
                <small style="display:none;color:red" id="catHelp" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror284')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="catsub" name="catsub" aria-describedby="catsubHelp" placeholder="{{ trans('multi-leng.formerror284')}}" value="${nombreseh}">
                <small style="display:none;color:red" id="catsubHelp" class="form-text text-danger">{{ trans('multi-leng.formerror293')}}</small>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror285')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror286')}}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="urlcatsub" name="urlcatsub" aria-describedby="urlcatsubHelp" placeholder="{{ trans('multi-leng.formerror287')}}" value="${html1}">
                <small style="display:none;color:red" id="urlcatsubHelp" class="form-text text-danger">{{ trans('multi-leng.formerror228')}}</small>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror288')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror289')}}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <br>
                ${html}
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.editar')}}</button>
        </form>
        `);
        $('#staticBackdropforo').modal('show');
    }

    function eliminarlink(nombreprin, nombreseh, url, tipo, id)
    {
        var html = "";
        var html1 = "";
        if(url == "#")
        {
            html1 += ``;
        }
        else
        {
            html1 += url;
        }
        if(tipo == 0)
        {
            html += `<div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" checked disabled>
                        <label class="form-check-label" for="inlineRadio1">{{ trans('multi-leng.formerror290')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" disabled>
                        <label class="form-check-label" for="inlineRadio2">{{ trans('multi-leng.formerror291')}}</label>
                    </div>`;
        }
        else
        {
            html += `<div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" disabled>
                        <label class="form-check-label" for="inlineRadio1">{{ trans('multi-leng.formerror290')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" checked disabled>
                        <label class="form-check-label" for="inlineRadio2">{{ trans('multi-leng.formerror291')}}</label>
                    </div>`;
        }
        $('#staticBackdropLabelforo').html('{{ trans('lang.eliminar')}} : '+nombreseh);
        $('#modalbodyforo').html(`
        <form id="form_validation_delete" method="POST" action="{{url('editar-sub-categoria-link-externo')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="idlink" name="idlink" value="${id}">
            <input type="hidden" class="form-control" id="tipoact" name="tipoact" value="1">
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror283')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="cat" name="cat" aria-describedby="catHelp" placeholder="Categoría" value="${nombreprin}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror284')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.caracteresname') }}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="catsub" name="catsub" aria-describedby="catsubHelp" placeholder="{{ trans('multi-leng.formerror284')}}" value="${nombreseh}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror285')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror286')}}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <input type="text" class="form-control" id="urlcatsub" name="urlcatsub" aria-describedby="urlcatsubHelp" placeholder="{{ trans('multi-leng.formerror287')}}" value="${html1}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label"><b>{{ trans('multi-leng.formerror288')}}</b> &nbsp;&nbsp;<i style="color:#004238;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror289')}}" data-html="true"></i>&nbsp; <small style="color:red;font-size:8px;">(* {{ __('lang.infoobli') }})</small></label>
                <br>
                ${html}
            </div>
            <button type="submit" class="btn btn-danger">{{ trans('lang.eliminar')}}</button>
        </form>
        `);
        $('#staticBackdropforo').modal('show');
    }

    $('#staticBackdropforo').on('show.bs.modal', function (e) {
        $(function () {
           console.log("paso");
            $('[data-toggle="tooltip"]').tooltip();

        });
        $( "#form_validation" ).submit(function( event ) 

        {
            $("#catsubHelp").css("display", "none");
            $("#urlcatsubHelp").css("display", "none");
            var error = "";

            if($.trim($("#catsub").val()).length < 2)

            {

                error += "-error 1";
                $("#catsubHelp").css("display", "block");
                

            }

            if(!$.trim($("#urlcatsub").val()).startsWith('https://www.')) 

            {

                error += "error2";
                $("#urlcatsubHelp").css("display", "block");

            }

            if(error != "")

            {
                console.log(error);
                return false;

            }

            else

            {
                
                $( "#catsub" ).val(escapeHtml($( "#catsub" ).val()));

                $( "#urlcatsub" ).val(escapeHtml($( "#urlcatsub" ).val()));

                return true;

            }

        });
        
        
    });

    function escapeHtml(str) {

        var output = str.replace(/<script[^>]*?>.*?<\/script>/gi, '').

        replace(/<[\/\!]*?[^<>]*?>/gi, '').

        replace(/<style[^>]*?>.*?<\/style>/gi, '').

        replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '').

        replace(/&nbsp;/g, '');

        return output;

    }

</script>

@endsection

