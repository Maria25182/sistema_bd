<?php 

	if(empty($_SESSION['active']))
	{
		header('location: ../');
	}
 ?>
	<header>
		<div class="header">
			
			<h1>Sistema Supermercados</h1>
			<div class="optionsBar">
				<p>Colombia,Manizales <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].' - '.$_SESSION['rol']; ?></span>
				<?php
				if($_SESSION['rol'] == 4){
					echo '<img class="photouser" src="../img/cajero.png" alt="Usuario">';
				}
				
				if($_SESSION['rol'] == 1){
					echo '<img class="photouser" src="img/user.png" alt="Usuario">';
				}
			
				if($_SESSION['rol'] == 2){
					echo '<img class="photouser" src="../img/supervisor.png" alt="Usuario">';
				}
				?>
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
	</header>