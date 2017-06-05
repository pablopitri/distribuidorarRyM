require('./bootstrap');
require('./bootstrap-toggle.min');
require('./jquery-ui.min');
require('./custom');

$('#rol').bootstrapToggle({
  on: 'Administrador',
  off: 'Cajero'
})

// DATAPICKER
$.datepicker.regional['es'] = {
	closeText: 'Cerrar',
	prevText: '<Ant',
	nextText: 'Sig>',
	currentText: 'Hoy',
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	weekHeader: 'Sm',
	dateFormat: 'dd-mm-yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);

$(".datepicker").datepicker();

// SOLO NUMEROS
$(document).on('keydown', '.solo-numero', function(event){
	if(event.shiftKey)
	{
		return false;
	}

	if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 190)    {
		return true;
	}
	else {
		if (event.keyCode < 95) {
			if (event.keyCode < 48 || event.keyCode > 57) {
				return false;
			}
		} 
		else {
			if (event.keyCode < 96 || event.keyCode > 105) {
				return false;
			}
		}
	}
});
// END SOLO NUMEROS

$(".set_username").change(function(){
	let nombre = $('#name').val().toLowerCase();
	let apellido = $('#last_name').val().toLowerCase();
	if(nombre != '' && apellido != ''){
		$('#username').val(`${nombre}.${apellido}`);
	}
})

//cargar_tipo();

$('#categoria').change(function(){
	cargar_tipo();
})

function cargar_tipo(){
	let categoria = document.getElementById("categoria").value;
	let template = ``;
	if (categoria == 1) {
		template = `
		<option value='papel higienico'>PAPEL HIGIÉNICO</option>
		<option value='detergentes'>DETERGENTES</option>
		<option value='limpieza de cocina'>LIMPIEZA DE COCINA</option>
		<option value='ambientales'>AMBIENTALES</option>
		<option value='pisos'>PISOS</option>
		<option value='cloro'>CLORO</option>
		<option value='servilletas'>SERVILLETAS</option>
		<option value='cabello y manos'>CABELLO Y MANOS</option>
		<option value='dental'>DENTAL</option>
		<option value='proteccion femenina higienico'>PROTECCIÓN FEMENINA</option>
		<option value='bebe'>BEBE</option>`;
	}
	else if (categoria == 2) {
		template = `
		<option value='abarrotes'>ABARROTES</option>
		<option value='confites y galletas'>CONFITES Y GALLETAS</option>
		<option value='bebestibles'>BEBESTIBLES</option>`;
	}
	else if (categoria == 3){
		template = `
		<option value='comida para perros'>COMIDA PARA PERROS</option>
		<option value='comida para gatos'>COMIDA PARA GATOS</option>`;
	}
	$('#tipo').empty().append(template);
}

// SEARCH

function buscar(url, n){
	let template_error = `<div class="col-xs-12">
	<div class="alert alert-info">
	NO SE HAN ECONTRADO RESULTADOS.
	</div>
	</div>`;
	let loader = `<div class="col-xs-12 margin-top center">
	<img src="/distribuidoraRyM/public/images/loader.gif" />
	</div>`;
	$("#resultado").html(loader);
	$.get(url, function(data){
		if (data.length) {
			if (n == 1)
				$("#resultado").html(template_products(data));
			else if(n == 2)
				$("#resultado").html(template_users(data));
			else if(n == 3)
				$("#resultado").html(template_sales(data));
		}else{
			$("#resultado").html(template_error);
		}
	});
}

function url(url){
	return `/distribuidoraRyM/public/${url}`;
}

$('#buscar-productos').click(function(){
	let cod = $('#cod').val() ? $('#cod').val() : 'null';
	let nombre = $('#nombre').val() ? $('#nombre').val() : 'null';
	let categoria = ($('#categoria').val() != '0') ? $('#categoria').val() : 'null';
	if(cod != 'null' || nombre != 'null' || categoria != 'null')
	{
		let url = `/distribuidoraRyM/public/products/search/${cod}/${nombre}/${categoria}`;
		buscar(url, 1);
		$("#back").removeClass('hidden');
		$("#paginacion").addClass('hidden');
	}
});

function template_products(products){
	var token = $('meta[name="csrf-token"]').attr('content');
	var template = '';
	products.map(function(product){
		let image = (product.image) ? url(product.image) : url('images/no-image.jpg');
		template += `
		  <div class="col-xs-6 col-md-3 product">
		    <div class="thumbnail">
		      <img src="${ image }" alt="" class="product-image">
		      <div class="caption">
		        <a class="center" href="${ url(`products/${product.id}`) }">
		        	<h3>${ product.name }</h3>
		        </a>
		        <div class="center">
		        	<p>COD: ${ product.code }</p>
		        	<h4>$ ${ product.price }</h4>
		        </div>
		        <table class="center center2">
		        	<tr>
		        		<td>
		        			<a href="${ url(`products/${product.id}/edit`) }" class="btn btn-warning" role="button">
		        				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		        				EDITAR
		        			</a>
		        		</td>
		        		<td>
		        			<form method="POST" action="http://localhost/distribuidoraRyM/public/products/${product.id}" accept-charset="UTF-8">
		        				<input name="_method" type="hidden" value="DELETE">
										<input name="_token" type="hidden" value="${token}">
										<button type="submit" class="btn btn-danger">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											ELIMINAR
										</button>
									</form>
		        		</td>
		        	</tr>
		        </table>
		      </div>
		    </div>
		  </div>`
	});
	return template;
}

$('button[id="buscar-usuarios"]').click(function(){
	let email = $('#email').val() ? $('#email').val() : 'null';
	let nombre = $('#nombre').val() ? $('#nombre').val() : 'null';
	let priv = ($('#privilegio').val() != '0') ? $('#privilegio').val() : 'null';
	if(email != 'null' || nombre != 'null' || priv != 'null')
	{
		let url = `/distribuidoraRyM/public/users/search/${nombre}/${email}/${priv}`;
		buscar(url, 2);
		$("#back").removeClass('hidden');
		$("#paginacion").addClass('hidden');
	}
});

function template_users(users){
	var token = $('meta[name="csrf-token"]').attr('content');
	var template = '';
	users.map(function(user){
		let image = (user.image) ? url(user.image) : url('images/no-image.jpg');
		template += `
		  <div class="col-xs-6 col-md-3 product">
		    <div class="thumbnail">
		      <img src="${ image }" alt="" class="profile-image">
		      <div class="caption">
		        <a class="center" href="${ url(`users/${user.id}`) }">
		        	<h3>${ user.name } ${user.last_name}</h3>
		        </a>
		        <div class="center">
		        	<p>Privilegio: ${ (user.rol).toUpperCase() }</p>
		        	<p>Usuario: ${ user.username }</p>
		        	<p>Email: ${ user.email }</p>
		        </div>
		        <table class="center center2">
		        	<tr>
		        		<td>
		        			<a href="${ url(`users/${user.id}/edit`) }" class="btn btn-warning" role="button">
		        				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		        				EDITAR
		        			</a>
		        		</td>
		        		<td>
		        			<form method="POST" action="http://localhost/distribuidoraRyM/public/users/${user.id}" accept-charset="UTF-8">
		        				<input name="_method" type="hidden" value="DELETE">
										<input name="_token" type="hidden" value="${token}">
										<button type="submit" class="btn btn-danger">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											ELIMINAR
										</button>
									</form>
		        		</td>
		        	</tr>
		        </table>
		      </div>
		    </div>
		  </div>`
	});
	return template;
}

$('button[id="buscar-venta"]').click(function(){
	let cod = $('#cod').val() ? $('#cod').val() : 'null';
	let fecha = $('#fecha').val() ? $('#fecha').val() : 'null';
	let vendedor = ($('#vendedor').val()) ? $('#vendedor').val() : 'null';
	if(cod != 'null' || fecha != 'null' || vendedor != 'null')
	{
		let url = `/distribuidoraRyM/public/sales/search/${cod}/${fecha}/${vendedor}`;
		buscar(url, 3);
		$("#back").removeClass('hidden');
		$("#paginacion").addClass('hidden');
	}
});

function template_sales(sales){
	var token = $('meta[name="csrf-token"]').attr('content');
	var template = '';
	sales.map(function(sale){
		template += `
			<tr>
    		<td>
    			<a href="${url(`/sales/${sale.id}`) }">
    				${ sale.id }
    			</a>
    		</td>
    		<td>${ sale.created_at }</td>
    		<td>$ ${ formatearNumero(sale.total) }</td>
    		<td>${ sale.user.name } ${sale.user.last_name}</td>
    		<td>
    			<table>
    				<tr>
    					<td>
    						<a href="${ url(`/sales/${sale.id}/edit`) }" class="btn btn-sm btn-warning margin-r">
    							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    							EDITAR
    						</a>
    					</td>
							<td>
	        			<form method="POST" action="http://localhost/distribuidoraRyM/public/sales/${sale.id}" accept-charset="UTF-8">
	        				<input name="_method" type="hidden" value="DELETE">
									<input name="_token" type="hidden" value="${token}">
									<button type="submit" class="btn btn-danger">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										ELIMINAR
									</button>
								</form>
	        		</td>
    				</tr>
    			</table>
    		</td>
    	</tr>
		`;
	});
	let final_template = `
		<div class="col-xs-12">
	    <table class="table table-hover table-bordered table-striped center width sales">
	    	<tr>
	    		<th class="center">COD. VENTA</th>
		    	<th class="center">FECHA VENTA</th>
		    	<th class="center">TOTAL</th>
		    	<th class="center">VENDEDOR</th>
		    	<th class="center" style="width: 50px">ACCIONES</th>
	    	</tr>
	    	${template}
	    </table>
	  </div>
	`;
	return final_template;
}

// CASH

$(document).on('click', 'button[name="agregar"]', function(){
	let n = $('#products').val();
	let cod = $('#cod').val();
	let cant = $('#cantidad').val();
	if(cod != '' && cant != '')
	{
		let url = `/distribuidoraRyM/public/products/search/${cod}/null/null`;
		buscar_producto(url, cant, n);
	}
	$('#cod').val('').focus();
	$('#cantidad').val('');
});

function buscar_producto(url, cant, n){
	$.get(url, function(data){
		if (data.length){
			add_product(data[0], cant, n);
			$('#sale').removeClass('hidden');
			$('#button-sale').removeClass('hidden');
		}else{
			alert("No se encontró el producto");
		}
	});
}

function add_product(product, cant, n){
	let total = cant * product.price;
	let data = [product.code, product.name, product.price, cant, total];
  let nuevaFila=`<tr id="row-${n}">`;
  for(let i=0;i<=5;i++){
  		if(i == 0)
      	nuevaFila+=`<td class="center"><input type="text" value="${product.id}" name="id-${n}" class="hidden"/>${data[i]}</td>`;
      else if(i == 3)
      	nuevaFila+=`<td class="center"><input type="text" value="${data[i]}" name="cant-${n}" class="hidden"/>${formatearNumero(data[i])}</td>`;
      else if(i === 4)
      {
      	setTotal(data[i])
      	nuevaFila+=`<td class="center"><input type="text" value="${data[i]}" name="total-${n}" id="total-${n}" class="hidden"/>${formatearNumero(data[i])}</td>`;
      }
      else if(i == 5)
      	nuevaFila+=`<td class="center"><button class="btn btn-danger borrar" id="${n}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>`;
      else if(i == 2)
      	nuevaFila+=`<td class="center"><input type="text" value="${data[i]}" name="total-${n}" id="total-${n}" class="hidden"/>${formatearNumero(data[i])}</td>`;
      else
      	nuevaFila+=`<td class="center">${data[i]}</td>`;
  }
  nuevaFila+="</tr>";
  $("#productos").append(nuevaFila);
  n++;
  $("#products").val(n);
}

function setTotal(num) {
	let total = $('#total').html();
	total = new Number(total.replace(/\./g, ''));
	total += num;
	total = formatearNumero(total);
	$('#total').html(total);
}

function resetTotal(i){
	let num = new Number($(`#total-${i}`).val());
	let total = $('#total').html();
	total = new Number(total.replace(/\./g, ''));
	total = total - num;
	total = formatearNumero(total);
	$('#total').html(total);
}

$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    let i = $(this).attr('id');
    resetTotal(i);
    $(this).closest('tr').remove();
    let n = $('#products').val();
    n--;
    if(n < 1)
    {
    	$('#sale').addClass('hidden');
			$('#button-sale').addClass('hidden');
    }
  	$("#products").val(n);
});

function formatearNumero(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

$("#print").click(function(event){
	alert("jasjsajsa");
	event.preventDefault();
	$(this).submit();
	let venta = $('#sale').val();
	window.open(`/distribuidoraRyM/public/sale/boleta/${venta}`);
	window.print();
	window.close();
})