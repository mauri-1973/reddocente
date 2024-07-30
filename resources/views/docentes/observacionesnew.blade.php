@extends('homeempty')



@section('title')

{{ Auth::user()->name }}

@endsection



@section('extra-css')

<style>

    #nocat

    {

       color: red;

    }
    .textlabel{
        font-size:18px !important;
        color:#fff;
    }
    .form-control
    {
        font-size:16px !important;
    }
    .form-control1
    {
        font-size:16px !important;
    }
    caption{
        color:#fff;
        caption-side: top;
        font-size:16px;
    }

</style>

@endsection



@section('index')

<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row justify-content-center mt-4">
                
                <div class="col-md-12">
                    <div class="card mb-4 bg-success shadow-sm">
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h5>{{ trans('multi-leng.a209')}}: <strong class="statusval">{{ $nombre }}</strong></h5>
                                    </div> 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h5>{{ trans('multi-leng.a208')}}: <strong class="statusval">{{ $conc }}</strong></h5>
                                    </div> 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-white">
                                        <h5>{{ trans('multi-leng.a215a')}}: <strong class="statusval">{{ $fecha }}</strong></h5>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-1">
                        <div class="card mb-4 bg-success shadow-sm">
                            <div class="card-body">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="author text-white mb-5">
                                                <h3>{{ trans('multi-leng.a42')}}</h3>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a215')}}</label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width:70%;">{{ trans('multi-leng.a216')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a217')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable1">
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a218')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp1" name="resp1" id="resp1" value="1" {{ ($correc->resp1 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp1">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp1" name="resp1" id="resp22" value="0" {{ ($correc->resp1 == 0) ? 'checked' : '' }} disabled >
                                                                  <label class="form-check-label" for="resp2">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a220')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp2" name="resp2" id="resp3" value="1" {{ ($correc->resp2 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp3">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp2" name="resp2" id="resp4" value="0" {{ ($correc->resp2 == 0) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp4">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a221')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp3" name="resp3" id="resp5" value="1" {{ ($correc->resp3 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp5">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp3" name="resp3" id="resp6" value="0" {{ ($correc->resp3 == 0) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp6">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a222')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp4" name="resp4" id="resp7" value="1" {{ ($correc->resp4 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp7">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp4" name="resp4" id="resp8" value="0" {{ ($correc->resp4 == 0) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp8">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a223')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp5" name="resp5" id="resp9" value="1" {{ ($correc->resp5 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp9">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp5" name="resp5" id="resp10" value="0" {{ ($correc->resp5 == 0) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp10">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a224')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp6" name="resp6" id="resp11" value="1" {{ ($correc->resp6 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp11">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp6" name="resp6" id="resp12" value="0" {{ ($correc->resp6 == 0) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp12">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a225')}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp7" name="resp7" id="resp13" value="1" {{ ($correc->resp7 == 1) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp13">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp7" name="resp7" id="resp14" value="0" {{ ($correc->resp7 == 0) ? 'checked' : '' }} disabled>
                                                                  <label class="form-check-label" for="resp14">
                                                                    No
                                                                  </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <label for="preg0" class="textlabel">{{ trans('multi-leng.a226')}}</label>
                                                <table class="table table-bordered table-sm" style="background-color:#fff;" id="tabla2">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width:70%;">{{ trans('multi-leng.a227')}}</th>
                                                            <th scope="col">{{ trans('multi-leng.a228')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodytable2">
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a229')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje1" name="ptje1" data-col="ptje1" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje1 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a230')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje2" name="ptje2"  data-col="ptje2" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje2 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a231')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje3" name="ptje3"  data-col="ptje3" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje3 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a232')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje4" name="ptje4"  data-col="ptje4" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje4 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a233')}}<p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="text" id="ptje5" name="ptje5"  data-col="ptje5" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje5 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a234')}} <p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="text" id="ptje6" name="ptje6"  data-col="ptje6" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje6 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a235')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje7" name="ptje7"  data-col="ptje7" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje7 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a236')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje8" name="ptje8"  data-col="ptje8" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje8 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a237')}} <p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="text" id="ptje9" name="ptje9"  data-col="ptje9" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje9 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a238')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje10" name="ptje10"  data-col="ptje10" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje10 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a239')}} <p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="text" id="ptje11" name="ptje11"  data-col="ptje11" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje11 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            {{ trans('multi-leng.a240')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="text" id="ptje12" name="ptje12"  data-col="ptje12" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje12 }}" onkeypress="return valideKeycel(event);" disabled/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ trans('multi-leng.a241')}} </th>
                                                            <th scope="col">
                                                                <div class="form-control">
                                                                    <input type="text" class="form-control" id="ptjetotal" name="ptjetotal" value="{{ $correc->ptje1 + $correc->ptje2 + $correc->ptje3 + $correc->ptje4 + $correc->ptje5 + $correc->ptje6 + $correc->ptje7 + $correc->ptje8 + $correc->ptje9 + $correc->ptje10 + $correc->ptje11 + $correc->ptje12}}" readonly>
                                                                </div> 
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr style="border-top: 3px solid #fff;">
                                            <div class="form-group mb-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <label for="statuscorrec" class="textlabel">&nbsp;</label>
                                                              <button id="finalizarpost" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.a256')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                          
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
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

<input type="hidden" id="idansw" name="idansw" value="{{ $id }}">
<input type="hidden" id="idcorrec" name="idcorrec" value="{{ Crypt::encrypt($correc->idcorrec) }}">

@endsection



@section('extra-script')

<script type="text/javascript">

    

    $(document).ready(function() {

        $(function () {

            $('[data-toggle="tooltip"]').tooltip()

        });

        $('#tabla1').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            ordering: false,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });

        $('#tabla2').DataTable({
            //"dom": 'lfrtip'
            "dom": '', 
            fixedHeader: true,
            responsive: true,      
            ordering: false,
            pageLength: 13,
            "language": {
                "url": "{{asset('json')}}/{{ trans('multi-leng.idioma')}}.json"
            }
        });

    });
    $(document).on('click', '#finalizarpost', function() { 
      
      window.close();
   });

</script>

@endsection

