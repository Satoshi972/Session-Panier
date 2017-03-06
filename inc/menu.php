<nav class="navbar navbar-toggleable-md navbar-inverse text-center">
	<ul class="nav navbar-nav text-center">
	<?php 
		if(!isset($_SESSION['is_loged']) || !$_SESSION['is_loged']):
	?>	
		<li><a href="suscribe.php">Inscription</a></li>
		<li><a href="log_in.php">Connexion</a></li>
	<?php 
		endif;
	?>	
		<li><a href="create_product.php">Nouveau produit</a></li>
		<li><a href="list_product.php">Liste de produit</a></li>
		<li><a href="cart.php">Panier</a></li>
	<?php 
		if(isset($_SESSION['is_loged']) && $_SESSION['is_loged']):
	?>
		<li><a href="log_out.php">Déconnexion</a></li>
	<?php
		endif;
	?>
	</ul>
</nav>