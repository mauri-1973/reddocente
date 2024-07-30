@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<style>
    .text-success{
        color: #004238 !important;
    }

    .fa{
        color: #004238 !important;
    }

    .viewus:hover {
        background-color: #20c997 !important;
        transition: 0.7s;
    }

</style>

@endsection





@section('index')
<div class="content">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">


                <div class="card-body">

                <a class="btn btn-success" href="{{ url('lluvia-de-ideas-usuarios-registrados' ) }}" role="button">{{ trans('lang.volver')}}</a>

                </div>

            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                
                <div class="row align-items-center">
                    <div class="col-12 mb-3">
                        <h5 data-toggle="tooltip" data-placement="top" title="Título de la publicación" data-html="true">
                            {{$comment->titlebrain}}
                        </h5>
                    </div>
                    <div class="col-12 mb-3">
                        {!! $comment->commbrain !!}
                    </div>
                    <div class="col-md-4 mb-3 mb-sm-0">
                        <p class="text-sm">
                            <span class="op-6">{{ trans('multi-leng.formerror207')}}</span> 
                            <span class="op-6 text-primary">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                            <span class="op-6">{{ trans('multi-leng.formerror211')}}</span>
                        </p>
                        <div class="text-sm op-5">
                           
                        </div>
                    </div>
                    <div class="col-md-8 op-7">
                        <div class="row text-center op-7">
                            <div class="col px-1"> 
                                <i class="fa fa-comment fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror156')}}" data-html="true"></i>
                                <span class="d-block text-sm">{{$comment->brains}} {{ trans('multi-leng.formerror208')}}</span> 
                            </div>
                            <div class="col px-1"> 
                                <form class="formeliprin" id="formeliprin" action="{{ url('') }}/eliminar-idea-principal-usuario-registrado" enctype="multipart/form-data" method="post">
                                @csrf
                                    <input value="{{Crypt::encrypt($comment->idbraincom)}}" id="idcom" name="idcom" type="hidden">
                                    <button type="submit" class="btn btn-danger btn-sm btn-block mt-1" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror215')}}" data-html="true">{{ trans('lang.eliminar')}}</button>
                                </form> 
                            </div>
                            <div class="col px-1"> 
                                <button type="button" class="btn btn-success btn-sm btn-block mt-1 editrespcomment" data-text="{{$comment->commbrain}}" data-id="{{Crypt::encrypt($comment->idbraincom)}}" data-title="{{$comment->titlebrain}}" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror216')}}" data-html="true">{{ trans('lang.editar')}}</button> 
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="">

                    <h3>{{ trans('multi-leng.formerror208')}}</h3>

                </div>

                <div class="card-body">

                    <form class="formaddsub" id="formaddsub" action="{{ url('') }}/enviar-idea-anexa-usuario-registrado" enctype="multipart/form-data" method="post">
                        @csrf
                        <input value="{{Crypt::encrypt($comment->idbraincom)}}" id="idforcom" name="idforcom" type="hidden">
                        <div class="form-group">
                            <label for="summernote"><b>{{ trans('multi-leng.formerror208')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                            <textarea class="form-control" id="summernote" name="summernote" aria-describedby="summernoteHelp"></textarea>
                            <small id="summernoteHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group float-left">
                                    <label for="tag5"><b>{{ trans('multi-leng.formerror212')}}</b></label> 
                                    <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>

                </div>

            </div>

        </div>
        @foreach($resp as $row => $slice)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                <div class="row align-items-center">
                    <div class="col-12 mb-3">
                        <h5 data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror152')}} {{$row + 1}}" data-html="true">
                        {{ trans('multi-leng.formerror208')}} {{$row + 1}}
                    </div>
                    <div class="col-12 mb-3">
                        {!! $slice->brainstext  !!}
                    </div>
                    <div class="col-md-4 mb-3 mb-sm-0">
                        <p class="text-sm op-5">
                            <span class="op-6">{{ trans('multi-leng.formerror207')}}</span> 
                            <span class="op-6 text-primary">{{\Carbon\Carbon::parse($slice->created_at)->diffForHumans() }}</span>
                            <span class="op-6">{{ trans('multi-leng.formerror211')}}</span>
                        </p>
                        <div class="text-sm">
                           
                        </div>
                    </div>
                    <div class="col-md-8 op-7">
                        <div class="row text-center op-7">
                            <div class="col px-1"> 
                                &nbsp;
                            </div>
                            <div class="col px-1"> 
                                <form class="forma" id="forma" action="{{ url('') }}/eliminar-idea-anexa-usuario-registrado" enctype="multipart/form-data" method="post">
                                @csrf
                                    <input value="{{Crypt::encrypt($comment->idbraincom)}}" id="idcom" name="idcom" type="hidden">
                                    <input value="{{ Crypt::encrypt($slice->brains ) }}" id="idresp" name="idresp" type="hidden">
                                    <button type="submit" class="btn btn-danger btn-sm btn-block mt-1" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror217')}}" data-html="true">{{ trans('lang.eliminar')}}</button>
                                </form>
                            </div>
                            <div class="col px-1"> 
                                <button type="button" data-text="{{$slice->brainstext}}" data-idcom="{{Crypt::encrypt($comment->idbraincom)}}" data-idresp="{{ Crypt::encrypt($slice->brains ) }}" class="btn btn-success btn-sm btn-block mt-1 editresp" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror218')}}" data-html="true">{{ trans('lang.editar')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
        

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

<input type="hidden" id="status" name="status">

@endsection



@section('extra-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script type="text/javascript">

    

    $(document).ready(function() {

        $(function () {

        $('[data-toggle="tooltip"]').tooltip()

        });

        $('#summernote').summernote({
        placeholder: '{{ trans('multi-leng.formerror208')}}',
        tabsize: 2,
        fontNames: ['Arial', 'Arial Black', 'Calibri', 'Comic Sans MS', 'Courier New', 'Elephant', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman'],
        fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Calibri', 'Comic Sans MS', 'Courier New', 'Elephant', 'Impact', 'Tahoma', 'Times New Roman'],
        height: 400,
        toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['operation', ['undo', 'redo']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
        ]
        });
        
    });

    $("#formaddsub").submit(function(e){

        $("#summernoteHelp").css("display", "none");
        console.log($("#summernote").val().length);
        var error = "";


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
    
    $(".editrespcomment").click(function(e){

        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror135')}}");

        $( "#modalbodyforo" ).html(`<form class="editarmodal" id="editarmodal" method="POST" action="{{ url('') }}/editar-idea-usuario-registrado" enctype="multipart/form-data">
            @csrf
            <input value="${$(this).data('id')}" id="idcom" name="idcom" type="hidden">
            <div class="form-group">
                <label for="nametopic"><b>{{ __('multi-leng.formerror29') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror142') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="250" size="100" placeholder="{{ __('multi-leng.formerror29') }}" value="${$(this).data('title')}" required> 
                <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
            </div>
             <div class="form-group">
                <label for="summernotedos"><b>{{ trans('multi-leng.formerror204')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                <textarea class="form-control" id="summernotedos" name="summernotedos" aria-describedby="summernotedosHelp">${$(this).data('text')}</textarea>
                <small id="summernotedosHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.editar')}}</button>
            </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });

    $(".editresp").click(function(e){

        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror135')}}");

        $( "#modalbodyforo" ).html(`<form class="editarmodalresp" id="editarmodalresp" method="POST" action="{{ url('') }}/editar-idea-anexa-usuario-registrado" enctype="multipart/form-data">
            @csrf
            <input value="${$(this).data('idcom')}" id="idcom" name="idcom" type="hidden">
            <input value="${$(this).data('idresp')}" id="idresp" name="idresp" type="hidden">
            <div class="form-group">
                <label for="summernotedos"><b>{{ trans('multi-leng.formerror204')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                <textarea class="form-control" id="summernotedos" name="summernotedos" aria-describedby="summernotedosHelp">${$(this).data('text')}</textarea>
                <small id="summernotedosHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.editar')}}</button>
            </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });
    $("#editarmodal").submit(function(e){

        $("#summernotedosHelp").css("display", "none");
        var error = "";


        if($.trim($("#nametopic").val()).length < 2)

        {

            error += "{{ __('multi-leng.formerror144') }}<br>";
            $("#summernotedosHelp").html("{{ __('multi-leng.formerror144') }}");
            $("#summernotedosHelp").css("display", "block");

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

    $('#staticBackdropforo').on('show.bs.modal', function (event) {
        
        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#summernotedos').summernote({
            dialogsInBody: true,
            placeholder: "{{ trans('multi-leng.formerror204')}}",
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
        $("#editarmodal").submit(function(e){

            $("#nametopicHelp").css("display", "none");
            $("#summernotedosHelp").css("display", "none");
            var error = "";

            if($.trim($("#nametopic").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";
                $("#nametopicHelp").html("{{ __('multi-leng.formerror1') }}");
                $("#nametopicHelp").css("display", "block");

            }

            if($("#summernotedos").val().length == 0)

            {

                error += "{{ __('multi-leng.formerror144') }}<br>";
                $("#summernotedosHelp").html("{{ __('multi-leng.formerror144') }}");
                $("#summernotedosHelp").css("display", "block");

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

        $("#editarmodalresp").submit(function(e){

            
            $("#summernotedosHelp").css("display", "none");
            var error = "";

            if($("#summernotedos").val().length < 5)

            {

                error += "{{ __('multi-leng.formerror144') }}<br>";
            

            }

            if(error != "")

            {
                $("#summernotedosHelp").html("{{ __('multi-leng.formerror144') }}");
                $("#summernotedosHelp").css("display", "block");
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

