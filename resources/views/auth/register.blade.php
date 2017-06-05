@extends('layouts.auth')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default margin-top-md">
          <div class="panel-heading">Registrarse</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              {{ csrf_field() }}

              <div class="form-group">
                <div class="col-md-6 col-xs-12">

                  <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-6">
                      <input id="name" type="text" class="form-control set_username" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="last_name" class="col-md-4 control-label">Apellido</label>
                    <div class="col-md-6">
                      <input id="last_name" type="text" class="form-control set_username" name="last_name" value="{{ old('last_name') }}" required autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username" class="col-md-4 control-label">Nombre de Usuario</label>
                    <div class="col-md-6">
                      <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-md-4 control-label">E-Mail</label>
                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>
                    <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="admin" class="col-md-4 control-label">Privilegios</label>
                    <div class="col-md-6">
                      <input name="rol" id="rol" data-toggle="toggle" value="administrador" checked type="checkbox" data-onstyle="danger" data-offstyle="success">
                    </div>
                  </div>

                </div>

                <div class="col-xs-12 col-md-6" style="text-align: center">
                  <img src="{{ url('/images/no-image.jpg') }}" alt="NO IMAGE" class="margin-bottom" id="product-image">
                  {{ Form::file('image', ['class' => 'form-control', 'id' => 'image']) }}
                </div>

              </div>

              <div class="form-group">
                <div class="col-xs-12 center">
                  <button type="submit" class="btn btn-primary btn-lg">
                    Registrar
                  </button>
                </div>
              </div>

              <div class="form-group margin-top">
                  <div class="col-xs-12 center margin-top">
                      <a class="btn btn-link" href="{{ route('login') }}">
                          Login
                      </a>
                  </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
