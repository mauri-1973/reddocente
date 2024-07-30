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
                    <h3>{{ trans('multi-leng.formerror24')}}</h3>
                    <a href="{{ route('blog-posts-crear-publicacion') }}" class="btn btn-success btn-sm">{{ trans('multi-leng.formerror30')}}</a>
                </div>
                <div class="card-body">
                    <table id="dt-mant-table" class="table table-bordered display responsive nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('multi-leng.formerror29')}}</th>
                            <th>{{ trans('multi-leng.formerror28')}}</th>
                            <th>{{ trans('multi-leng.formerror27')}}</th>
                            <th>{{ trans('multi-leng.admcat')}}</th>
                            <th>{{ trans('multi-leng.formerror26')}}</th>
                            <th>{{ trans('multi-leng.formerror25')}}</th>
                            <th>{{ trans('multi-leng.fechcrecat')}}</th>
                            <th>{{ trans('multi-leng.formerror22')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>&nbsp;Post # {{ $post->id }}</td>
                                <td>&nbsp;{{ $post->title }}</td>
                                <td>&nbsp;{{ (int)$post->read_count }}</td>
                                <td class="text-center"><img src="{{ $post->thumbnail ? asset('storage/blog/imagenes/'.$post->thumbnail) : asset('storage/logos/ust3.png') }}"
                                        style="width: 75px; height: auto;"></td>
                                <td>{{ $post->titlecat }}</td>
                                <td>{{ Str::limit(strip_tags($post->body), 40) }}</td>
                                <td>{{ optional($post)->nameus.' '.optional($post)->surnameus }}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('ver-publicacion-completa', $post->id) }}" class="btn btn-success btn-sm btn-block mb-1">
                                    {{ trans('lang.perver')}}
                                    </a>
                                    <a href="{{ route('blog-posts-editar', Crypt::encrypt($post->id)) }}" class="btn btn-primary btn-sm btn-block mb-1">
                                    {{ trans('lang.editar')}}
                                    </a>
                                    <form id="delete-form-{{ $post->id }}" method="post"
                                        action="{{ route('blog-posts-eliminar')}}" style="display: none">
                                        @csrf
                                        <input type="hidden" id="idpost" name="idpost" value="{{ $post->id }}">
                                    </form>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-block" onclick="
                                        if(confirm('Are you sure, You want to Delete this ??'))
                                        {
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $post->id }}').submit();
                                        }">{{ trans('lang.eliminar')}}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
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
            "order": [[ 2, "desc" ]],
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });
    });
    
</script>
@endsection