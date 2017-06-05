@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-md-12">
	          <h1 class="page-head-line">USUARIOS</h1>
	      </div>
	  </div>

	  <div class="float">
	  	<table>
        <tr>
          <td>
            <a href="{{ url('/users') }}" id="back" class="btn btn-default btn-lg margin-r hidden">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
              REGRESAR
            </a>
          </td>
          <td>
          	<a href="{{ url('/users/create') }}" class="btn btn-primary btn-lg">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							NUEVO USUARIO
						</a>
          </td>
        </tr>
      </table>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<div class="col-xs-10">
									<label class="control-label col-xs-1" for="nombre">NOMBRE</label>
									<div class="col-xs-3">
										<input type="text" class="solo-numero form-control" name="nombre" id="nombre" data-n='search'>
									</div>
									<label class="control-label col-xs-1" for="email">EMAIL</label>
									<div class="col-xs-3">
										<input type="text" class="form-control" name="email" id="email" data-n='search'>
									</div>
									<label class="control-label col-xs-1" for="privilegio">PRIV.</label>
									<div class="col-xs-3">
										<select name="privilegio" id="privilegio" class="form-control">
											<option value="0">Seleccione una opción</option>
											<option value="administrador">Administrador</option>
											<option value="cajero">Cajero</option>
										</select>
									</div>
							</div>
							<div class="col-xs-2">
								<button class="btn btn-default search" id="buscar-usuarios" name="buscar-usuarios">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									BUSCAR
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" id="resultado">
			@if(count($users))
				@foreach ($users as $user)
					  <div class="col-xs-6 col-md-3 product">
					    <div class="thumbnail">
					      <img src="{{ ($user->image) ? url($user->image) : url('/images/img.jpg') }}" alt="" class="profile-image">
					      <div class="caption">
					        <a class="center" href="{{ url("/users/$user->id") }}">
					        	<h3>{{ $user->fullname() }}</h3>
					        </a>
					        <div class="center">
					        	<p>Privilegio: {{ strtoupper($user->rol()) }}</p>
					        	<p>Usuario: {{ $user->username }}</p>
					        	<p>Email: {{ $user->email }}</p>
					        </div>
					        <table class="center center2 margin-top">
					        	<tr>
					        		<td>
					        			<a href="{{ url("/users/$user->id/edit") }}" class="btn btn-warning" role="button">
					        				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					        				EDITAR
					        			</a>
					        		</td>
					        		<td>
					        			@include('users.delete', ['user' => $user, 'class' => 'btn btn-danger'])
					        		</td>
					        	</tr>
					        </table>
					      </div>
					    </div>
					  </div>
				@endforeach
				
				<div class="row" id="paginacion">
					<div class="col-xs-12">
						{{ $users->links() }}
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-info">
						  NO HAY USUARIOS PARA MOSTRAR
						</div>
					</div>
				</div>
			@endif
		</div>	
	</div>
@endsection