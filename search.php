<?php
require_once('bd.php');

switch ($_GET['op']) {
	case 'cliente':
		searchCliente($_GET['term']);
		break;
	case 'producto':
		searchProducto($_GET['term']);
		break;
	default:
		break;
}

function searchCliente($term)
{
	$bd= new bd();

	$term = trim(strip_tags($term));//retrieve the search term that autocomplete sends
	$query = "SELECT idcliente AS 'id',nombre AS 'value' FROM cliente WHERE nombre LIKE '%".$term."%'";
	$result = $bd->executeQuery($query);//query the database for entries containing the term

	if($result === FALSE) {
	    die(mysql_error()); // TODO: better error handling
	}

	while ($row = $bd->fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
	{
			$row['value']=htmlentities(stripslashes($row['value']));
			$row['id']=(int)$row['id'];
			$row_set[] = $row;//build an array
	}
	echo json_encode($row_set);//format the array into json data
}

function searchProducto($term)
{
	$bd= new bd();

	$term = trim(strip_tags($term));//retrieve the search term that autocomplete sends
	$query = "SELECT idproducto AS 'id', descripcion AS 'value', precio AS 'precio' FROM producto WHERE descripcion LIKE '%".$term."%'";
	$result = $bd->executeQuery($query);//query the database for entries containing the term

	if($result === FALSE) {
	    die(mysql_error()); // TODO: better error handling
	}

	while ($row = $bd->fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
	{
			$row['value']=htmlentities(stripslashes($row['value']));
			$row['id']=(int)$row['id'];
			$row['precio']=(double)$row['precio'];
			$row_set[] = $row;//build an array
	}
	echo json_encode($row_set);//format the array into json data
}

?>