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

            @role('user')
            <li {{Route::is('buscar-documentos-digitales-administrador') ? 'class=active':''}} style="display:none;" style="display:none;">

                <a href="{{url('buscar-documentos-digitales-administrador')}}">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.formerror74')}}</p>

                </a>

            </li>

            <li {{Route::is('buscar-documentos-digitales-publicos')? 'class=active':''}} style="display:none;">

                <a href="{{ route('buscar-documentos-digitales-publicos') }}">

                    <i class="nc-icon nc-book-bookmark"></i>

                    <p>{{ trans('multi-leng.formerror188')}}</p>

                </a>

            </li>

            <li {{Route::is('buscar-foros-usuario-registrado')? 'class=active':''}} style="display:none;">

                <a href="{{ route('buscar-foros-usuario-registrado') }}">

                    <i class="nc-icon nc-chat-33"></i>

                    <p>{{ trans('multi-leng.formerror75')}}</p>

                </a>

            </li>

            <li {{Route::is('buscar-chats-usuario-registrado-est')? 'class=active':''}} style="display:none;">

                <a href="{{ route('buscar-chats-usuario-registrado-est') }}">

                    <i class="nc-icon nc-tap-01"></i>

                    <p>Chats</p>

                </a>

            </li>
            <li {{Route::is('lluvia-de-ideas-usuarios-registrados')? 'class=active':''}} style="display:none;">

                <a href="{{ route('lluvia-de-ideas-usuarios-registrados') }}">

                    <i class="nc-icon nc-bulb-63"></i>

                    <p>{{ trans('multi-leng.formerror202')}}</p>

                </a>

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

