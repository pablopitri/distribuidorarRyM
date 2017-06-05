{!! Form::open(['url' => '/users/'.$user->id, 'method' => 'DELETE']) !!}
	<button type="submit" class="{{ $class }}">
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		ELIMINAR
	</button>
{!! Form::close() !!}
