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

                    <h3>{{ trans('multi-leng.formerror68')}}</h3>

                </div>

                <div class="card-body">

                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">

                        <thead>

                            <tr>

                                <th>{{ trans('multi-leng.formerror68')}}</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($post as $row => $posts)

                            @if($row % 2 == 0)

                            <tr> 

                                <td style="white-space:normal;" data-order="{{$row}}">

                                    <section>

                                        <div class="container py-3">

                                            <div class="card shadow-sm bg-success rounded-3 h-100">

                                                <div class="row ">

                                                    <div class="col-md-4">

                                                        <img style="background-color:#fff;" src="{{ $posts->thumbnail ? asset('storage/blog/imagenes/'.$posts->thumbnail) : asset('storage/logos/ust3.png') }}" class="w-100">

                                                    </div>

                                                    <div class="col-md-8 px-3">

                                                        <div class="card-block px-3">

                                                            <a href="{{ route('ver-publicacion-completa-usuario', Crypt::encrypt($posts->id)) }}">

                                                                <h3 class="card-text"> {{$posts->title}}</h3>

                                                            </a>

                                                            <p class="text-white">

                                                            {{ trans('multi-leng.formerror25')}} <a href="#" class="text-white">&nbsp;{{ $posts->nameus }} {{ $posts->surnameus }}&nbsp;&nbsp;-</a> 

                                                                <span class="text-white">&nbsp;&nbsp;{{ trans('multi-leng.formerror78')}}: {{ $posts->created_at->format('d-m-Y') }}&nbsp;&nbsp;</span>

                                                                <span class="d-inline float-end text-white">

                                                                <i class="fa fa-comment fa-2x text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror86')}} "></i>

                                                                &nbsp;&nbsp;

                                                                    @foreach($info as $inf => $in)

                                                                        @if($info[$inf]['idpost'] == $posts->id)

                                                                            {{$info[$inf]['nomcom']}}

                                                                        @endif

                                                                    @endforeach

                                                                &nbsp;&nbsp;

                                                                </span>

                                                                <span class="d-inline float-end text-white">

                                                                <i class="fa fa-eye fa-2x text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror87')}} "></i>

                                                                &nbsp;&nbsp;{{ (int)$posts->read_count }}

                                                                </span>

                                                            </p>

                                                            <p class="text-white">

                                                            {{ Str::limit(strip_tags($posts->body), 100) }}

                                                            </p>

                                                            

                                                            <p class="text-white">{{ trans('multi-leng.formerror50')}}:&nbsp;&nbsp;

                                                                <span class="badge badge-primary even-larger-badge p-2 mb-2" style="font-size:14px;">{{ $posts->titlecat }}</span>

                                                            </p>

                                                            <p class="text-white">Tags:&nbsp;&nbsp;

                                                                @foreach($info as $inf => $in)

                                                                    @if($info[$inf]['idpost'] == $posts->id)

                                                                        @foreach($info[$inf]['tags'] as $ta => $intags)

                                                                        <span class="badge badge-primary even-larger-badge p-2 mb-2" style="font-size:14px;">#{{$info[$inf]['tags'][$ta]['titulo']}}</span>

                                                                        @endforeach

                                                                    @endif

                                                                @endforeach

                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="card-footer bg-transparent border-0 mb-3">

                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <div class="btn-group">
                                                            &nbsp;
                                                            <!--<a href="{{ route('ver-publicacion-completa-usuario', Crypt::encrypt($posts->id)) }}" class="btn btn-sm btn-primary text-white">{{ trans('multi-leng.formerror88')}}</a>-->

                                                        </div>

                                                        <small class="text-white">{{ $posts->created_at->diffForHumans() }}</small>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </section>

                                </td>

                            </tr>

                            @else

                            <tr> 

                                <td style="white-space:normal;" data-order="{{$row}}">

                                    <section>

                                        <div class="container py-3">

                                            <div class="card shadow-sm bg-success rounded-3 h-100">

                                                <div class="row ">

                                                    

                                                    <div class="col-md-8 px-3">

                                                        <div class="card-block px-3">

                                                            <a href="{{ route('ver-publicacion-completa-usuario', Crypt::encrypt($posts->id)) }}">

                                                                <h3 class="card-text"> {{$posts->title}}</h3>

                                                            </a>

                                                            <p class="text-white">

                                                            {{ trans('multi-leng.formerror25')}} <a href="#" class="text-white">&nbsp;{{ $posts->nameus }} {{ $posts->surnameus }}&nbsp;&nbsp;-</a> 

                                                                <span class="text-white">&nbsp;&nbsp;{{ trans('multi-leng.formerror78')}}: {{ $posts->created_at->format('d-m-Y') }}&nbsp;&nbsp;</span>

                                                                <span class="d-inline float-end text-white">

                                                                <i class="fa fa-comment fa-2x text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror86')}} "></i>

                                                                &nbsp;&nbsp;

                                                                    @foreach($info as $inf => $in)

                                                                        @if($info[$inf]['idpost'] == $posts->id)

                                                                            {{$info[$inf]['nomcom']}}

                                                                        @endif

                                                                    @endforeach

                                                                &nbsp;&nbsp;

                                                                </span>

                                                                <span class="d-inline float-end text-white">

                                                                <i class="fa fa-eye fa-2x text-white" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror87')}} "></i>

                                                                &nbsp;&nbsp;{{ (int)$posts->read_count }}

                                                                </span>

                                                            </p>

                                                            <p class="text-white">

                                                            {{ Str::limit(strip_tags($posts->body), 100) }}

                                                            </p>

                                                            

                                                            <p class="text-white">{{ trans('multi-leng.formerror50')}}:&nbsp;&nbsp;

                                                                <span class="badge badge-primary even-larger-badge p-2 mb-2" style="font-size:14px;">{{ $posts->titlecat }}</span>

                                                            </p>

                                                            <p class="text-white">Tags:&nbsp;&nbsp;

                                                                @foreach($info as $inf => $in)

                                                                    @if($info[$inf]['idpost'] == $posts->id)

                                                                        @foreach($info[$inf]['tags'] as $ta => $intags)

                                                                        <span class="badge badge-primary even-larger-badge p-2 mb-2" style="font-size:14px;">#{{$info[$inf]['tags'][$ta]['titulo']}}</span>

                                                                        @endforeach

                                                                    @endif

                                                                @endforeach

                                                            </p>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">

                                                        <img style="background-color:#fff;" src="{{ $posts->thumbnail ? asset('storage/blog/imagenes/'.$posts->thumbnail) : asset('storage/logos/ust3.png') }}" class="w-100">

                                                    </div>

                                                </div>

                                                <div class="card-footer bg-transparent border-0 mb-3">

                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <div class="btn-group">

                                                            <small class="text-white">{{ $posts->created_at->diffForHumans() }}</small>

                                                        </div>
                                                        &nbsp;
                                                        <!--<a href="{{ route('ver-publicacion-completa-usuario', Crypt::encrypt($posts->id)) }}" class="btn btn-sm btn-primary text-white">{{ trans('multi-leng.formerror88')}}</a>-->

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </section>

                                </td>

                            </tr>

                            @endif

                            

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

</script>

@endsection

