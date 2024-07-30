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
                @role('revisor')
                    <a href="{{ route('ver-publicaciones-blog') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
                @role('admin')
                    <a href="{{ route('buscar-concursos-registrados-administradores') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 mb-3">
                    <div class="">
                        <h3>{{ trans('multi-leng.a2')}} (
                            @if($post->is_published == 2)
                            on-line
                            @endif
                            @if($post->is_published == 1)
                            {{ trans('multi-leng.a40')}}
                            @endif
                            @if($post->is_published == 0)
                            off-line
                            @endif
                            )
                        </h3>
                    </div>
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
                                                            #{{ $tag->tagnom }}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                                        <img src="{{ $post->thumbnail ? asset('storage/adjuntos/'.$post->thumbnail) : asset('storage/logos/ust3.png') }}" style="width: 25%; height: auto; background-color:#fff;">
                                    </div>
                                </div>
                            </div>
                            
                            <hr style="border-top: 3px solid #fff;">
                            
                            <div class="post-body text-white">
                                {!! $post->body !!}
                            </div>
                            <hr style="border-top: 3px solid #fff;">

                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="author text-white">
                                            <h3>{{ trans('multi-leng.a15')}}</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="author text-white">
                                            <h5>{{ trans('multi-leng.a16')}}:</h5>
                                            <div class="alert alert-light text-success text-center" role="alert">
                                                <h6 style="font-size:18px;">
                                                    @if($post->date_on == "")
                                                       -----------
                                                    @else
                                                        {{ date("d-m-Y", strtotime($post->date_on)) }}
                                                    @endif
                                                    
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="author text-white">
                                            <h5>{{ trans('multi-leng.a17')}}:</h5>
                                            <div class="alert alert-light text-success text-center" role="alert">
                                                <h6 style="font-size:18px;">
                                                    @if($post->date_off == "")
                                                       -----------
                                                    @else
                                                        {{ date("d-m-Y", strtotime($post->date_off)) }}
                                                    @endif
                                                    
                                                </h6>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($files->count() > 0)
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="author text-white">
                                        <h3>{{ trans('multi-leng.a23')}}</h3>
                                        </div>
                                    </div>
                                    @foreach($files as $tag)
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <a class='btn btn-light btn-sm btn-block text-success mb-1' href='{{url('/')}}/storage/adjuntos/files/{{ $tag->filename }}' role='button' download='{{ $tag->filename }}' style="background-color:#fff !important;">{{ $tag->descripcion }}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-t-2 border-gray-600">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body m-0 p-0">
                @role('revisor')
                    <a href="{{ route('ver-publicaciones-blog') }}" class="btn btn-success btn-sm">
                        {{ trans('lang.volver')}}
                    </a>
                @endrole
                @role('admin')
                    <a href="{{ route('buscar-concursos-registrados-administradores') }}" class="btn btn-success btn-sm">
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
    
    
</script>
@endsection
