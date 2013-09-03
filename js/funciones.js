var item=0;
var nro=new Array();
var pkproducto=new Array();
var producto=new Array();
var precio=new Array();
var cantidad=new Array();
var importe=new Array();
var subtotal=0.0;
var igv=0.18;
var total=0.0;

$(document).on('ready',function(){
	$("#idcliente").focus();

	$("#idcliente").autocomplete({
		source: "search.php?op=cliente",
		minLength: 1,
		select: function(event,ui){
	    	$('#idpkcliente').val(ui.item.id);
	    }
	});

	$("#idproducto").autocomplete({
		source: "search.php?op=producto",
		minLength: 1,
		select: function(event,ui){
	    	$('#idpkproducto').val(ui.item.id);
	    	$('#idprecio').val(ui.item.precio);
	    	$('#idcantidad').val(1);
	    }
	});

	$("#idboleta").click(function(){
		calcularsubtotal();
		calculartotal();
	});

	$("#idfactura").click(function(){
		calcularsubtotal();
		calculartotal();
	});

	$('#idagregar').click(function(){
		item=item+1;
		agregararray(item);
		agregarproducto();
		calcularsubtotal();
		calculartotal();
		limpiarproducto();
	});

	$("#idsubmit").click(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "grabar.php",
			data: {pkcliente:$("#idpkcliente").val(), fecha:$("#idfecha").text(), hora:$("#idhora").text(), 
			subtotal:$("#idsubtotal").text(), igv:$("#idigv").text(), total:$("#idtotal").text(), 
			pkprod:pkproducto, cant:cantidad, imp: importe},
			success: function(data){
				alert('Registro grabado con exito');
				console.log(data);
			}
		});
	});
});

function limpiarproducto(){
	$('#idpkproducto').val('');
	$('#idproducto').val('');
	$('#idcantidad').val('');
	$('#idprecio').val('');
	$('#idproducto').focus();
}

function calcularsubtotal(){
	var temp=0.0;
	for(i=1;i<=item;i++){
		if(importe[i] !== undefined){
			temp += importe[i];
		}
	}
	subtotal=temp;
	$("#idsubtotal").text(Math.round(parseFloat(subtotal)*100)/100);
}

function calculartotal(){
	if($("input[name='rdtipodoc']:checked").val() == "factura"){
		total = (igv*subtotal)+subtotal;
		$("#idigv").text(Math.round(igv*subtotal*100)/100);
		$("#idtotal").text(Math.round(total*100)/100);
	}
	else{
		$("#idigv").text("0.00");
		$("#idtotal").text(Math.round(subtotal*100)/100);
	}
}

function agregararray(indice){
	nro[indice] = item;
	pkproducto[indice] = $('#idpkproducto').val();
	producto[indice] = $('#idproducto').val();
	precio[indice] = Math.round($('#idprecio').val() * 100) / 100;
	cantidad[indice] = $('#idcantidad').val();
	importe[indice] = Math.round($('#idcantidad').val() * $('#idprecio').val() * 100) / 100;
}

function agregarproducto(){
	$("#iddetallecompra").append("<table width=100% border=0 cellpadding=0 cellspacing=0 id="+item+">"+
		"<tr><td width=20% align='center'>"+item+
		"</td><td width=20% align='left'>"+$('#idproducto').val()+
		"</td><td width=20% align='right'>"+Math.round($('#idprecio').val()*100)/100+
		"</td><td width=10% align='right'>"+
		Math.round($('#idcantidad').val()*100)/100+
		"</td><td width=15% align='right'>"+
		Math.round($('#idcantidad').val() * $('#idprecio').val()*100)/100+
		"</td><td width=15% align='center'>"+
		"<a href=# onclick='eliminarproducto(event,"+item+");'>Eliminar</a> "+
		"<a href=# onclick='editarproducto(event,"+item+");'>Editar</a>"+"</td></tr></table>");
}

function eliminarproducto(e,elemento){
	e.preventDefault();
	$("#"+elemento).remove();
	//item=item-1;
	eliminararray(elemento);
	calcularsubtotal();
	calculartotal();
	limpiarproducto();
}

function eliminararray(elemento){
	delete nro[elemento];
	delete pkproducto[elemento];
	delete producto[elemento];
	delete precio[elemento];
	delete cantidad[elemento];
	delete importe[elemento];
/*	Elimina un elemento del arreglo y los reubica
	nro.splice(elemento,1);
	pkproducto.splice(elemento,1);
	producto.splice(elemento,1);
	precio.splice(elemento,1);
	cantidad.splice(elemento,1);
	importe.splice(elemento,1);
*/
}

function editarproducto(e,elemento){
	e.preventDefault();
	$("#"+elemento).html("<table width=100% border=0 cellpadding=0 cellspacing=0 id="+item+">"+
		"<tr><td width=20% align='center'>"+elemento+
		"</td><td width=20% align='left'>"+producto[elemento]+
		"</td><td width=20% align='right'><input type=text id=idprecionuevo size=37px value="+
		Math.round(precio[elemento]*100)/100+">"+
		"</td><td width=10% align='right'><input type=text id=idcantidadnuevo size=15px value="+
		Math.round(cantidad[elemento]*100)/100+">"+
		"</td><td width=15% align='right'>"+Math.round(importe[elemento]*100)/100+
		"</td><td width=15% align='center'>"+
		"<a href=# onclick='eliminarproducto(event,"+elemento+");'>Eliminar</a> "+
		"<a href=# onclick='editarproducto(event,"+elemento+");'>Editar</a> "+
		"<a href=# onclick='actualizarproducto(event,"+elemento+");'>Actualizar</a>"+"</td></tr></table>");
}

function actualizarproducto(e,elemento){
	e.preventDefault();
	actualizararray(elemento);
	updateproduct(elemento);
	calcularsubtotal();
	calculartotal();
	limpiarproducto();
}

function actualizararray(elemento){
	precio[elemento] = Math.round($('#idprecionuevo').val() * 100) / 100;
	cantidad[elemento] = $('#idcantidadnuevo').val();
	importe[elemento] = Math.round($('#idcantidadnuevo').val() * $('#idprecionuevo').val() * 100) / 100;
}

function updateproduct(elemento){
	$("#"+elemento).html("<table width=100% border=0 cellpadding=0 cellspacing=0 id="+item+">"+
		"<tr><td width=20% align='center'>"+elemento+
		"</td><td width=20% align='left'>"+producto[elemento]+
		"</td><td width=20% align='right'>"+Math.round(precio[elemento]*100)/100+
		"</td><td width=10% align='right'>"+Math.round(cantidad[elemento]*100)/100+
		"</td><td width=15% align='right'>"+Math.round(importe[elemento]*100)/100+
		"</td><td width=15% align='center'>"+
		"<a href=# onclick='eliminarproducto(event,"+elemento+");'>Eliminar</a> "+
		"<a href=# onclick='editarproducto(event,"+elemento+");'>Editar</a></td></tr></table>");
}