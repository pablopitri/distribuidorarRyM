@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-xs-12">
	          <h1 class="page-head-line">{{ $user->fullName() }}</h1>
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
	        @if ($user->id == Auth::user()->id)
	        	<td>
		          <a href="{{ url("/users/$user->id/edit") }}" id="back" class="btn btn-warning btn-lg">
		            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		            EDITAR
		          </a>
		        </td>
	        @endif
	        @if (Auth::user()->isAdmin())
	        	<td>
	      			@include('users.delete', ['user' => $user, 'class' => 'btn btn-lg btn-danger'])
	      		</td>
	        @endif
	      </tr>
	    </table>
		</div>

		<div class="row margin-top">
			<div class="col-xs-12">
				@include('users/form', ['method' => '', 'user' => $user, 'url' => '', 'option' => 'readonly', 'req' => ''])
			</div>
		</div>
	</div>
@endsection