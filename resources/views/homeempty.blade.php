@extends('layouts.app')

@section('content')
<div class="wrapper ">
    
    @role('revisor')
        @include('layouts.partials.side-bar-revisor-empty')
    @endrole
    @role('docente')
        @include('layouts.partials.side-bar-revisor-empty')
    @endrole
    
    <div class="main-panel">
        <!-- nav bar include -->
        @include('layouts.partials.navempty')

        @include('errors.custom-message')

        

        @yield('index')

        <!-- @include('layouts.partials.dashboard')   -->
        <!-- include footer -->
        @include('layouts.partials.footer')
    </div>
</div>
@endsection
