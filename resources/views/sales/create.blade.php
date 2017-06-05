@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-xs-12">
	          <h1 class="page-head-line">VENTA N° {{ $num }}</h1>
	      </div>
	  </div>

		<div class="float">
	  	<table>
	      <tr>
	        <td>
	          <a href="{{ url('/sales/create') }}" id="back" class="btn btn-danger btn-lg">
	            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	            ANULAR
	          </a>
	        </td>
	      </tr>
	    </table>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-xs-10">
							<label class="control-label col-xs-2 right sm-padding-top" for="cod">COD. PRODUCTO</label>
							<div class="col-xs-5">
								<input type="number" class="solo-numero form-control" autofocus="true" name="cod" id="cod" data-n='search'>
							</div>
							<label class="control-label col-xs-2 right sm-padding-top" for="cantidad">CANTIDAD</label>
							<div class="col-xs-3 right">
								<input type="number" class="form-control solo-numero" name="cantidad" id="cantidad" data-n='search'>
							</div>
					</div>
					<div class="col-xs-2 center">
						<button class="btn btn-success" id="agregar" name="agregar">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							AGREGAR
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				@if (isset($notice))
					<div class="alert alert-danger">
					  <strong>{{ $notice }}</strong>
					</div>
				@endif
			</div>
		</div>

		@include('sales/form', ['method' => 'POST', 'sale' => $sale, 'url' => '/sales', 'option' => '', 'n' => $n])

		<div class="row">
			<div class="total-bar">
				<div class="row total">
					<div class="col-xs-6 col-md-2 col-md-offset-8">
						<b>TOTAL: </b>
					</div>
					<div class="col-xs-6 col-md-2 right">
						<strong>$&nbsp;</strong><strong id="total">0</strong>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection