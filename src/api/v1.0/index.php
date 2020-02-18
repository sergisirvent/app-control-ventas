<?php
require_once '../includes/conexion.php';

define('API_VERSION','v1.0');

$uri = explode(API_VERSION.'/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1];

$uri_array = explode('/',$uri);

$recurso = array_shift($uri_array);

$operacion = strtolower($_SERVER['REQUEST_METHOD']);



switch ($operacion) {
case 'get':
$sql = 'SELECT vendedores.nombre as nombreVendedor, vendedores.apellidos as
apellidosVendedor,clientes.nombre as nombreCliente, ventas.* FROM `ventas`,
vendedores, clientes WHERE ventas.vendedor = vendedores.id AND
ventas.cliente = clientes.id';

    $res = mysqli_query($conexion, $sql);
    $resultado = array();
    while($fila = mysqli_fetch_assoc($res)){
        $vendedor = array("id" => $fila["vendedor"], "nombre" =>
            $fila["nombreVendedor"], "apellidos" => $fila["apellidosVendedor"]);
        $cliente = array("id" => $fila["cliente"], "nombre" =>
            $fila["nombreCliente"]);
        $fila["vendedor"] = $vendedor;
        $fila["cliente"] = $cliente;
        unset($fila["nombreVendedor"]);
        unset($fila["apellidosVendedor"]);
        unset($fila["nombreCliente"]);
        array_push($resultado, $fila);
    }
break;
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: PUT,GET,POST,DELETE");
header("Content-Type: application/json; charset=utf-8");
echo json_encode($resultado, JSON_PRETTY_PRINT);