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
	<title>Lista de clientes</title>

</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de Clientes </h1>
		<a href="registrar_cliente.php" class="btn_new">Crear Cliente</a>
		<form action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>
		
		

		<table>
			<tr>
				<th>codigo Cliente</th>
				<th>Nombre Cliente </th>
				<th>Dirección de residencia</th>
				<th>Telefono del cliente</th>
				<th>Genero</th>
                <th>Fecha De Nacimiento</th>
                <th>Correo del cliente</th>
                <th>Nombre del barrio</th>
                <th>Acciones</th>
				
			</tr>
		<?php 
			

			$query = mysqli_query($conection,"	SELECT * FROM cliente as c INNER JOIN barrio b WHERE c.fk_cod_barrio = b.cod_barrio");
			
		

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["cod_cli"]; ?></td>
					<td><?php echo $data["nombre_cli"]; ?></td>
					<td><?php echo $data["direccion_cli"]; ?></td>
					<td><?php echo $data['telefono_cli']; ?></td>
					<td><?php echo $data['genero'] ?></td>
                     <td><?php echo $data["fecha_nacimiento_cli"] ?></td>
					 <td><?php echo $data["corre_cli"] ?></td>
					 
                     <td><?php echo $data['nombre_barrio'] ?></td>
					<td>
					
					
					<?php 

	         if( $_SESSION['rol'] == 2 ){
?>
				<a class="link_delete" href="eliminar_cliente.php?id=<?php echo $data["cod_cli"]; ?>">Eliminar</a>
			

					<?php
						
			 }
             ?>
             

             <?php 

	         if( $_SESSION['rol'] == 4 ){
?>
			
				<a class="link_edit" href="editar_cliente.php?id=<?php echo $data["cod_cli"]; ?>">Editar</a>

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