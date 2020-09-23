		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
			<?php 
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">

					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php">Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>
			<?php 

				if($_SESSION['rol'] == 4 OR $_SESSION['rol'] == 1 OR $_SESSION['rol'] == 2 OR $_SESSION['rol'] == 3 ){
			 ?>
				<li class="principal">
					<a href="#">Factura</a>
					<ul>
					<?php 
				if ( $_SESSION['rol'] == 4  OR $_SESSION['rol'] == 1 ){
			 ?>
					<li><a href="registrar_factura.php">Nuevo Factura</a></li>
					<?php } ?>
						<li><a href="listar_factura.php">Lista de Factura</a></li>
					
				
				</ul>
				</li>
				<?php } ?>

				<?php 

				if($_SESSION['rol'] == 4 OR $_SESSION['rol'] == 1 OR $_SESSION['rol'] == 2 OR $_SESSION['rol'] == 3 ){
			 ?>
				<li class="principal">
					<a href="#">Linea Factura</a>
					<ul>
					<?php 
				if ( $_SESSION['rol'] == 4  OR $_SESSION['rol'] == 1   ){
			 ?>
					<li><a href="registrar_linea_factura.php">Nueva linea factura</a></li>
					<?php } ?>
						<li><a href="listar_linea_factura.php">Lista de linea factura</a></li>
						
					</ul>
				</li>
				<?php } ?>

				<?php 
				if ( $_SESSION['rol'] == 4  OR $_SESSION['rol'] == 1  OR $_SESSION['rol'] == 3 ){
			 ?>
				
				<li class="principal">
					<a href="#">Clientes</a>
					<ul>
					<?php 
				if ( $_SESSION['rol'] == 4  OR $_SESSION['rol'] == 1  ){
			 ?>
						<li><a href="registrar_cliente.php">Nuevo Cliente</a></li>
						<?php } ?>
						<li><a href="listar_clientes.php">Lista de Clientes</a></li>
					</ul>
				</li>
				<?php }
				if ( $_SESSION['rol'] == 4  OR $_SESSION['rol'] == 1 OR $_SESSION['rol'] == 3 ){
			 ?>
				
				<li class="principal">
					<a href="#">Articulos</a>
					<ul>
					<?php 
				if ( $_SESSION['rol'] == 4  OR $_SESSION['rol'] == 1   ){
			 ?>
						<li><a href="#">Nuevo Articulo</a></li>
						<?php } ?>
						
						<li><a href="listar_articulos.php">Listar articulos</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</nav>

		