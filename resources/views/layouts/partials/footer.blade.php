<footer class="footer footer-black  footer-white ">
  <div class="container-fluid">
    <div class="row">
      <nav class="footer-nav">
        <ul>
          <li>
            <a href="https://www.creative-tim.com" target="_blank"></a>
          </li>
        </ul>
      </nav>
      <div class="credits ml-auto">
        <span class="copyright">
          ©
          <script>
            document.write(new Date().getFullYear());
            @if(Auth::user()->cargo_us == "Administrador" || Auth::user()->cargo_us == "Estudiante" || Auth::user()->cargo_us == "Docente")
              let timerId = setTimeout(function tick() 
              {
                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var type = "POST";
                var ajaxurl = "{{route('registro-usuario-en-linea')}}";
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (datos) {
                        console.log(datos);
                    },
                    error: function (data) {
                        console.log("registro-usuario-en-linea-footer"+data,);
                    }
                });
                timerId = setTimeout(tick, 240000); // (*)
            }, 2000);                
            @endif
          </script>. {{__('lang.textprof6')}} Oscar Zambrano V.
        </span>
      </div>
    </div>
  </div>
</footer>
