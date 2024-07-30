@extends('layouts.app')

@section('content')
<div class="wrapper ">
    @role('admin')
        @include('layouts.partials.side-bar-adm')
    @endrole
    @role('user')
        @include('layouts.partials.side-bar-est')
    @endrole
    @role('blog')
        @include('layouts.partials.side-bar-blog')
    @endrole
    @role('docente')
        @include('layouts.partials.side-bar-docente')
    @endrole
    @role('revisor')
        @include('layouts.partials.side-bar-revisor')
    @endrole
    
    <div class="main-panel">
        <!-- nav bar include -->
        @include('layouts.partials.nav')

        @include('errors.custom-message')

        

        @yield('index')

        <!-- @include('layouts.partials.dashboard')   -->
        <!-- include footer -->
        @include('layouts.partials.footer')
    </div>
</div>
@endsection
