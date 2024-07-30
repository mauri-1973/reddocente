<div class="sidebar" data-color="white" data-active-color="danger">

    <div class="logo bg-success">

        <a href="#" class="simple-text logo-mini">

            <div class="logo-image-small">

                <img src="{{url('storage/profile-pic')}}/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}"/>

            </div>

        </a>

        <a href="#" class="simple-text logo-normal">

            {{ Auth::user()->name }}<br>&nbsp;<br>

        </a>

    </div>

    <div class="sidebar-wrapper">

        <ul class="nav">

            <li {{Route::is('home')? 'class=active':''}}>

                <a href="{{route('home')}}">

                    <i class="nc-icon nc-bank"></i>

                    <p>{{ trans('multi-leng.ininav')}}</p>

                </a>

            </li>

            @role('revisor')

            <li {{Route::is('buscar-concursos-registrados-revisor') || Route::is('ver-postulantes-registrados-revisor') || Route::is('ver-vista-concurso-usuarios-registrados') || Route::is('ver-postulaciones-concursos-registrados') || Route::is('ver-informacion-ingresada-docente') ? 'class=active':''}}>
            
                <a data-toggle="collapse" href="#users" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-bullet-list-67"></i>

                    <p>{{ trans('multi-leng.a1')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="users" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('buscar-concursos-registrados-revisor') || Route::is('ver-vista-concurso-usuarios-registrados') || Route::is('ver-postulaciones-concursos-registrados') || Route::is('ver-informacion-ingresada-docente') ? 'class=active':''}}>

                            <a href="{{url('buscar-concursos-registrados-revisor')}}"> 

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.a2') }}</p>

                            </a>

                        </li>

                        <!--<li {{Route::is('ver-postulantes-registrados-revisor') ? 'class=active':''}}>

                            <a href="{{url('ver-postulantes-registrados-revisor')}}">

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.a3') }}</p>

                            </a>

                        </li>-->

                    </ul>

                </div>

            </li>

            @endrole

            <li {{Route::is('profile.index')? 'class=active':''}}>

                <a href="{{ route('profile.index') }}">

                    <i class="nc-icon nc-circle-10"></i>

                    <p>{{ trans('multi-leng.admprof')}}</p>

                </a>

            </li>

            <li {{Route::is('change-password')? 'class=active':''}}>

                <a href="{{ route('change-password') }}">

                    <i class="nc-icon nc-key-25"></i>

                    <p>{{ __('lang.respassc') }}</p>

                </a>

            </li>



        </ul>

    </div>

</div>

