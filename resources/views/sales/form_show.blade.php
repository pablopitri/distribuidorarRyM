<div class="panel panel-default">
	<div class="panel-body">
		<table class="table width table-bordered table-hover black center sales">
			<tr>
				<th class="center">COD.</th>
				<th class="center">NOMBRE</th>
				<th class="center">PRECIO</th>
				<th class="center">CANTIDAD</th>
				<th class="center" style="width: 200px">TOTAL</th>
			</tr>
		@foreach($sale->products as $product)
			<tr>
				<td>{{ $product->code }}</td>
				<td>{{ $product->name }}</td>
				<td>$ {{ number_format($product->price, 0, '', '.') }}</td>
				<td>{{ number_format($product->pivot->quantity, 0, '', '.') }}</td>
				<td style="text-align: left;padding-left: 50px">$ {{ number_format($product->pivot->total, 0, '', '.') }}</td>
			</tr>
		@endforeach
		</table>
	</div>
</div>