<?php
//este archivo contiene la conexion a la base de datos

$bbdd_server = 'localhost';
$bbdd_user = 'root';
$bbdd_password = '';
$bbdd = 'contro-ventas-bueno';
$conexion = mysqli_connect($bbdd_server,$bbdd_user,$bbdd_password,$bbdd);

mysqli_query($conexion, 'SET NAMES utf8');//garantiza que lo que devuelve la base de datos esta en UTF-8
