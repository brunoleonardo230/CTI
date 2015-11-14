@extends('layouts.layout_login')

@section('content')
<div class="large-12 columns">
<hr style="border: solid #ffffff;" />
  <div class="row">
    <div class="large-6 large-centered columns">
      <form method="post" action="{{URL::to('/login/autenticacao');}}">
        <fieldset style="box-shadow: .25em .25em .5em rgba(0,0,0,.4);">
          <h3 style="color: rgba(0,0,0,.6);">Login</h3>
<br />
          <img src="{{ asset('public/assets/img/logo_def.png') }}" width="25%" class="img" />


          <hr />

          @if(Session::has('flash_error'))
            <div class="alert-box alert radius text-center">
              <strong>Usuario e/ou senha inválidos, tente novamente.</strong>
            </div>
          @endif

          <input type="text" name="strusuario" placeholder="Usuario" required>

          <input type="password" name="strsenha" placeholder="Senha" required>

          <label>
            <input name="remember" type="checkbox" value="remember"> Lembrar-me!
          </label>

          <input type="submit" value="Entrar" class="button expand radius">

          <a class="button secondary expand radius" href="#">Esqueçeu a Senha?</a>
        </fieldset>
      </form>
    </div>
  </div>
</div>
<hr style="border: 1.2em solid #ffffff;" />
@stop