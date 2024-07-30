<div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo bg-success">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
          <img src="{{url('storage/profile-pic')}}/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}"/>
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          {{ Auth::user()->name }}<br>&nbsp;<br>
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
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
          <li {{Route::is('permissions.index') || Route::is('permissions.create') || Route::is('permissions.edit') || Route::is('roles.index') || Route::is('roles.create') || Route::is('roles.edit') || Route::is('users.index') || Route::is('users.create') ||Route::is('users.edit') || Route::is('agregar-usuarios-administradores') || Route::is('agregar-usuarios-academicos') || Route::is('agregar-usuarios-estudiantes') || Route::is('agregar-usuarios-noticias') ? 'class=active':''}}>
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
                  <li {{Route::is('agregar-usuarios-administradores') ? 'class=active':''}}>
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
                  
                </ul>
            </div>
          </li>
          <li {{Route::is('agregar-categorias-administrador')? 'class=active':''}}>
            <a href="{{route('agregar-categorias-administrador')}}">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>{{ __('multi-leng.admcat') }}</p>
            </a>
          </li>
          <li {{Route::is('buscar-documentos-digitales-publicos')? 'class=active':''}}>
            <a href="{{ route('buscar-documentos-digitales-publicos') }}">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>{{ trans('multi-leng.formerror21')}}</p>
            </a>
          </li>
          @endrole
          @role('blog')
          <li {{Route::is('ver-publicaciones-blog') || Route::is('ver-categorias-blog') ? 'class=active':''}}>
              <a data-toggle="collapse" href="#users" aria-expanded="false" class="collapsed">
                  <i class="nc-icon nc-bullet-list-67"></i>
                  <p>{{ trans('multi-leng.formerror20')}}</p>
                  <b class="caret"></b>
              </a>
              <div class="collapse" id="users" aria-expanded="false" style="height: 0px;">
                <ul class="nav">
                  <li {{ Route::is('ver-publicaciones-blog')? 'class=active':''}}>
                    <a href="{{url('ver-publicaciones-blog')}}"> 
                    <i class="nc-icon nc-badge"></i>
                        <p>{{ __('multi-leng.formerror24') }}</p>
                    </a>
                  </li>
                  <li {{Route::is('ver-categorias-blog') ? 'class=active':''}}>
                    <a href="{{url('ver-categorias-blog')}}">
                    <i class="nc-icon nc-badge"></i>
                      <p>{{ __('multi-leng.formerror21') }}</p>
                    </a>
                  </li>
                  <li {{Route::is('ver-tags-blog') ? 'class=active':''}}>
                    <a href="{{url('ver-tags-blog')}}">
                    <i class="nc-icon nc-badge"></i>
                      <p>{{ __('multi-leng.formerror58') }}</p>
                    </a>
                  </li>
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
