@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-xs-12">
	          <h1 class="page-head-line">{{ $product->name }}</h1>
	      </div>
	  </div>

	  <div class="float">
	  	<table>
	      <tr>
	        <td>
	          <a href="{{ url('/products') }}" id="back" class="btn btn-default btn-lg margin-r">
	            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
	            REGRESAR
	          </a>
	        </td>
	        <td>
	        	<a href="{{ url("/products/$product->id/edit") }}" class="btn btn-warning btn-lg margin-r">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							EDITAR
						</a>
	        </td>
	        <td>
      			@include('products.delete', ['product' => $product, 'class' => 'btn btn-lg btn-danger'])
      		</td>
	      </tr>
	    </table>
		</div>

		<div class="row margin-top">
			<div class="col-xs-12">
				@include('products/form', ['method' => '', 'product' => $product, 'url' => '', 'option' => 'readonly'])
			</div>
		</div>
	</div>
@endsection