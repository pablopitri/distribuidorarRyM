@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-xs-12">
	          <h1 class="page-head-line">VENTA N° {{ $sale->id }}</h1>
	      </div>
	  </div>

		<div class="float">
	  	<table>
	      <tr>
	        <td>
	          <a href="{{ url('/sales') }}" id="back" class="btn btn-default btn-lg">
	            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
	            REGRESAR
	          </a>
	        </td>
	        @if (Auth::user()->isAdmin())
	        	<td>
	      			@include('sales.delete', ['sale' => $sale, 'class' => 'btn btn-lg btn-danger'])
	      		</td>
	        @endif
	      </tr>
	    </table>
		</div>

		<div class="row margin-top">
			<div class="col-xs-12">
				@include('sales/form_show', ['sale' => $sale])
			</div>
		</div>

		<div class="row">
			<div class="total-bar">
				<div class="row total">
					<div class="col-xs-6 col-md-2 col-md-offset-8">
						<b>TOTAL: </b>
					</div>
					<div class="col-xs-6 col-md-2 right">
						<strong>$&nbsp;</strong><strong id="total">{{ number_format($sale->total, 0, '', '.') }}</strong>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection