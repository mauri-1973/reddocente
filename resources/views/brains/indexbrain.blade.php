@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<style>

    #nocat

    {

       color: red;

    }

    .text-success{
        color: #004238 !important;
    }

    .fa{
        color: #004238 !important;
    }

    .icon-1x {
    font-size: 32px;
    }
    
    .viewus:hover {
      background-color: #20c997 !important;
      transition: 0.7s;
  }


    .table-borderless>thead>tr>th
    .table-borderless>thead>tr>td
    .table-borderless>tbody>tr>th
    .table-borderless>tbody>tr>td
    .table-borderless>tfoot>tr>th
    .table-borderless>tfoot>tr>td {
    border: none;
}

#idTextPanel{
    word-wrap: break-word !important;max-width: 400px !important;
}

</style>

@endsection





@section('index')



<div class="content">
    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0 card">
            <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;">
            </div>
            <div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 50px;">
                <div class="sticky-inner">
                    <button class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold addtopic">{{ trans('multi-leng.formerror203')}}</button>
                    <div class="bg-white mb-3" style="border:1px solid #cccccc;">
                        <small class="px-3 py-2 op-5 m-0 text-success">
                            {{  \Carbon\Carbon::create(date('Y-m-d H:i:s'))->translatedFormat('l j F Y | H:i') }}
                        </small>
                        <hr class="my-0">
                        <div class="row text-center d-flex flex-row op-7 mx-0">
                            <div class="col-sm-12 flex-ew text-center py-3 border-bottom"> 
                                <a class="d-block lead font-weight-bold text-success" href="#">{{ $num }}</a> Ideas
                            </div>
                            <div class="col-sm-12 col flex-ew text-center py-3 border-bottom mx-0"> 
                                <a class="d-block lead font-weight-bold text-success" href="#">{{ $user->name }} {{ $user->surname }}</a> 
                            </div>
                        </div>
                    </div>
                    <div class="bg-white text-sm">
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="col-lg-9">
            
            <div class="col-12 m-0 p- pb-3 table-responsive">
                <table id="dt-mant-table" class="table table-borderless display nowrap p-0 m-0" style="width:100%">
                    <thead class="p-0 m-0">
                        <tr class="p-0 m-0">
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0" style="white-space:nowrap;"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                            <th scope="col" class="p-0 m-0"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($array as $row => $slice) 
                        <tr class="p-0 m-0">
                            <td>
                                {{ $array[$row]['idbraincom'] }}
                            </td>
                            <td class="p-0 m-0">
                                <!-- End of post 1 -->
                                <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                                    <div class="row align-items-center">
                                        <div class="col-12 mb-3">
                                            <h5>
                                                <a href="#" class="text-success pb-5" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror164')}}" data-html="true">{{$array[$row]['titlebrain']}}</a>
                                            </h5>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <p><strong>{{ trans('multi-leng.formerror165')}}:</strong> {{ Str::limit(strip_tags($array[$row]['contenido']), 110) }}</p>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <p class="text-sm">
                                                <span class="op-6">{{ trans('multi-leng.formerror207')}}</span> 
                                                <span class="op-6 text-primary">{{$array[$row]['fecha']}}</span> 
                                                <span class="op-6">{{ trans('multi-leng.formerror151')}}</span> 
                                                <button class="btn btn-link viewus" data-idus="{{ $user->id }}" style="color:#004238 !important;" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror149')}}" data-html="true">{{ $user->name }} {{ $user->surname }}</button>
                                            </p>
                                        </div>
                                        
                                        <div class="col-12 mt-2">
                                            <div class="col-3 px-1 float-left"> 
                                                <a class="btn btn-success btn-sm" href="{{ url('anexar-nueva-idea-usuario-registrado', ['idcomment' => Crypt::encrypt($array[$row]['idbraincom']) ] ) }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror210')}}" data-html="true">{{ trans('multi-leng.formerror70')}}</a>
                                            </div>
                                            <div class="col-3 px-1 float-left"> 
                                                <i class="fa fa-comment fa-2x float-left" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ trans('multi-leng.formerror156')}}" data-html="true"></i>&nbsp;&nbsp;
                                                <span class="d-block text-sm float-left pl-2 pt-2">{{$array[$row]['ideas']}} {{ trans('multi-leng.formerror208')}}</span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </td>
                            <td>
                                {{ $array[$row]['idbraincom'] }}
                            </td>
                            <td>
                                {{ $array[$row]['idbraincom'] }}
                            </td>
                            <td>
                                {{ $array[$row]['idbraincom'] }}
                            </td>
                            <td>
                                {{ $array[$row]['idbraincom'] }}
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
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

        $('#dt-mant-table').DataTable({

            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [2],
                    "visible": false,
                    "searchable": true
                },
                {
                    "targets": [3],
                    "visible": false,
                    "searchable": true
                },
                {
                    "targets": [4],
                    "visible": false,
                    "searchable": true
                },
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": true
                },
            ],

            "dom": 'frtip', 

            "fixedHeader": true,

            "responsive": false,      

            "order": [[ 0, "desc" ]],

            "language": {

                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"

            }

        });

    });
    $(".addtopic").click(function(e){

        $( "#staticBackdropLabelforo" ).html("{{ trans('multi-leng.formerror135')}}");

        $( "#modalbodyforo" ).html(`<form class="formaddsub" id="formaddsub" method="POST" action="{{ url('') }}/agregar-nueva-idea-usuario-registrado" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nametopic"><b>{{ __('multi-leng.formerror29') }}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small>&nbsp;&nbsp;<i style="color:#000;font-size:18px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ __('multi-leng.formerror142') }}" data-html="true"></i></label> 
                <input type="text" class="form-control" id="nametopic" name="nametopic" aria-describedby="nametopicHelp" minlength="2" maxlength="250" size="100" placeholder="{{ __('multi-leng.formerror29') }}" required> 
                <small id="nametopicHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror143') }}</small>
            </div>
            <div class="form-group">
                <label for="summernote"><b>{{ trans('multi-leng.formerror204')}}</b> <small style="color:red">(*{{ __('lang.reqinf') }})</small></label>
                <textarea class="form-control" id="summernote" name="summernote" aria-describedby="summernoteHelp"></textarea>
                <small id="summernoteHelp" class="form-text text-danger" style="display:none;">{{ __('multi-leng.formerror144') }}</small>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('lang.enviar')}}</button>
            </form>`);

        $( "#footerbodyforo" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');

        $( "#staticBackdropforo" ).modal('show');

    });

    $('#staticBackdropforo').on('show.bs.modal', function (event) {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#summernote').summernote({
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

        $("#formaddsub").submit(function(e){

            $("#nametopicHelp").css("display", "none");
            $("#summernoteHelp").css("display", "none");
            console.log($("#summernote").val().length);
            var error = "";
            
            if($.trim($("#nametopic").val()).length < 2)

            {

                error += "{{ __('multi-leng.formerror1') }}<br>";
                $("#nametopicHelp").html("{{ __('multi-leng.formerror1') }}");
                $("#nametopicHelp").css("display", "block");

            }

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



    });

</script>

@endsection

