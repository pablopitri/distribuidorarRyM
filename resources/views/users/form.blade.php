{!! Form::open(['url' => $url, 'method' => $method, 'files' => true ]) !!}
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<div class="col-xs-7">

					<div class="form-group">
						<label class="control-label col-xs-3" for="name">Nombre</label>
						<div class="col-xs-9">
							{{ Form::text('name', $user->name, ['class' => 'form-control set_username', $option => 'true', 'required' => 'true', 'id' => 'name']) }}
						</div>
					</div>
					<br>
					<div class="form-group">
						<br>
						<label class="control-label col-xs-3" for="last_name">Apellido</label>
						<div class="col-xs-9">
						{{ Form::text('last_name', $user->last_name, ['class' => 'form-control set_username', $option => 'true', 'required' => 'true', 'id' => 'last_name']) }}
						</div>
					</div>
					<br>
					<div class="form-group">
					<br>
						<label class="control-label col-xs-3" for="username">Nombre&nbsp;Usuario</label>
						<div class="col-xs-9">
						{{ Form::text('username', $user->username, ['class' => 'form-control', $option => 'true', 'required' => 'true', 'id' => 'username']) }}
						</div>
					</div>
					<br>
					<div class="form-group">
					<br>
						<label class="control-label col-xs-3" for="email">Email</label>
						<div class="col-xs-9">
						{{ Form::email('email', $user->email, ['class' => 'form-control', $option => 'true', 'required' => 'false', 'id' => 'email']) }}
						</div>
					</div>
					@if(!$option)
						<br>
						<div class="form-group">
						<br>
							<label class="control-label col-xs-3" for="password">Contraseña</label>
							<div class="col-xs-9">
							{{ Form::password('password', ['class' => 'form-control', $option => 'true', $req => 'true', 'id' => 'password']) }}
							</div>
						</div>
						<br>
						<div class="form-group">
						<br>
							<label class="control-label col-xs-3" for="password_confirmation">Confirme Contraseña</label>
							<div class="col-xs-9">
							{{ Form::password('password_confirmation', ['class' => 'form-control', $option => 'true', $req => 'true', 'id' => 'password_confirmation']) }}
							</div>
						</div>
					@endif
					@if (Auth::user()->isAdmin())
						<br>
						<div class="form-group">
							<br>
	            <label for="admin" class="col-md-3 control-label">Privilegios</label>
	            <div class="col-md-9">
	              <input name="rol" id="rol" data-toggle="toggle" value="administrador"  type="checkbox" data-onstyle="danger" data-offstyle="success" {{ $option ? 'disabled' : '' }} {{ ($user->rol == 'administrador') ? 'checked' : '' }}>
	            </div>
	          </div>
					@endif

				</div>

				<div class="col-xs-5" style="text-align: center">
					<img src="{{ ($user->image) ? url($user->image) : url('/images/img.jpg') }}" alt="NO IMAGE" class="margin-bottom user-image" id="product-image">
					{{ Form::file('image', ['class' => 'form-control', 'id' => 'image', $option => 'true']) }}
				</div>
			</div>

		</div>
	</div>

	@if(!$option)
		<div class="float-bottom">
			<table>
				<tr>
					<td>
						<a href="{{ url('/users/') }}" class="btn btn-default btn-lg margin-r">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
							REGRESAR
						</a>
					</td>
					<td>
						<button type="submit" class="btn btn-success btn-lg">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
							GUARDAR
						</button>
						</td>
				</tr>
			</table>
		</div>
	@endif
	
{!! Form::close() !!}