<?php date_default_timezone_set('America/Lima');?>
<html>
<head>
	<title>Facturaci&oacute;n</title>
	<link rel="stylesheet" href="css/estilos.css"/>
	<link rel="stylesheet" href="css/jquery-ui-1.10.2.css"/>
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.2.js"></script>
	<script src="js/funciones.js"></script>
	<!--<script src="js/add-delete.js"></script>-->
</head>
<body>
<form action="#" method="post">
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolor="white">
<tr>
	<td colspan="6" class="cabecera">REGISTRO DE FACTURA</td>
</tr>
<tr>
	<td width="20%" class="subcabecera">Cliente</td>
	<td width="20%">
		<input type="hidden" name="txtpkcliente" id="idpkcliente" size="2px">
		<input type="text" name="txtcliente" id="idcliente" size="37px">
	</td>
	<td width="20%" class="subcabecera">Fecha</td>
	<td colspan="3"><div id="idfecha"><?php echo date('d-m-Y'); ?></div></td>
</tr>
<tr>
	<td width="20%" class="subcabecera">Tipo de Documento</td>
	<td width="20%">
		<input type="radio" name="rdtipodoc" id="idboleta" value="boleta">Boleta
		<input type="radio" name="rdtipodoc" id="idfactura" value="factura" >Factura
	</td>
	<td width="20%" class="subcabecera">Hora</td>
	<td colspan="3"><div id="idhora"><?php echo date('H:i:s'); ?></div></td>
</tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>
<tr>
	<td class="cabecera">Producto</td>
	<td class="cabecera">Precio</td>
	<td class="cabecera">Cantidad</td>
	<td colspan="3"> &nbsp;</td>
</tr>
<tr>
	<td>
		<input type="hidden" name="txtpkproducto" id="idpkproducto" size="2px">
		<input type="text" name="txtproducto" id="idproducto" size="37px">
	</td>
	<td><input type="text" name="txtpprecio" id="idprecio" size="37px"></td>
	<td><input type="text" name="txtcantidad" id="idcantidad" size="37px"></td>
	<td colspan="3"><input type="button" name="btnagregar" id="idagregar" value="Agregar"></td>
</tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>
<tr>
	<td class="cabecera" width="20%">Item</td>
	<td class="cabecera" width="20%">Producto</td>
	<td class="cabecera" width="20%">Precio</td>
	<td class="cabecera" width="10%">Cantidad</td>
	<td class="cabecera" width="15%">Importe</td>
	<td class="cabecera" width="15%">Acci&oacute;n</td>
</tr>
<tr>
	<td colspan="6">
	<div id="iddetallecompra">
	</div>
	</td>
</tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
	<td align="left">Subtotal</td>
	<td align="right"><div id="idsubtotal">0</div></td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
	<td align="left">IGV</td>
	<td align="right"><div id="idigv">0</div></td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
	<td align="left">Total</td>
	<td align="right"><div id="idtotal">0</div></td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
	<td colspan="2"><input type="submit" name="btnsubmit" id="idsubmit" value="Guardar Venta"></td>
	<td>&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>