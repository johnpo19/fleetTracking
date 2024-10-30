<?php
$serverName = "DOMO163\MSSQLSERVER"; 


$connectionInfo = array( "Database"=>"Vehiculos");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>