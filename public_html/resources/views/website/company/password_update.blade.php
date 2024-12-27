@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')
<div class="c-dashboard">
    @include('website.layouts.header_company')
    <main>
        <div class="col-12 col-md-6">
            <form class="shadow text-start p-5 mt-4" method="post" action="{{route('company.password.save')}}">
                <h1 class="bold text-center my-2">Actualizar perfil</h1>
                <hr/>
                @csrf
                <div class="group mt-5">
                    <div class="row mt-3">
                        <label for="password_old">Contraseña actual</label>
                        <input id="password_old" type="password" name="password_old" placeholder="Contraseña actual">
                    </div>
                    <div class="row mt-3">
                        <label for="password">Nueva contraseña</label>
                        <input id="password" type="password" name="password" placeholder="Nueva contraseña">
                        <span id="divMostrarPasswordUpdate" style="position: absolute; margin-left: -30px; cursor: pointer; padding: 15px 0px; width: 30px;" >
                            <i class="fa-solid fa-eye bi bi-eye-slash" id="togglePassword"></i>
                        </span>
                    </div>
                    <div class="row mt-3">
                        <label for="password_confirm">Confirmar contraseña</label>
                        <input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmar contraseña">
                    </div>

                    <div class="row mt-3">
                        <input type="submit" class="button button-primary mt-20 margin-center" value="ACTUALIZAR"/>
                    </div>

                </div>
                
            </form>
        </div>
    </main>
</div>


<script>
  $(document).ready(function () {
      $("#divMostrarPasswordUpdate").click(function () {
          console.log($("#password").attr('type'));
          var tipo  = ($("#password").attr('type') === "password" ? "text" : "password");
          console.log(tipo);
          password.setAttribute("type", tipo);
      });
  });
</script>




@endsection
