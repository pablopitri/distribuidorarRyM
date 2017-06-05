@extends('layouts.app')

@section("content")
	<div class="relative">
		<div class="row">
	      <div class="col-md-12">
	          <h1 class="page-head-line">PRODUCTOS </h1>
	      </div>
	  </div>

	  <div class="float">
	  	<table>
        <tr>
          <td>
            <a href="{{ url('/products') }}" id="back" class="btn btn-default btn-lg margin-r hidden">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
              REGRESAR
            </a>
          </td>
          <td>
          	<a href="{{ url('/products/create') }}" class="btn btn-primary btn-lg">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							NUEVO PRODUCTO
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

									<label class="control-label col-xs-1" for="codigo">CODIGO</label>
									<div class="col-xs-3">
										<input type="number" class="solo-numero form-control" name="cod" id="cod" data-n='search'>
									</div>

									<label class="control-label col-xs-1" for="codigo">NOMBRE</label>
									<div class="col-xs-3">
										<input type="text" class="form-control" name="nombre" id="nombre" data-n='search'>
									</div>

									<label class="control-label col-xs-1" for="codigo">CATEG.</label>
									<div class="col-xs-3">
										<select name="categoria" id="categoria" class="form-control">
											<option value="0">Seleccione una categoria</option>
											<option value="1">Aseo e higiene</option>
											<option value="2">Alimentos</option>
											<option value="3">Alimentos para mascotas</option>
										</select>
									</div>
							</div>
							<div class="col-xs-2">
								<button class="btn btn-default" id="buscar-productos">
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
			@if(count($products))
				@foreach ($products as $product)
					  <div class="col-xs-6 col-md-3 product">
					    <div class="thumbnail">
					      <img src="{{ ($product->image) ? url($product->image) : url('/images/no-image.jpg') }}" alt="" class="product-image">
					      <div class="caption">
					        <a class="center" href="{{ url("/products/$product->id") }}">
					        	<h3>{{ $product->name }}</h3>
					        </a>
					        <div class="center">
					        	<p>COD: {{ $product->code }}</p>
					        	<h4>$ {{ $product->price }}</h4>
					        </div>
					        <table class="center center2">
					        	<tr>
					        		<td>
					        			<a href="{{ url("/products/$product->id/edit") }}" class="btn btn-warning" role="button">
													<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					        				EDITAR
					        			</a>
					        		</td>
					        		<td>
					        			@include('products.delete', ['product' => $product, 'class' => 'btn btn-danger'])
					        		</td>
					        	</tr>
					        </table>
					      </div>
					    </div>
					  </div>
				@endforeach
				
				<div class="row" id="paginacion">
					<div class="col-xs-12">
						{{ $products->links() }}
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-info">
						  NO HAY PRODUCTOS PARA MOSTRAR
						</div>
					</div>
				</div>
			@endif
		</div>	
	</div>
@endsection