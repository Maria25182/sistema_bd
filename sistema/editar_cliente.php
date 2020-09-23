<?php 
	
	session_start();
	if($_SESSION['rol'] != 4)
	{
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre_cli']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

           
        $cod_cli = $_REQUEST["id"];
        $nombre_cli = $_POST["nombre_cli"];
        $direccion_cli = $_POST["direccion_cli"];
        $telefono_cli = $_POST["telefono_cli"];
        $corre_cli = $_POST["corre_cli"];
        $fk_cod_barrio = $_POST["fk_cod_barrio"];



					$sql_update = mysqli_query($conection,"UPDATE cliente
															SET nombre_cli='$nombre_cli',direccion_cli='$direccion_cli',telefono_cli='$telefono_cli', 
                                                            corre_cli ='$corre_cli', fk_cod_barrio='$fk_cod_barrio'
															WHERE cod_cli= $cod_cli ");
			

				if($sql_update){
					$alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el cliente.</p>';
				}

			


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
        
		header('Location: listar_clientes.php');
		mysqli_close($conection);
	}
	$cod_cli= $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM cliente where cod_cli = $cod_cli");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
       
        header('Location: listar_clientes.php');
        
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$id = $data["cod_cli"];
             $nombre_cli= $data["nombre_cli"];
            $direccion_cli= $data["direccion_cli"]; 
             $telefono_cli =$data["telefono_cli"]; 
            $corre_cli=$data['corre_cli'] ;
            $fk_cod_barrio=$data['fk_cod_barrio'] ;


		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Cliente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
           
                <label for="nombre_cli">Nombre del cliente: </label>
                <input type="text" name="nombre_cli" id="nombre_cli" placeholder="Nombre del cliente"value="<?php echo $nombre_cli; ?>">
                <label for="direccion_cli">Dirección residencia :</label>
                <input type="text" name="direccion_cli" id="direccion_cli" placeholder="Dirección de residencia" value="<?php echo $direccion_cli; ?>">
                <label for="telefono_cli">Telefono del cliente :</label>
                <input type="tel" name="telefono_cli" id="telefono_cli" placeholder="Telefono del cliente" value="<?php echo $telefono_cli; ?>">
            
                <label for="corre_cli">Correo del Cliente :</label>
                <input type="text" name="corre_cli" id="corre_cli" placeholder="Correo del cliente" value="<?php echo $corre_cli; ?>">
                <p> Nombre Del barrio:
                    <select name="fk_cod_barrio" id="fk_cod_barrio">
                        <?php
                        include "../conexion.php";
                        $query = mysqli_query($conection, "SELECT * FROM barrio");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores[cod_barrio] . '">' . $valores[nombre_barrio] . '</option>';
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