<?php 
	session_start();
	if($_SESSION['rol'] != 4 AND $_SESSION['rol'] != 2 AND $_SESSION['rol'] != 3 )
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
	<title>Lista de Lineas de factura</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de Linea de facturas</h1>
		
		

		<table>
			<tr>
				<th>codigo factura</th>
				<th>linea</th>
				<th>cant</th>
				<th>precio</th>
				<th>descuento</th>
				<th>codigo articulo</th>
				<th>Acciones</th>
				
			</tr>
		<?php 
			

			$query = mysqli_query($conection,"SELECT * FROM linea_fac");

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["fk_codfac"]; ?></td>
					<td><?php echo $data["linea"]; ?></td>
					<td><?php echo $data["cant"]; ?></td>
					<td><?php echo $data["precio"]; ?></td>
					<td><?php echo $data['dto'] ?></td>
                     <td><?php echo $data['fk_codart'] ?></td>
					<td>
					<?php 

	         if( $_SESSION['rol'] == 2 ){
?>
				<a class="link_delete" href="eliminar_linea.php?id=<?php echo $data["fk_codfac"]; ?>">Eliminar</a>
				<a class="link_edit" href="editar_linea.php?id=<?php echo $data["fk_codfac"]; ?>">Editar</a>

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