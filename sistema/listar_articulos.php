<?php 
	session_start();
	if($_SESSION['rol'] != 4 AND $_SESSION['rol'] != 2 AND $_SESSION['rol'] != 3  )
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
	<title>Lista de Articulos</title>

</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de Articulos </h1>

		
		

		<table>
			<tr>
				<th>Codigo Articulo</th>
				<th>Descripción</th>
				<th>Precio Costo</th>
				<th>Precio de venta</th>
				<th>Tipo de producto</th>
                <th>Acciones</th>
				
			</tr>
		<?php 
			

			$query = mysqli_query($conection,"	SELECT * FROM articulo as c INNER JOIN tipo_producto b WHERE c.fk_tipo_producto = b.cod_tipo_producto");
			
		

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["cod_tipo_producto"]; ?></td>
					<td><?php echo $data["descrip"]; ?></td>
					<td><?php echo $data["precio_costo"]; ?></td>
					<td><?php echo $data['precio_venta']; ?></td>
                     <td><?php echo $data['fk_tipo_producto'] ?></td>
					<td>
					
					
					<?php 

	         if( $_SESSION['rol'] == 1){
?>
				<a class="link_delete" href="#?id=<?php echo $data[""]; ?>">Eliminar</a>
			

					<?php
						
			 }
             ?>
             

             <?php 

	         if( $_SESSION['rol'] == 1 ){
?>
			
				<a class="link_edit" href="#?id=<?php echo $data[""]; ?>">Editar</a>

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