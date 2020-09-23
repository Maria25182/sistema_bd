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
		if(empty($_POST['cant']) || empty($_POST['linea']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$fk_codfac = $_POST["fk_codfac"];
			$linea = $_POST["linea"];
			$cant = $_POST["cant"];
			$precio = $_POST["precio"];
			$dto = $_POST["dto"];
			$fk_codart = $_POST["fk_codart"];

			
		   

		
			$query = mysqli_query($conection,"SELECT * FROM linea_fac where linea='$linea'");
			$result = mysqli_fetch_array($query);

			

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO linea_fac (fk_codfac, linea, cant,precio,dto,fk_codart) 
				VALUES ('$fk_codfac', '$linea', '$cant','$precio','$dto','$fk_codart')");

				if($query_insert){
					$alert='<p class="msg_save">linea creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear la factura.</p>';
				}

			}


		}

	}



 ?>

<!DOCTYPE html>
<html lang="ES">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro linea_factura</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro Linea factura</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				
			
     Codigo de la factura:  <select name="fk_codfac" id= "fk_codfac">
    <?php
	include "../conexion.php";
      	$query = mysqli_query($conection,"SELECT * FROM factura");
                    
                    while ($valores = mysqli_fetch_array($query)) {
                                            
                   echo '<option value="'.$valores[codfac].'">'.$valores[codfac].'</option>';
                    }
                    ?>
                    </select>
 

				<label for="linea">linea factura</label>
				<input type="number" name="linea" id="linea" placeholder="linea factura">
				<label for="cantidad">Cantidad: </label>
				<input type="number" name="cant" id="cant" placeholder="cantidad">
				<label for="precio">Precio : </label>
				<input type="decimal" name="precio" id="precio" placeholder="precio">
				<label for="dto">Descuento Aplicado:</label>
				<input type="number" name="dto" id="dto" placeholder="dto">
				<p>Codigo Articulo:
     	 <select name="fk_codart" id="fk_codart">
    <?php
	include "../conexion.php";
	$query = mysqli_query($conection,"SELECT * FROM articulo");
                    
                    while ($valores = mysqli_fetch_array($query)) {
                                            
                   echo '<option value="'.$valores[codart].'">'.$valores[codart].'</option>';
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