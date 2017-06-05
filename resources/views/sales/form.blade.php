{!! Form::open(['url' => $url, 'method' => $method]) !!}
	<div class="panel panel-default hidden" id="sale">
		<div class="panel-body">
			<table id="productos" class="table width table-bordered table-hover black">
				<tr>
					<th class="center">COD.</th>
					<th class="center">NOMBRE</th>
					<th class="center">PRECIO</th>
					<th class="center">CANTIDAD</th>
					<th class="center">TOTAL</th>
					<th style="width:20px;"></th>
				</tr>
			</table>
		</div>
	</div>
	<input type="hidden" value="{{ $n }}" id="products" name="products">
	<input type="hidden" value="{{ $num }}" id="sale" name="products">
	@if(!$option)
		<div class="float-sale hidden" id="button-sale">
			<table>
				<tr>
					<td>
						<button type="submit" class="btn btn-success btn-lg" id="print">
							<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
							PAGAR
						</button>
						</td>
				</tr>
			</table>
		</div>
	@endif
	
{!! Form::close() !!}