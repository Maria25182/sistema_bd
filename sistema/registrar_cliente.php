<?php
session_start();
if ($_SESSION['rol'] != 4 AND $_SESSION['rol'] != 2 AND $_SESSION['rol'] == 3) {
    header("location: ./");
}

include "../conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['cod_cli'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $cod_cli = $_POST["cod_cli"];
        $nombre_cli = $_POST["nombre_cli"];
        $direccion_cli = $_POST["direccion_cli"];
        $telefono_cli = $_POST["telefono_cli"];
        $genero = $_POST["genero"];
        $fecha_nacimiento_cli = $_POST["fecha_nacimiento_cli"];
        $corre_cli = $_POST["corre_cli"];
        $fk_cod_barrio = $_POST["fk_cod_barrio"];



        $query = mysqli_query($conection, "SELECT * FROM cliente where cod_cli='$cod_cli'");
        $result = mysqli_fetch_array($query);



        if ($result > 0) {
            $alert = '<p class="msg_error">El cliente ya existe.</p>';
        } else {

            $query_insert = mysqli_query($conection, "INSERT INTO cliente (cod_cli, nombre_cli,direccion_cli, telefono_cli,genero, fecha_nacimiento_cli,corre_cli,fk_cod_barrio) 
				VALUES ('$cod_cli', '$nombre_cli', '$direccion_cli','$telefono_cli','$genero','$fecha_nacimiento_cli','$corre_cli','$fk_cod_barrio')");

            if ($query_insert) {
                $alert = '<p class="msg_save">cliente creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al crear el cliente.</p>';
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
    <title>Registro Cliente</title>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">
            <h1>Registro Cliente</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="post">

                <label for="cod_cli">Codigo del cliente : </label>
                <input type="number" name="cod_cli" id="cod_cli" placeholder="codigo cliente">
                <label for="nombre_cli">Nombre del cliente: </label>
                <input type="text" name="nombre_cli" id="nombre_cli" placeholder="Nombre del cliente">
                <label for="direccion_cli">Dirección residencia :</label>
                <input type="text" name="direccion_cli" id="direccion_cli" placeholder="Dirección de residencia">
                <label for="telefono_cli">Telefono del cliente :</label>
                <input type="number" name="telefono_cli" id="telefono_cli" placeholder="Telefono del cliente">
                <p> Genero:
                <select name="genero">
                    <option value="F">F</option>
                    <option value="M" selected>M</option>
                </p>
                </select>
                <label for="fecha_nacimiento_cli">Fecha de nacimiento :</label>
                <input type="date" name="fecha_nacimiento_cli" id="fecha_nacimiento_cli" placeholder="Fecha De Nacimiento">
                <label for="corre_cli">Correo del Cliente :</label>
                <input type="text" name="corre_cli" id="corre_cli" placeholder="Correo del cliente">
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
                <input type="submit" value="Guardar" />


            </form>


        </div>


    </section>
    <?php include "includes/footer.php"; ?>
</body>

</html>