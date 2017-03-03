<?php
	session_start();
	require_once 'inc/connect.php';

	if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$idGet = (int)$_GET['id'];
		$select = $bdd->prepare('SELECT * FROM products, category WHERE pdt_cat_id = cat_id AND pdt_id= :id');
		$select ->bindValue(':id',$idGet,PDO::PARAM_INT);

		if($select->execute())
		{
			$produit = $select->fetch(PDO::FETCH_ASSOC);
			var_dump($produit);
		}
		else 
		{
			var_dump($select->errorInfo());
		}
	}
	else
	{
		$errors = 'Produit non trouvé';
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Détail</title>
	<?php include('inc/head.php');?>
</head>
<body>
	<main class="container">
	<?php 
		include('inc/menu.php');
	?>
		<div class="jumbotron">
			<?php
			if (isset($errors)) 
			{
				echo $errors;
			}
			if(isset($produit)):
				foreach($produit as $key => $value):
					if(!$key=='pdt_id'):
				?>
						<div class="list-group-item">
						<h4 class="list-group-item-heading"><?php echo $key?></h4>
						<p class="list-group-item-text"><?php echo $value?></p>
						</div>	
				<?php
				endif;
				endforeach;
				?>
				<div class="text-center">
					<a href="list.php">
						<input type="sumbit" class="btn btn-default" value="Retour">
					</a>
					<a href="">
						<button class="btn btn-info">Ajouter au panier</button>
					</a>
				</div>
				<?php
			endif;
				?>
			</div>
	</main>
	<?php include('inc/script.php');?>
	<script>
		$(function()

		);
	</script>
</body>
</html>