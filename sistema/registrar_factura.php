<?php 
	session_start();
	if($_SESSION['rol'] != 4 AND $_SESSION['rol'] != 2 )
	{
		header("location: ./");
	}
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['codfac']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $codfac = $_POST["codfac"];
            $fecha = $_POST["fecha"];
            $fk_codcli = $_POST["fk_codcli"];
            $iva = $_POST["iva"];
            $dto = $_POST["dto"];
            $fk_cod_cajero = $_POST["fk_cod_cajero"];
		   

		
			$query = mysqli_query($conection,"SELECT * FROM factura where codfac='$codfac'");
			$result = mysqli_fetch_array($query);

			

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO factura (codfac, fecha, fk_codcli, iva,dto, fk_cod_cajero) 
				VALUES ('$codfac', '$fecha', '$fk_codcli','$iva','$dto','$fk_cod_cajero')");

				if($query_insert){
					$alert='<p class="msg_save">factura creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear la factura.</p>';
				}

			}


		}

	}



 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro linea_factura</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro Factura</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				
				<label for="codfac">codigo factura</label>
				<input type="number" name="codfac" id="codfac" placeholder="codigo factura">
				<label for="fecha">Fecha compra</label>
				<input type="date" name="fecha" id="fecha" placeholder="fecha de compra">
                <p>Codigo  cliente:
                 <select name="fk_codcli" id="fk_codcli">
                 <?php
                 include "../conexion.php";
                  $query = mysqli_query($conection,"SELECT * FROM cliente");
                    while ($valores = mysqli_fetch_array($query)) {                
                   echo '<option value="'.$valores[cod_cli].'">'.$valores[cod_cli].'</option>';
                    }
                    ?>
                     </select>
                     </p>
                <label for="iva">Iva</label>
				<input type="number" name="iva" id="iva" placeholder="iva aplicado">
                <label for="dto">dto</label>
				<input type="number" name="dto" id="dto" placeholder="dto"> 
                <p>Codigo  cajero:
                 <select name="fk_cod_cajero" id="fk_cod_cajero">
                 <?php
                 include "../conexion.php";
                  $query = mysqli_query($conection,"SELECT * FROM cajero");
                    while ($valores = mysqli_fetch_array($query)) {                
                   echo '<option value="'.$valores[cod_cajero].'">'.$valores[nombre].'</option>';
                    }
                    ?>
                     </select>
                     </p>
                     <input type="submit" value="Guardar" />


			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>