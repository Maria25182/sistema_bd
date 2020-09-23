<?php 
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'final_bd';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>