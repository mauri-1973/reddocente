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

            <li {{Route::is('ver-publicaciones-en-linea')? 'class=active':''}}>

                <a href="{{route('ver-publicaciones-en-linea')}}">

                    <i class="nc-icon nc-bank"></i>

                    <p>{{ trans('multi-leng.ininav')}}</p>

                </a>

            </li>
            <li {{Route::is('buscar-documentos-digitales-administrador') ? 'class=active':''}} style="display:none;">

                <a href="{{url('buscar-documentos-digitales-administrador')}}">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.formerror74')}}</p>

                </a>

            </li>

            @role('docente')

            <li {{Route::is('buscar-documentos-digitales-publicos') || Route::is('actualizar-documentos-digitales-docentes') ? 'class=active':''}} style="display:none;">

                <a data-toggle="collapse" href="#users" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.formerror188')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="users" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <!--<li {{Route::is('permissions.index')||Route::is('permissions.create')||Route::is('permissions.edit')? 'class=active':''}}>

                            <a href="{{route('permissions.index')}}">

                            <i class="nc-icon nc-single-02"></i>

                                <p>{{ trans('multi-leng.admper')}}</p>

                            </a>

                        </li>

                        <li {{Route::is('roles.index')||Route::is('roles.create')||Route::is('roles.edit')? 'class=active':''}}>

                            <a href="{{route('roles.index')}}">

                            <i class="nc-icon nc-single-02"></i>

                                <p>{{ trans('multi-leng.admrol')}}</p>

                            </a>

                        </li>-->

                        <li {{ Route::is('actualizar-documentos-digitales-docentes') ? 'class=active':''}}>

                            <a href="{{url('actualizar-documentos-digitales-docentes')}}"> 

                            <i class="nc-icon nc-minimal-up"></i>

                                <p>{{ __('multi-leng.formerror89') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('buscar-documentos-digitales-publicos') ? 'class=active':''}}>

                            <a href="{{url('buscar-documentos-digitales-publicos')}}">

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.formerror76') }}</p>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>

            <li {{Route::is('categorias-forums-docentes-registrados') || Route::is('listado-usuarios-estado-ingreso-docentes') || Route::is('acceder-forum-usuarios-activos') || Route::is('ver-contenido-tema-forum') ? 'class=active':'' }} style="display:none;">
            
                <a data-toggle="collapse" href="#forums" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-tap-01"></i>

                    <p>{{ trans('multi-leng.formerror75')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="forums" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('categorias-forums-docentes-registrados') || Route::is('listado-usuarios-estado-ingreso-docentes') || Route::is('acceder-forum-usuarios-activos') || Route::is('ver-contenido-tema-forum') ? 'class=active':'' }}>

                            <a href="{{route('categorias-forums-docentes-registrados')}}"> 

                            <i class="nc-icon nc-bullet-list-67"></i>

                                <p>{{ __('multi-leng.admcat') }}</p>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>
            <li {{Route::is('buscar-chats-usuario-registrado') ? 'class=active':''}} style="display:none;">

                <a data-toggle="collapse" href="#chats" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-chat-33"></i>

                    <p>Chats</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="chats" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('buscar-chats-usuario-registrado') ? 'class=active':''}}>

                            <a href="{{url('buscar-chats-usuario-registrado')}}"> 

                            <i class="nc-icon nc-bullet-list-67"></i>

                                <p>{{ __('multi-leng.admcat') }}</p>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>
            
            <li {{Route::is('ir-link-administrador-externo-formacion') || Route::is('ir-link-administrador-externo-extension')  || Route::is('ir-link-administrador-externo-proyectos') || Route::is('ir-link-administrador-externo-recursos') ? 'class=active':''}} style="display:none;">

                <a data-toggle="collapse" href="#link" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-vector"></i>

                    <p>{{ trans('multi-leng.formerror222')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="link" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">
                        @if(session('ver') == "si")
                        <li>

                            <a href="{{ session('url') }}" target="_blank">

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ trans('multi-leng.formerror224')}}</p>

                            </a>

                        </li>
                        @endif
                        <li {{ Route::is('ir-link-administrador-externo-formacion')? 'class=active':''}}>

                            <a href="{{url('ir-link-administrador-externo-formacion')}}"> 

                            <i class="nc-icon nc-user-run"></i>

                                <p>{{ trans('multi-leng.formerror267')}}</p>

                            </a>

                        </li>
                        <li {{ Route::is('ir-link-administrador-externo-extension')? 'class=active':''}}>

                            <a href="{{url('ir-link-administrador-externo-extension')}}"> 

                            <i class="nc-icon nc-user-run"></i>

                                <p>{{ trans('multi-leng.formerror268')}}</p>

                            </a>

                        </li>
                        <li {{ Route::is('ir-link-administrador-externo-proyectos')? 'class=active':''}}>

                            <a href="{{url('ir-link-administrador-externo-proyectos')}}"> 

                            <i class="nc-icon nc-user-run"></i>

                                <p>Proy. de Innov.</p>

                            </a>

                        </li>
                        <li {{ Route::is('ir-link-administrador-externo-recursos')? 'class=active':''}}>

                            <a href="{{url('ir-link-administrador-externo-recursos')}}"> 

                            <i class="nc-icon nc-user-run"></i>

                                <p>{{ trans('multi-leng.formerror270')}}</p>

                            </a>

                        </li>
                    </ul>

                </div>

            </li>
            <li {{Route::is('buscar-concursos-registrados-docentes') || Route::is('buscar-concursos-registrados-docentes') || Route::is('ver-vista-concurso-usuario-registrado-docente') || Route::is('ver-postulantes-registrados-docentes') || Route::is('solicitar-postulacion-concurso-docente') || Route::is('ver-formulario-docente-primera-etapa') || Route::is('ver-formulario-docente-segunda-etapa') || Route::is('ver-formulario-docente-tercera-etapa') || Route::is('ver-formulario-docente-cuarta-etapa') || Route::is('ver-postulaciones-activas-docentes') || Route::is('ver-formulario-docente-historico') ? 'class=active':''}}>
            
                <a data-toggle="collapse" href="#concursos" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.a1')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="concursos" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('buscar-concursos-registrados-docentes') || Route::is('buscar-concursos-registrados-docentes') || Route::is('ver-vista-concurso-usuario-registrado-docente') ? 'class=active':''}}>

                            <a href="{{url('buscar-concursos-registrados-docentes')}}"> 

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.a2') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('ver-postulantes-registrados-docentes') || Route::is('solicitar-postulacion-concurso-docente') || Route::is('ver-formulario-docente-primera-etapa') || Route::is('ver-formulario-docente-segunda-etapa') || Route::is('ver-formulario-docente-tercera-etapa') || Route::is('ver-formulario-docente-cuarta-etapa') || Route::is('ver-postulaciones-activas-docentes') || Route::is('ver-formulario-docente-historico') ? 'class=active':''}}>

                            <a href="{{url('ver-postulaciones-activas-docentes')}}">

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.a3') }}</p>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>
            <li {{Route::is('lluvia-de-ideas-usuarios-registrados')? 'class=active':''}} style="display:none;">

                <a href="{{ route('lluvia-de-ideas-usuarios-registrados') }}">

                    <i class="nc-icon nc-bulb-63"></i>

                    <p>{{ trans('multi-leng.formerror202')}}</p>

                </a>

            </li>
            <li {{Route::is('conectar-usuarios-registrado')? 'class=active':''}} style="display:none;">

                <a href="{{ route('conectar-usuarios-registrado') }}">

                    <i class="nc-icon nc-world-2"></i>

                    <p>Conectar</p>

                </a>

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

