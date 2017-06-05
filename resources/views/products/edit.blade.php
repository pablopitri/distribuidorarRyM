@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-xs-12">
	          <h1 class="page-head-line">EDITAR PRODUCTO</h1>
	      </div>
	  </div>

		<div class="float">
	  	<table>
	      <tr>
	        <td>
	          <a href="{{ url('/products') }}" id="back" class="btn btn-default btn-lg">
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
				@include('products/form', ['method' => 'PATCH', 'product' => $product, 'url' => "/products/$product->id", 'option' => ''])
			</div>
		</div>
	</div>
@endsection