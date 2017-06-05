@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-xs-12">
	          <h1 class="page-head-line">NUEVO USUARIO</h1>
	      </div>
	  </div>

		<div class="float">
	  	<table>
	      <tr>
	        <td>
	          <a href="{{ url('/users') }}" id="back" class="btn btn-default btn-lg">
	            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
	            REGRESAR
	          </a>
	        </td>
	      </tr>
	    </table>
		</div>

		<div class="row margin-top">
			<div class="col-xs-12">
				@if (isset($notice))
					<div class="alert alert-danger">
					  <strong>{{ $notice }}</strong>
					</div>
				@endif
				@include('users/form', ['method' => 'POST', 'user' => $user, 'url' => '/users', 'option' => '', 'req' => 'required'])
			</div>
		</div>
	</div>
@endsection