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

                <a class="btn btn-success" href="{{url('acceder-forum-usuarios-activos', ['idcat' => Crypt::encrypt($idcat) ])}}" role="button">{{ trans('lang.volver')}}</a>

                </div>

            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                
                <div class="row align-items-center">
                    <div class="col-12 mb-3">
                        <h5 data-toggle="tooltip" data-placement="top" title="Título de la publicación" data-html="true">
                            {{$comment->title}}
                        </h5>
                    </div>
                    <div class="col-12 mb-3">
                        {!! $comment->comments !!}
                    </div>
                    <div class="col-md-8 mb-3 mb-sm-0">
                        <p class="text-sm">
                            <span class="op-6">{{ trans('multi-leng.formerror150')}}</span> 
                            <span class="op-6 text-primary">{{$comment->created_at->diffForHumans()}}</span> 
                            <span class="op-6">{{ trans('multi-leng.formerror151')}}</span> 
                            <button class="btn btn-link viewus" data-idus="{{ Crypt::encrypt($part->idus) }}" style="color:#004238 !important;" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror149')}}" data-html="true">{{$part->nameus}} {{$part->surname}}</button>
                        </p>
                        <div class="text-sm op-5">
                           
                        </div>
                    </div>
                    <div class="col-md-4 op-7">
                        <div class="row text-center op-7">
                            <div class="col px-1"> 
                                <i class="fa fa-star fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror155')}}" data-html="true"></i>
                                <span class="d-block text-sm">{{$comment->votos}} {{ trans('multi-leng.formerror153')}}</span> 
                            </div>
                            <div class="col px-1"> 
                                <i class="fa fa-comment fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror156')}}" data-html="true"></i>
                                <span class="d-block text-sm">{{$comment->respuestas}} {{ trans('multi-leng.formerror154')}}</span> 
                            </div>
                            <div class="col px-1"> 
                                <i class="fa fa-eye fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror157')}}" data-html="true"></i>
                                <span class="d-block text-sm">{{$comment->visitas}} {{ trans('multi-leng.formerror28')}}</span>  

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="">

                    <h3>{{ trans('multi-leng.formerror158')}}</h3>

                </div>

                <div class="card-body">

                    <form class="formaddsub" id="formaddsub" action="{{ url('') }}/enviar-respuesta-usuario-tema" enctype="multipart/form-data" method="post">
                        @csrf
                        <input value="{{Crypt::encrypt($comment->idforcom)}}" id="idforcom" name="idforcom" type="hidden">
                        <div class="form-group">
                            <label for="summernote"><b>{{ trans('multi-leng.formerror137')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                            <textarea class="form-control" id="summernote" name="summernote" aria-describedby="summernoteHelp"></textarea>
                            <small id="summernoteHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group" style="display:{{$display}}">
                                    <label for="tag5"><b>{{ trans('multi-leng.formerror161')}}</b></label> 
                                    <div id="rating" ></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group float-right">
                                    <label for="tag5"><b>{{ trans('multi-leng.formerror160')}}</b></label> 
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
                        {{ trans('multi-leng.formerror152')}} {{$row + 1}}
                    </div>
                    <div class="col-12 mb-3">
                        {!! $resp[$row]['respuesta'] !!}
                    </div>
                    <div class="col-md-6 mb-3 mb-sm-0">
                        <p class="text-sm">
                            <span class="op-6">{{ trans('multi-leng.formerror150')}}</span> 
                            <span class="op-6 text-primary">{{$resp[$row]['fecha'] }}</span> 
                            <span class="op-6">{{ trans('multi-leng.formerror151')}}</span> 
                            <button class="btn btn-link viewus" data-idus="{{ Crypt::encrypt($resp[$row]['idus']) }}" style="color:#004238 !important;" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror149')}}" data-html="true">{{$resp[$row]['name']}}</button>
                        </p>
                        <div class="text-sm op-5">
                            
                        </div>
                    </div>
                    <div class="col-md-6 op-7">
                        <div class="row text-center op-7">
                            <div class="col-2 px-1"> 
                                <i class="fa fa-star fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror147')}}" data-html="true"></i>
                                <span class="d-block text-sm votos{{$resp[$row]['idresp'] }}">{{$resp[$row]['votos']}} {{ trans('multi-leng.formerror153')}}</span> 
                            </div>
                            @role('docente')
                            <div class="col-5 px-1">
                                <form class="forma" id="forma" action="{{ url('') }}/eliminar-respuesta-usuario" enctype="multipart/form-data" method="post">
                                @csrf
                                    <input value="{{Crypt::encrypt($comment->idforcom)}}" id="idforcom" name="idforcom" type="hidden">
                                    <input value="{{ Crypt::encrypt($resp[$row]['idresp']) }}" id="idresp" name="idresp" type="hidden">
                                    <input value="{{ $idcat }}" id="idcat" name="idcat" type="hidden">
                                    <div><i class="fa fa-trash fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror162')}}" data-html="true" style="color:red !important;"></i></div>
                                    <button type="submit" class="btn btn-danger btn-sm btn-block mt-1" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror162')}}" data-html="true">{{ trans('lang.eliminar')}}</button>
                                </form>
                            </div>
                            @endrole
                            <div class="col-5 px-1"> 
                                <form class="forma" id="forma" action="{{ url('') }}/guardar-votacion-respuesta-usuario" enctype="multipart/form-data" method="post" style="display:{{ $resp[$row]['display'] }}">
                                @csrf
                                    <input value="{{Crypt::encrypt($comment->idforcom)}}" id="idforcom" name="idforcom" type="hidden">
                                    <input value="{{ Crypt::encrypt($resp[$row]['idresp']) }}" id="idresp" name="idresp" type="hidden">
                                    <input value="{{ $idcat }}" id="idcat" name="idcat" type="hidden">
                                    
                                    <div id="ratingdos{{$resp[$row]['idresp'] }}"></div>
                                    <button type="submit" class="btn btn-success btn-sm btn-block">{{ trans('multi-leng.formerror148')}}</button>
                                </form> 
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
        placeholder: '{{ trans('multi-leng.formerror159')}}',
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
        var idresp = @json($idresp);
        idresp.forEach(createstar);
        rating.create({
        'selector': '#rating',
        'outOf': 10,
        });
    });
    function createstar(item) {
            rating.create({
            'selector': '#ratingdos'+item,
            'outOf': 10,
            });
        }
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
    var rating = {};

    //Set the default icons
    rating.selectedIcon = 'https://santotomas.desarrollosdigitales.cl/imagenes/selectedStar.svg';
    rating.unselectedIcon = 'https://santotomas.desarrollosdigitales.cl/imagenes/unselectedStar.svg';
    rating.defaultRating = 0;
    rating.outOf = 5;
    rating.name = 'ratingdos';

    var ratingdos = {};

    //Set the default icons
    ratingdos.selectedIcon = 'https://santotomas.desarrollosdigitales.cl/imagenes/selectedStar.svg';
    ratingdos.unselectedIcon = 'https://santotomas.desarrollosdigitales.cl/imagenes/unselectedStar.svg';
    ratingdos.defaultRating = 0;
    ratingdos.outOf = 5;
    ratingdos.name = 'ratingdos';

    rating.create = function(settings)
    {
        //Set the icons if they have been set
        this.selectedIcon = settings.selectedIcon || this.selectedIcon;
        this.unselectedIcon = settings.unselectedIcon || this.unselectedIcon;

        //Set both the outOf and defaultRatings
        this.defaultRating = settings.defaultRating || this.defaultRating;
        this.outOf = settings.outOf || rating.outOf;

        //Set the default name
        this.name = settings.name || rating.name;

        //Set the classes
        var ratingClass = settings.ratingClass || {};

        //Check whether the user is using font awesome
        var usingFa = false;
        var startingHtml = '<img src="';
        var subSelector = 'img';
        if(this.selectedIcon.substring(0, 3) == 'fa ' || this.unselectedIcon.substring(0, 3) == 'fa ') 
        {
            usingFa = true;
            subSelector = 'i';
            startingHtml = '<i class="';
        }


        var html = '<input type="hidden" name="'+this.name+'" value="'+this.defaultRating+'">';
        //Create the ratings HTML
        for(var i = 0; i < this.defaultRating; i++) 
        {
            html = html + startingHtml+this.selectedIcon+'" data-position="'+(i+1)+'"';
            for(var x = 0; x < ratingClass.length; x++) {
                if(x === 0) {
                    html = html + ' class="';
                }
                html = html + ratingClass[x];
                if(x+1 == ratingClass.length) {
                    html = html + '"';
                } else {
                    html = html + ' ';
                }
            }
            html = html + '>';
            if(usingFa) {
                html = html + '</i>';
            }
        }
        for(var i = 0; i < this.outOf - this.defaultRating; i++) 
        {
            html = html + startingHtml+this.unselectedIcon+'" data-position="'+(this.defaultRating+i+1)+'">';
            if(usingFa) {
                html = html + '</i>';
            }
        }
        $(settings.selector).html(html);
        $(settings.selector + ' ' + subSelector).on('mouseover', function() {
            var position = $(this).data('position');
            $(settings.selector + ' ' + subSelector).each(function(i, e) {
                if(i < position) {
                    $(e).attr('src', rating.selectedIcon);
                } else {
                    $(e).attr('src', rating.unselectedIcon);
                }
            });
        });

        $(settings.selector + ' ' + subSelector).on('mouseout', function() {
            var selected = $(this).siblings('input[name='+rating.name+']').val();
            $(settings.selector + ' ' + subSelector).each(function(i, e) {
                if(i < selected) {
                    $(e).attr('src', rating.selectedIcon);
                } else {
                    $(e).attr('src', rating.unselectedIcon);
                }
            });
        });

        $(settings.selector + ' ' + subSelector).on('click', function() {
            $(this).siblings('input[name='+rating.name+']').val($(this).data('position'));
        });
    }

</script>

@endsection

