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



            @role('admin')

            <li {{Route::is('permissions.index') || Route::is('permissions.create') || Route::is('permissions.edit') || Route::is('roles.index') || Route::is('roles.create') || Route::is('roles.edit') || Route::is('users.index') || Route::is('users.create') ||Route::is('users.edit') || Route::is('agregar-usuarios-administradores') || Route::is('agregar-usuarios-academicos') || Route::is('agregar-usuarios-estudiantes') || Route::is('agregar-usuarios-noticias')  || Route::is('agregar-usuarios-revisores') ? 'class=active':''}}>

                <a data-toggle="collapse" href="#users" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-single-02"></i>

                    <p>{{ trans('multi-leng.admusu')}}</p>

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

                        <li {{ Route::is('agregar-usuarios-administradores')? 'class=active':''}}>

                            <a href="{{url('agregar-usuarios-administradores')}}"> 

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.multi1') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('agregar-usuarios-academicos') ? 'class=active':''}}>

                            <a href="{{url('agregar-usuarios-academicos')}}">

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.multi2') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('agregar-usuarios-estudiantes') ? 'class=active':''}}>

                            <a href="{{url('agregar-usuarios-estudiantes')}}">

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.multi4') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('agregar-usuarios-noticias') ? 'class=active':''}}>

                            <a href="{{url('agregar-usuarios-noticias')}}">

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.multi3') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('agregar-usuarios-revisores') ? 'class=active':''}}>

                            <a href="{{url('agregar-usuarios-revisores')}}">

                                <i class="nc-icon nc-badge"></i>

                                <p>{{ __('multi-leng.menu1') }}</p>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>

            
            <li {{Route::is('configurar-link-admin') || Route::is('ir-link-administrador-externo-formacion') || Route::is('ir-link-administrador-externo-extension')  || Route::is('ir-link-administrador-externo-proyectos') || Route::is('ir-link-administrador-externo-recursos') ? 'class=active':''}} style="display:none;">

                <a data-toggle="collapse" href="#link" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-vector"></i>

                    <p>{{ trans('multi-leng.formerror222')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="link" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('configurar-link-admin')? 'class=active':''}}>

                            <a href="{{url('configurar-link-admin')}}"> 

                            <i class="nc-icon nc-settings"></i>

                                <p>{{ trans('multi-leng.formerror223')}}</p>

                            </a>

                        </li>
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
            <li {{Route::is('actualizar-documentos-digitales-administrador') || Route::is('buscar-documentos-digitales-administrador') || Route::is('categorias-documentos-digitales-administrador') ? 'class=active':''}} style="display:none;">

                <a data-toggle="collapse" href="#biblio" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.formerror74')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="biblio" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('actualizar-documentos-digitales-administrador')? 'class=active':''}}>

                            <a href="{{url('actualizar-documentos-digitales-administrador')}}"> 

                            <i class="nc-icon nc-minimal-up"></i>

                                <p>{{ __('multi-leng.formerror89') }}</p>

                            </a>

                        </li>

                        <li {{Route::is('buscar-documentos-digitales-administrador') ? 'class=active':''}}>

                            <a href="{{url('buscar-documentos-digitales-administrador')}}">

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.formerror76') }}</p>

                            </a>

                        </li>
                        <li {{Route::is('categorias-documentos-digitales-administrador') ? 'class=active':''}}>

                            <a href="{{url('categorias-documentos-digitales-administrador')}}">

                            <i class="nc-icon nc-paper"></i>

                                <p>{{ __('multi-leng.admcat') }}</p>

                            </a>

                        </li>

                    </ul>

                </div>

            </li>
            <li {{Route::is('buscar-concursos-registrados-administradores') || Route::is('ver-postulantes-registrados-administradores') || Route::is('agregar-nuevos-tags-administrador') || Route::is('agregar-nuevas-categorias-concursos') || Route::is('buscar-concursos-registrados-administradores') || Route::is('ver-vista-concurso-usuarios-registrados') || Route::is('agregar-nuevo-concurso-administrador') || Route::is('editar-vista-concurso-administradores') || Route::is('ver-postulaciones-concursos-registrados-administrador') || Route::is('ver-informacion-ingresada-docente') ? 'class=active':''}}>
            
                <a data-toggle="collapse" href="#concursos" aria-expanded="false" class="collapsed">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.a1')}}</p>

                    <b class="caret"></b>

                </a>

                <div class="collapse" id="concursos" aria-expanded="false" style="height: 0px;">

                    <ul class="nav">

                        <li {{ Route::is('buscar-concursos-registrados-administradores') || Route::is('editar-vista-concurso-administradores') || Route::is('agregar-nuevo-concurso-administrador') || Route::is('ver-postulaciones-concursos-registrados-administrador') || Route::is('ver-vista-concurso-usuarios-registrados') || Route::is('ver-informacion-ingresada-docente') ? 'class=active':''}}>

                            <a href="{{url('buscar-concursos-registrados-administradores')}}"> 

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.a2') }}</p>

                            </a>

                        </li>
                        <li {{Route::is('agregar-nuevos-tags-administrador') ? 'class=active':''}}>

                            <a href="{{url('agregar-nuevos-tags-administrador')}}">

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.a5') }}</p>

                            </a>

                        </li>
                        <li {{Route::is('agregar-nuevas-categorias-concursos') ? 'class=active':''}}>

                            <a href="{{url('agregar-nuevas-categorias-concursos')}}">

                            <i class="nc-icon nc-zoom-split"></i>

                                <p>{{ __('multi-leng.a9') }}</p>

                            </a>

                        </li>
                        

                    </ul>

                </div>

            </li>
            <li {{Route::is('agregar-categorias-administrador')? 'class=active':''}}>

                <a href="{{route('agregar-categorias-administrador')}}">

                    <i class="nc-icon nc-bullet-list-67"></i>

                    <p>{{ __('multi-leng.admcat') }}</p>

                </a>

            </li>
            <li {{Route::is('buscar-documentos-digitales-publicos')? 'class=active':''}} style="display:none;">

                <a href="{{ route('buscar-documentos-digitales-publicos') }}">

                    <i class="nc-icon nc-single-copy-04"></i>

                    <p>{{ trans('multi-leng.formerror188')}}</p>

                </a>

            </li>
            <li {{Route::is('lluvia-de-ideas-usuarios-registrados')? 'class=active':''}} style="display:none;">

                <a href="{{ route('lluvia-de-ideas-usuarios-registrados') }}">

                    <i class="nc-icon nc-bulb-63"></i>

                    <p>{{ trans('multi-leng.formerror202')}}</p>

                </a>

            </li>

            @endrole

            <li {{Route::is('ver-publicaciones-en-linea')? 'class=active':''}} style="display:none;">

                <a href="{{route('ver-publicaciones-en-linea')}}">

                    <i class="nc-icon nc-album-2"></i>

                    <p>{{ __('multi-leng.formerror24') }}</p>

                </a>

            </li>

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

