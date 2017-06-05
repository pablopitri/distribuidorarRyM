@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-md-12">
	          <h1 class="page-head-line">VENTAS</h1>
	      </div>
	  </div>

	  <div class="float">
	  	<table>
        <tr>
          <td>
            <a href="{{ url('/sales') }}" id="back" class="btn btn-default btn-lg margin-r hidden">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
              REGRESAR
            </a>
          </td>
          <td>
          	<a href="{{ url('/sales/create') }}" class="btn btn-primary btn-lg">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							NUEVA VENTA
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
									<label class="control-label col-xs-1" for="cod">COD.</label>
									<div class="col-xs-3">
										<input type="text" class="solo-numero form-control" name="cod" id="cod">
									</div>
									<label class="control-label col-xs-1" for="fecha">FECHA</label>
									<div class="col-xs-3">
										<input type="text" class="form-control datepicker" name="fecha" id="fecha">
									</div>
									<label class="control-label col-xs-1" for="vendedor">VENDE.</label>
									<div class="col-xs-3">
										<input type="text" class="form-control" name="vendedor" id="vendedor">
									</div>
							</div>
							<div class="col-xs-2">
								<button class="btn btn-default search" id="buscar-venta" name="buscar-venta">
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
			@if(count($sales))
			  <div class="col-xs-12">
			    <table class="table table-hover table-bordered table-striped center width sales">
			    	<tr>
			    		<th class="center">COD. VENTA</th>
				    	<th class="center">FECHA VENTA</th>
				    	<th class="center">TOTAL</th>
				    	<th class="center">VENDEDOR</th>
				    	<th class="center" style="width: 50px">ACCIONES</th>
			    	</tr>
			    	@foreach ($sales as $sale)
				    	<tr>
				    		<td>
				    			<a href="{{ url("/sales/$sale->id") }}">
				    				{{ $sale->id }}
				    			</a>
				    		</td>
				    		<td>{{ $sale->created_at }}</td>
				    		<td>$ {{ number_format($sale->total, 0, '', '.' ) }}</td>
				    		<td>{{ $sale->user->fullname() }}</td>
				    		<td>
				    			<table>
				    				<tr>
				    					<td>
				    						<a href="{{ url("/sales/$sale->id") }}" class="btn btn-sm btn-primary margin-r">
				    							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				    							VER
				    						</a>
				    					</td>
											<td>
												@include('sales/delete', ['sale' => $sale, 'url' => '/sales', 'class' => 'btn btn-danger btn-sm'])
											</td>
				    				</tr>
				    			</table>
				    		</td>
				    	</tr>
			    	@endforeach
			    </table>
			  </div>
				
				<div class="row" id="paginacion">
					<div class="col-xs-12">
						{{ $sales->links() }}
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-info">
						  NO HAY VENTAS PARA MOSTRAR
						</div>
					</div>
				</div>
			@endif
		</div>	
	</div>
@endsection