<?php 
	session_start();
	if($_SESSION['rol'] != 1 AND $_SESSION['rol'] !=3 AND $_SESSION['rol'] !=3 AND $_SESSION['rol'] !=4)
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
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: listar_clientes.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Lista de usuarios</h1>
		<a href="registrar_cliente.php" class="btn_new">Crear usuario</a>
		
		<form action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
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
		


			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM cliente
																WHERE (cod_cli LIKE '%$busqueda%' OR
                                                                nombre_cli like '%$busqueda%')
																		
																		
																
															 ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT * from cliente 
										WHERE 
										(  cod_cli LIKE '%$busqueda%' OR
                                        nombre_cli like '%$busqueda%')
										 
											
										 ORDER BY cod_cli ASC LIMIT $desde,$por_pagina 
				");
			mysqli_close($conection);
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
					 
                     <td><?php echo $data['fk_cod_barrio'] ?></td>>
					<td>
					<a class="link_edit" href="editar_cliente.php?id=<?php echo $data["cod_cli"]; ?>">Editar</a>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>