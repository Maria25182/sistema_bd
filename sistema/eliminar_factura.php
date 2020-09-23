<?php 
	session_start();
	if($_SESSION['rol'] != 2)
	{
		header("location: ./");
	}
    include "../conexion.php";
    
	if(!empty($_POST))
	{
		if($_POST['id'] == 1){
			header("location: lista_linea_factura.php");
			mysqli_close($conection);
			exit;
		}
	$fk_codfac = $_GET["id"];
	

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"DELETE from  factura  WHERE odfac = $codfac ");
		mysqli_close($conection);
		if($query_delete){
			header("location: listar_factura.php");
		}else{
			echo "Error al eliminar";
		}

    }




	if(empty($_REQUEST['id'])  )
	{
		header("location: listar_factura.php");
		mysqli_close($conection);
	}else{

		$id = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT * 
												FROM factura where
                                                codfac = $id")
												;
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);







		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
              $id = $data["codfac"];
               $fecha= $data["fecha"];
                $fk_codcli= $data["fk_codcli"]; 
                 $iva =$data["iva"]; 
                $dto =$data['dto'];
                  $fkcod_caj=$data['fk_cod_cajero'] ;
			}
		}else{
			header("location: listar_factura.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Eliminar Factura</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="data_delete">
            <h2>¿Está seguro de eliminar el siguiente registro?</h2>
            <p>Codigo factura: <span><?php echo $id; ?></span></p>
            <p>Fecha compra: : <span><?php echo $fecha; ?></span></p>
            <p>Codigo del cliente: : <span><?php echo $fk_codcli; ?></span></p>
            <p>IVA : <span><?php echo $iva; ?></span></p>
            <p>descuento : <span><?php echo $dto; ?></span></p>
            <p>Codigo Cajero: <span><?php echo $fkcod_caj; ?></span></p>


            <form method="post" action="">
                <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                <a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>


    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>