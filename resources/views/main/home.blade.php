@extends('layouts.app')

@section('content')
	<div class="row margin-top">
		<div class="col-xs-12">
			@if (session('notice'))
				<div class="alert alert-danger">
				  <strong>{{ session('notice') }}</strong>
				</div>
			@endif
		</div>
	</div>
  <h1>Hola mundo2</h1>
@endsection