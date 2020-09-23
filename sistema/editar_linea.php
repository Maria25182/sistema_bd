<?php 
	
	session_start();
	if($_SESSION['rol'] != 2)
	{
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['fk_codfac']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $fk_codfac = $_REQUEST["id"];
			$linea = $_POST["linea"];
			$cant = $_POST["cant"];
			$precio = $_POST["precio"];
			$dto = $_POST["dto"];
			$fk_codart = $_POST["fk_codart"];



					$sql_update = mysqli_query($conection,"UPDATE linea_fac
															SET fk_codfac = '$fk_codfac',linea='$linea',cant='$cant',precio='$precio', dto='$dto', fk_codart='$fk_codart'
															WHERE fk_codfac= $fk_codfac ");
			

				if($sql_update){
					$alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

			


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
        
		header('Location: listar_linea_factura.php');
		mysqli_close($conection);
	}
	$fk_codfac= $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM linea_fac where fk_codfac = $fk_codfac");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
       
        header('Location: listar_linea_factura.php');
        
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$fk_codfac = $data["fk_codfac"];
               $linea= $data["linea"];
                $cant= $data["cant"]; 
                 $precio =$data["precio"]; 
                $dto =$data['dto'];
                  $fkcod_art =$data['fk_codart'] ;

		


		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar linea</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar linea</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
            <p>Codigo factura:
     fk_codfac <select name="fk_codfac" id= "fk_codfac">
    <?php
	include "../conexion.php";
      	$query = mysqli_query($conection,"SELECT * FROM factura");
                    
                    while ($valores = mysqli_fetch_array($query)) {
                                            
                   echo '<option value="'.$valores[codfac].'">'.$valores[codfac].'</option>';
                    }
                    ?>
                    </select>
    			</p>

				<label for="linea">linea factura</label>
				<input type="number" name="linea" id="linea" placeholder="linea factura" value="<?php echo $linea; ?>">
				<label for="cantidad">cant</label>
				<input type="number" name="cant" id="cant" placeholder="cantidad" value="<?php echo $cant; ?>">
				<label for="precio">precio</label>
				<input type="decimal" name="precio" id="precio" placeholder="precio" value="<?php echo $precio; ?>">
				<label for="dto">dto</label>
				<input type="number" name="dto" id="dto" placeholder="dto" value="<?php echo $dto; ?>">
				<p>Codigo Articulo:
     			fk_codart <select name="fk_codart" id="fk_codart">
   			<?php
			include "../conexion.php";
			$query = mysqli_query($conection,"SELECT * FROM articulo");
                    
                    while ($valores = mysqli_fetch_array($query)) {
                                            
                   echo '<option value="'.$valores[codart].'">'.$valores[codart].'</option>';
                    }
                    ?>
                    </select>
    </p>

				
			
				<input type="submit" value="Actualizar usuario" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>