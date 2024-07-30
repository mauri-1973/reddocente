@extends('home')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')

<style>
    .embed-container 
    { 
        position: relative; 
        padding-bottom: 100%; 
        height: 0; overflow: hidden; 
        max-width: 100%; min-height: 100%; 
    } 
    .embed-container iframe, 
    .embed-container object, 
    .embed-container embed 
    { 
        position: absolute; 
        top: 0; left: 0; 
        width: 100%; 
        height: 100%; 
    }

</style>

@endsection



@section('index')

<div class="content">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="">
                    
                    <h3>{{ trans('multi-leng.formerror264')}} {{ $desde }}</h3>
                
                </div>

                <div class="card-body">

                    <div class='embed-container'>

                        <iframe src='{{ $url }}' style='border:0;'></iframe>

                    </div>

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

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

    });

</script>

@endsection

