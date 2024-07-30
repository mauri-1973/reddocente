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
                <div class="alert alert-success bg-success" {{ trans('multi-leng.a177') }}  role="alert" id="alert">
                    <h4 class="alert-heading">{{ trans('multi-leng.formerror46')}}:</h4>
                    <p style="font-size:16px;">{{ trans('multi-leng.a177')}}</p>
                    <hr>
                    <p style="font-size:16px;" class="mb-0">{{ trans('multi-leng.a178')}}</p>
                </div>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp1" name="resp1" id="resp1" value="1" {{ ($correc->resp1 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp1">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp1" name="resp1" id="resp22" value="0" {{ ($correc->resp1 == 0) ? 'checked' : '' }}>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp2" name="resp2" id="resp3" value="1" {{ ($correc->resp2 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp3">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp2" name="resp2" id="resp4" value="0" {{ ($correc->resp2 == 0) ? 'checked' : '' }}>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp3" name="resp3" id="resp5" value="1" {{ ($correc->resp3 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp5">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp3" name="resp3" id="resp6" value="0" {{ ($correc->resp3 == 0) ? 'checked' : '' }}>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp4" name="resp4" id="resp7" value="1" {{ ($correc->resp4 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp7">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp4" name="resp4" id="resp8" value="0" {{ ($correc->resp4 == 0) ? 'checked' : '' }}>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp5" name="resp5" id="resp9" value="1" {{ ($correc->resp5 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp9">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp5" name="resp5" id="resp10" value="0" {{ ($correc->resp5 == 0) ? 'checked' : '' }}>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp6" name="resp6" id="resp11" value="1" {{ ($correc->resp6 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp11">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp6" name="resp6" id="resp12" value="0" {{ ($correc->resp6 == 0) ? 'checked' : '' }}>
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
                                                                  <input class="form-check-input" type="radio" data-col="resp7" name="resp7" id="resp13" value="1" {{ ($correc->resp7 == 1) ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="resp13">
                                                                  {{ trans('multi-leng.a219')}}
                                                                  </label>
                                                                </div>
                                                                <div class="form-check pl-5">
                                                                  <input class="form-check-input" type="radio" data-col="resp7" name="resp7" id="resp14" value="0" {{ ($correc->resp7 == 0) ? 'checked' : '' }}>
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
                                                                1.- {{ trans('multi-leng.a229')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs1text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje1obs" id="obs1text" name="obs1text">{{ $correc->ptje1obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje1" name="ptje1" data-col="ptje1" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje1 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                2.- {{ trans('multi-leng.a230')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs2text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje2obs" id="obs2text" name="obs2text" data-col="ptje2obs" >{{ $correc->ptje2obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje2" name="ptje2"  data-col="ptje2" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje2 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                3.- {{ trans('multi-leng.a231')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs3text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje3obs" id="obs3text" name="obs3text">{{ $correc->ptje3obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje3" name="ptje3"  data-col="ptje3" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje3 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                4.- {{ trans('multi-leng.a232')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs4text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje4obs" id="obs4text" name="obs4text">{{ $correc->ptje4obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje4" name="ptje4"  data-col="ptje4" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje4 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                5.- {{ trans('multi-leng.a233')}}<p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs5text"><b>{{ trans('multi-leng.a262')}}5{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje5obs" id="obs5text" name="obs5text">{{ $correc->ptje5obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="number" id="ptje5" name="ptje5"  data-col="ptje5" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje5 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                6.- {{ trans('multi-leng.a234')}} <p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs6text"><b>{{ trans('multi-leng.a262')}}5{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje6obs" id="obs6text" name="obs6text">{{ $correc->ptje6obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="number" id="ptje6" name="ptje6"  data-col="ptje6" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje6 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                7.- {{ trans('multi-leng.a235')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs7text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje7obs" id="obs7text" name="obs7text">{{ $correc->ptje7obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje7" name="ptje7"  data-col="ptje7" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje7 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                8.- {{ trans('multi-leng.a236')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs8text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje8obs" id="obs8text" name="obs8text">{{ $correc->ptje8obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje8" name="ptje8"  data-col="ptje8" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje8 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                9.- {{ trans('multi-leng.a237')}} <p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs9text"><b>{{ trans('multi-leng.a262')}}5{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje9obs" id="obs9text" name="obs9text">{{ $correc->ptje9obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="number" id="ptje9" name="ptje9"  data-col="ptje9" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje9 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                10.- {{ trans('multi-leng.a238')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs10text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje10obs" id="obs10text" name="obs10text">{{ $correc->ptje10obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje10" name="ptje10"  data-col="ptje10" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje10 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                11.- {{ trans('multi-leng.a239')}} <p><small style="color:red;">{{ trans('multi-leng.a213')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs11text"><b>{{ trans('multi-leng.a262')}}5{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje11obs" id="obs11text" name="obs11text">{{ $correc->ptje11obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="5" type="number" id="ptje11" name="ptje11"  data-col="ptje11" data-max="5"  class="form-control inputnumber" value="{{ $correc->ptje11 }}" onkeypress="return valideKeycel(event);"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                12.- {{ trans('multi-leng.a240')}} <p><small style="color:red;">{{ trans('multi-leng.a214')}}</small></p>
                                                                <div class="form-group flex-grow-1 d-flex flex-column">
                                                                    <label for="obs12text"><b>{{ trans('multi-leng.a262')}}10{{ trans('multi-leng.a263')}}</b></label>
                                                                    <textarea class="form-control flex-grow-1 inputtextarea" data-col="ptje12obs" id="obs12text" name="obs12text">{{ $correc->ptje12obs }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-control">
                                                                    <input min="0" max="10" type="number" id="ptje12" name="ptje12"  data-col="ptje12" data-max="10"  class="form-control inputnumber" value="{{ $correc->ptje12 }}" onkeypress="return valideKeycel(event);"/>
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
                                                          <div class="form-group">
                                                              <label for="statuscorrec" class="textlabel">{{ trans('multi-leng.a242')}}</label>
                                                              <select class="form-control" id="statuscorrec" name="statuscorrec">
                                                                <option value='' selected>{{ trans('multi-leng.a243')}}</option>
                                                                <option value="rechazado">{{ trans('multi-leng.a244')}}</option>
                                                                <option value="conobservaciones">{{ trans('multi-leng.a245')}}</option>
                                                                <option value="aprobado">{{ trans('multi-leng.a246')}}</option>
                                                              </select>
                                                          </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                          <div class="form-group">
                                                              <label for="statuscorrec" class="textlabel">&nbsp;</label>
                                                              <button id="finalizarpost" class="btn btn-warning btn-sm btn-block">{{ trans('multi-leng.a247')}}&nbsp;<i class="nc-icon nc-tap-01" style="font-size:15px;"></i></button>
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
        function ocultar() {
            $('#alert').css('display', 'none');
        }
        setTimeout(ocultar, 13000);

        $('#alert').focus();

    });

    function valideKeycel(evt)
    {
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) 
        {
            return true;
        }
        else if(code>=48 && code<=57) 
        { 
            return true;
        } 
        else
        {
            return false;
        }
    }
    $('.form-check-input').change(function () {
        var col = $(this).attr("data-col");
        var val = $(this).val();
        actualizardatos(val, col, 0);
    });
    $(document).on('keyup mouseup', '.inputnumber', function() { 
      
      var col = $(this).attr("data-col");
      var val = $(this).val();
      var max = $(this).attr("data-max");
      if(parseInt(val) > parseInt(max))
      {
        $(this).val(max);
      }
      if(parseInt(val) < 0)
      {
        $(this).val(0);
      }
      if (val == "") 
      {
        $(this).val(0);
      }
      actualizardatos(parseInt(val), col, 1);
      
    });
    $(document).on('keyup', '.inputtextarea', function() { 
      
      var col = $(this).attr("data-col");
      var val = $(this).val();
      actualizardatos(val, col, 1);
      
    });

    $(document).on('click', '#finalizarpost', function() { 
      
      let error = "";

      let sum1, sum2, total1 = 0;
      
      sum1 = parseInt($("input[name='resp1']:checked").val()) + parseInt($("input[name='resp2']:checked").val()) + parseInt($("input[name='resp3']:checked").val()) + parseInt($("input[name='resp4']:checked").val()) + parseInt($("input[name='resp5']:checked").val()) + parseInt($("input[name='resp6']:checked").val()) + parseInt($("input[name='resp5']:checked").val()) + parseInt($('[name=ptjetotal]').val());

      if( $('[name=statuscorrec]').val() == "" )
      {
        error += "Ingrese el estado en que quedará este formulario<br>";
      }
      if(sum1 < 30 && ($('[name=statuscorrec]').val() == "conobservaciones" || $('[name=statuscorrec]').val() == "aprobado") )
      {
        error += "El puntaje mínimo para que este formulario sea aprobado ó pasar a proceso de corrección por parte de {{ $nombre }} es de 30 puntos<br>";
      }
      if(sum1 < 85 && $('[name=statuscorrec]').val() == "aprobado" )
      {
        error += "El puntaje mínimo para que este formulario sea aprobado  es de 85 puntos<br>";
      }
      if($("#ptje1").val() < 10 && $("#obs1text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 1<br>";
      }
      if($("#ptje2").val() < 10 && $("#obs2text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 2<br>";
      }
      if($("#ptje3").val() < 10 && $("#obs3text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 3<br>";
      }
      if($("#ptje4").val() < 10 && $("#obs4text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 4<br>";
      }
      if($("#ptje5").val() < 5 && $("#obs5text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 5<br>";
      }
      if($("#ptje6").val() < 5 && $("#obs6text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 6<br>";
      }
      if($("#ptje7").val() < 10 && $("#obs7text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 7<br>";
      }
      if($("#ptje8").val() < 10 && $("#obs8text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 8<br>";
      }
      if($("#ptje9").val() < 5 && $("#obs9text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 9<br>";
      }
      if($("#ptje10").val() < 10 && $("#obs10text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 10<br>";
      }
      if($("#ptje11").val() < 5 && $("#obs11text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 11<br>";
      }

      if($("#ptje12").val() < 10 && $("#obs12text").val().length < 2 )
      {
        error += "Ingrese la observación para la puntuación del item 12<br>";
      }
      if(error != '')
      {
            $('#staticBackdropLabel').html(`{{ trans('multi-leng.formerror46')}}`); 
            $('#modalbody').html(`<form>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>${error}</b><label>
                                            
                                        </div>
                                        </form>`);
            $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
            $('#staticBackdrop').modal('show');
      }
      else
      {
        $("#finalizarpost").prop("disabed", true);
        actualizardatos($('[name=statuscorrec]').val() , 0, "fin");
      }
      
      
    });

    function actualizardatos(val, col, type)
    {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData();
        formData.append("idansw", $("#idansw").val());
        formData.append("idcorrec", $("#idcorrec").val());
        
        formData.append("value", val);
        formData.append("col", col);
        formData.append("type", type);

        formData.append("obs1text", $("#obs1text").val());
        formData.append("obs2text", $("#obs2text").val());
        formData.append("obs3text", $("#obs3text").val());
        formData.append("obs4text", $("#obs4text").val());
        formData.append("obs5text", $("#obs5text").val());
        formData.append("obs6text", $("#obs6text").val());
        formData.append("obs7text", $("#obs7text").val());
        formData.append("obs8text", $("#obs8text").val());
        formData.append("obs9text", $("#obs9text").val());
        formData.append("obs10text", $("#obs10text").val());
        formData.append("obs11text", $("#obs11text").val());
        formData.append("obs12text", $("#obs12text").val());
        $.ajax({
            type: "POST",
            url: '{{url("/")}}/actualizar-formulario-postulacion-correcciones',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(respu)
            {
              if(type == 1)
              {
                $("#ptjetotal").val(respu.sum);
              }
              if(val == 'rechazado' || val == 'conobservaciones' || val == 'aprobado' || val == 'conobservaciones')
              {
                $("#finalizarpost").prop("disabed", true);
                $('#staticBackdropLabel').html(`{{ trans('multi-leng.formerror46')}}`); 
                $('#modalbody').html(`<form>
                                        <div class="mb-3 form-group">
                                            <label class="form-label"><b>Esta ventana se cerrará automáticamente. El formulario fue corregido correctamente.</b><label>
                                            
                                        </div>
                                        </form>`);
                $( "#footerbody" ).html('<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.cancelar')}}</button>');
                $('#staticBackdrop').modal('show');
                    setTimeout(cerrarwin, 6000);
              }
              
            }
        });
    }
    function cerrarwin() 
    {
        window.close();
    }
    

</script>

@endsection

