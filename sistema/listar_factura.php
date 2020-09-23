<?php 
	session_start();
	if($_SESSION['rol'] != 4 AND $_SESSION['rol'] != 2  AND $_SESSION['rol'] != 3 )
	{
		header("location: ./");
	}
	
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de usuarios</title>

</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de Facturas </h1>

		
		
		

		<table>
			<tr>
				<th>codigo factura</th>
				<th>Fecha</th>
				<th>Codigo Cliente</th>
				<th>IVA</th>
				<th>descuento</th>
				<th>codigo Cajero</th>
				<th>Acciones</th>
		
				
			</tr>
		<?php 
			

			$query = mysqli_query($conection,"SELECT * FROM factura");

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["codfac"]; ?></td>
					<td><?php echo $data["fecha"]; ?></td>
					<td><?php echo $data["fk_codcli"]; ?></td>
					<td><?php echo $data["iva"]; ?></td>
					<td><?php echo $data["dto"] ?></td>
                     <td><?php echo $data['fk_cod_cajero'] ?></td>
					
					
					<td>
					<?php 

	         if( $_SESSION['rol'] == 2 ){
?>
				<a class="link_delete" href="eliminar_factura.php?id=<?php echo $data["codfac"]; ?>">Eliminar</a>
				<a class="link_edit" href="editar_factura.php?id=<?php echo $data["codfac"]; ?>">Editar</a>

					<?php

						
			 }
			 ?>
					
					
					</td>
				</tr>
			
	
				
            <?php
			}
		}
		 
			?>

	
		

	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>