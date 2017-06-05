{!! Form::open(['url' => $url, 'method' => $method, 'files' => true ]) !!}
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<div class="col-xs-6">

					<div class="form-group">
						<label class="control-label col-xs-3" for="codigo">CODIGO</label>
						<div class="col-xs-9">
							{{ Form::text('codigo', $product->code, ['class' => 'form-control', $option => 'true', 'required' => 'true', 'id' => 'codigo', 'autofocus' => "true"]) }}
						</div>
					</div>
					<br>
					<div class="form-group">
						<br>
						<label class="control-label col-xs-3" for="titulo">TÍTULO</label>
						<div class="col-xs-9">
						{{ Form::text('titulo', $product->name, ['class' => 'form-control', $option => 'true', 'required' => 'true', 'id' => 'titulo']) }}
						</div>
					</div>
					<br>
					<div class="form-group">
					<br>
						<label class="control-label col-xs-3" for="precio">PRECIO</label>
						<div class="col-xs-9">
						{{ Form::number('precio', $product->price, ['class' => 'form-control', $option => 'true', 'required' => 'true', 'id' => 'precio']) }}
						</div>
					</div>
					<br>
					<div class="form-group">
						<br>
						<label class="control-label col-xs-3" for="categoria">CATEGORÍA</label>
						<div class="col-xs-9">
						{{ Form::select('categoria', ['0' => 'SELECCIONE CATEGORÍA','1' => 'ASEO E HIGIENE', '2' => 'ALIMENTOS', '3' => 'ALIMENTOS PARA MASCOTAS'], $product->category, ['class' => 'form-control', 'id' => 'categoria', ($option) ? 'disabled' : '' => 'true']) }}
						</div>
					</div>
					<br>
					<div class="form-group">
						<br>
						<label class="control-label col-xs-3" for="tipo">TIPO</label>
						<div class="col-xs-9">
						{{ Form::select('tipo', [], $product->type, ['class' => 'form-control', 'id' => 'tipo', ($option) ? 'disabled' : '' => 'true']) }}
						</div>
					</div>

				</div>

				<div class="col-xs-6" style="text-align: center">
					<img src="{{ ($product->image) ? url($product->image) : url('/images/no-image.jpg') }}" alt="NO IMAGE" class="margin-bottom" id="product-image">
					{{ Form::file('image', ['class' => 'form-control', 'id' => 'image']) }}
				</div>
			</div>

		</div>
	</div>

	@if(!$option)
		<div class="float-bottom">
			<table>
				<tr>
					<td>
						<a href="{{ url('/products/') }}" class="btn btn-default btn-lg margin-r">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
							REGRESAR
						</a>
					</td>
					<td>
						<button type="submit" class="btn btn-success btn-lg">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
							GUARDAR
						</button>
						</td>
				</tr>
			</table>
		</div>
	@endif
	
{!! Form::close() !!}