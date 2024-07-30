@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')
<style>
    img.note-float-left
    {
        margin:20px;
    }
    img.note-float-right
    {
        margin:20px;
    }
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
            <div class="card-body m-0 p-0">
                @role('blog')
                    <a href="{{ route('ver-publicaciones-blog') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
                @role('user')
                    <a href="{{ url('/home') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 mb-3">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="author text-white">
                                            <h2>{{ $post->title }}</h2>
                                            <div class="text-white-50">
                                            {{ trans('multi-leng.formerror25')}}: <a href="#">{{ $post->nameus }} {{ $post->surnameus }}</a>
                                                {{ $post->created_at->format('m/d/Y h:m a') }}. {{ trans('multi-leng.formerror50')}}:
                                                <a href="#">
                                                    {{ $post->titlecat }}
                                                </a>
                                                @if($tags->count() > 0)
                                                    tags: @foreach($tags as $tag)
                                                        <a href="#" class="me-1">
                                                            #{{ $tag->title }}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                                        <img src="{{ $post->thumbnail ? asset('storage/blog/imagenes/'.$post->thumbnail) : asset('storage/logos/ust3.png') }}" style="width: 25%; height: auto; background-color:#fff;">
                                    </div>
                                </div>
                            </div>
                            
                            <hr style="border-top: 3px solid #fff;">
                            
                            <div class="post-body text-white">
                                {!! $post->body !!}
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-t-2 border-gray-600">
                            <h4 class="text-white">{{ trans('multi-leng.formerror48')}}</h4>
                            <div class="">
                                @auth
                                    <form id="formcomment" action="{{ route('ingresar-comentarios-usuarios-registrados')}}" method="post">
                                        @csrf
                                        <input type="hidden" id="idpost" name="idpost" value="{{ $post->id }}">
                                        <div class="mb-3">
                                            <label for="comment">{{ trans('multi-leng.formerror49')}}</label>
                                            <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" cols="30" rows="3" placeholder="{{ trans('multi-leng.formerror49')}}">{{ old('comment') }}</textarea>
                                            @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                            <strong class="text-white">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">{{ __('lang.enviar') }}</button>
                                        </div>
                                    </form>
                                @else
                                    <p class="text-white-50">Need to <a href="{{ url('/login') }}">login</a> for comment!</p>
                                @endauth
                            </div>
                            <ul>
                                @forelse ($comments as $comment)
                                    <li id="comment-1" class="rounded-lg bg-gray-200 bg-gray-700 p-0 my-4 relative group text-white">
                                        <div>
                                            <a href="#">
                                                <small class="opacity-75">@</small>{{ $comment->nameus }} {{ $comment->surnameus }}: <span class="float-end">{{ $comment->created_at->diffForHumans() }}</span>
                                            </a>
                                        </div>
                                        <p class="ms-2 mt-2 ps-2 border-l-2 border-gray-300 border-gray-600">
                                            {{ $comment->body }}
                                        </p>
                                        @role('blog')
                                            <form id="formcommentdelete" action="{{ route('eliminar-comentarios-usuarios-registrados')}}" method="post" class="formcommentdelete" onclick='return confirm("{{ trans("multi-leng.areyousur")}}")'>
                                                @csrf
                                                <input type="hidden" id="idcom" name="idcom" value="{{ $comment->id }}">
                                                <input type="hidden" id="idpost" name="idpost" value="{{ $post->id }}">
                                                
                                                <div class="mb-3">
                                                    <button class="btn btn-danger btn-sm" type="submit">{{ __('lang.eliminar') }}</button>
                                                </div>
                                            </form>
                                        @endrole
                                    </li>
                                @empty
                                    <li id="comment-1" class="rounded-lg bg-gray-200 bg-gray-700 p-0 my-4 relative group text-white">
                                        <div>
                                            {{ trans('multi-leng.formerror46')}}
                                        </div>
                                        <p class="ms-2 mt-2 ps-2 border-l-2 border-gray-300 border-gray-600">
                                            {{ trans('multi-leng.formerror47')}}
                                        </p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body m-0 p-0">
                @role('blog')
                    <a href="{{ route('ver-publicaciones-blog') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
                @role('user')
                    <a href="{{ url('/home') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
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
    });

    $( "#formcomment" ).submit(function( event ) 
    {
        console.log($.trim($("comment").val()).length);
         var error = "";
        if($.trim($("#comment").val()).length >= 0 && $.trim($("#comment").val()).length < 10)
        {
            error += "{{ trans('multi-leng.formerror51')}}<br>";
        }
        if(error != "")
        {
                $.notify({
                    // options
                    title: '<h5><strong>{{ trans("multi-leng.formerror46")}} </strong></h5>',
                    message: '{{ trans("multi-leng.formerror52")}}<br>'+
                                error+
                                '<br><br><br>',
                    icon: 'fa fa-exclamation-circle'
                },{
                    // settings
                    element: 'body',
                    //position: null,
                    type: "success",
                    //allow_dismiss: true,
                    //newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top",
                        align: "center"
                    },
                    offset: 20,
                    spacing: 20,
                    z_index: 1031,
                    delay: 3300,
                    timer: 2000,
                    mouse_over: null,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutRight'
                    },
                    onShow: null,
                    onShown: null,
                    onClose: null,
                    onClosed: null,
                    icon_type: 'class',
                });
            return false;
        }
        else
        {
            return true;
        }
    });
    
    
</script>
@endsection
