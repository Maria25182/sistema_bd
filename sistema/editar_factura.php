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
		if(empty($_POST['codfac']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

            $codfac = $_REQUEST["id"];
			$fecha= $_POST["fecha"];
			$fk_codcli = $_POST["fk_codcli"];
			$iva = $_POST["iva"];
			$dto = $_POST["dto"];
			$fk_cod_cajero = $_POST["fk_cod_cajero"];



					$sql_update = mysqli_query($conection,"UPDATE factura
															SET codfac = '$codfac',fecha='$fecha',fk_codcli='$fk_codcli',iva='$iva', dto='$dto', fk_cod_cajero='$fk_cod_cajero'
															WHERE codfac= $codfac ");
			

				if($sql_update){
					$alert='<p class="msg_save">Factura actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la factura.</p>';
				}

			


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
        
		header('Location: listar_factura.php');
		mysqli_close($conection);
	}
	$codfac= $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM factura where codfac = $codfac");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
       
        header('Location: listar_factura.php');
        
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$id = $data["codfac"];
               $fecha= $data["fecha"];
                $fk_codcli= $data["fk_codcli"]; 
                 $iva =$data["iva"]; 
                $dto =$data['dto'];
                  $fkcod_caj=$data['fk_cod_cajero'] ;
		


		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Factura</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Factura</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
            <label for="codfac">codigo factura</label>
				<input type="number" name="codfac" id="codfac" placeholder="codigo factura" value="<?php echo $codfac; ?>">
				<label for="fecha">Fecha compra</label>
				<input type="date" name="fecha" id="fecha" placeholder="fecha de compra" value="<?php echo $fecha; ?>">
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
				<input type="number" name="iva" id="iva" placeholder="iva aplicado" value="<?php echo $iva; ?>">
                <label for="dto">dto</label>
				<input type="number" name="dto" id="dto" placeholder="dto" value="<?php echo $dto; ?>"> 
                <p>Codigo  cajero:
                 <select name="fk_cod_cajero" id="fk_cod_cajero">
                 <?php
				 include "../conexion.php";
				 
                  $query = mysqli_query($conection,"SELECT * FROM cajero");
                    while ($valores = mysqli_fetch_array($query)) {                
                   echo '<option value="'.$valores[cod_cajero].'">'.$valores[cod_cajero].'</option>';
                    }
					?>
					echo $fk_cod_cajero;
                     </select>
                     </p>
			
				<input type="submit" value="Actualizar usuario" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>