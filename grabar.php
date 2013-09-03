<?php
require_once('bd.php');

$pkcliente= $_POST['pkcliente'];
$fecha= $_POST['fecha'];
$hora= $_POST['hora'];
$subtotal= $_POST['subtotal'];
$igv= $_POST['igv'];
$total= $_POST['total'];
$pkproducto= $_POST['pkprod'];
$cantidad= $_POST['cant'];
$importe= $_POST['imp'];
/*
grabarventa();
grabardetalle();

function grabarventa()
{*/
	$db = new bd();

	$query= "INSERT INTO venta(idcliente,fecha,hora,subtotal,igv,total) 
			VALUES(".$pkcliente.",'".$fecha."','".$hora."',".$subtotal.",".$igv.",".$total.")";
	$result= $db->executeQuery($query);
//	$num= $db->num_rows($result);

	if($result === FALSE) {
	    die(mysql_error()); // TODO: better error handling
	}
	$db->disconnect();
/*}

function grabardetalle()
{*/
	$pkventa= obtenerpkultimaventa();
	if($pkventa !== -1){
		$db= new bd();
		for($i=1; $i<= count($pkproducto); $i++){
			if(!empty($pkproducto) && !empty($pkproducto[$i]) && $pkproducto[$i]!==""){
				$query= "INSERT INTO detalle(idproducto,idventa,cantidad,importe) 
						VALUES(".$pkproducto[$i].",".$pkventa.",".$cantidad[$i].",".$importe[$i].")";
				$result= $db->executeQuery($query);
				//$num= $db->num_rows($result);
				if($result === FALSE) {
				    die(mysql_error()); // TODO: better error handling
				}
			}
		}
	}
//}

function obtenerpkultimaventa()
{
	$pkventa= -1;
	$db= new bd();
	$query= "SELECT idventa FROM venta ORDER BY idventa DESC LIMIT 1";
	$result= $db->executeQuery($query);
	$num= $db->num_rows($result);

	if($num>0){
		if($row=$db->fetch_array($result)){
			$pkventa= $row[0];
		}
	}
	$db->disconnect();
	return $pkventa;
}
?>