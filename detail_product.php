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
				?>
						<div class="list-group-item">
						<h4 class="list-group-item-heading">Cover</h4>
						<p class="list-group-item-text"><img class="img-responsive img-rounded" src="<?php echo $produit['pdt_picture']?>" alt="picture"></p>
						</div>	
						<div class="list-group-item">
						<h4 class="list-group-item-heading">Libelé</h4>
						<p class="list-group-item-text"><?php echo $produit['pdt_title']?></p>
						</div>	
						<div class="list-group-item">
						<h4 class="list-group-item-heading">Catégorie</h4>
						<p class="list-group-item-text"><?php echo $produit['cat_name']?></p>
						</div>	
						<div class="list-group-item">
						<h4 class="list-group-item-heading">Réfrérence</h4>
						<p class="list-group-item-text"><?php echo $produit['pdt_ref']?></p>
						</div>	
						<div class="list-group-item">
						<h4 class="list-group-item-heading">Description</h4>
						<p class="list-group-item-text"><?php echo $produit['pdt_description']?></p>
						</div>	
						<div class="list-group-item">
						<h4 class="list-group-item-heading">Prix</h4>
						<p class="list-group-item-text"><?php echo $produit['pdt_price']." €"?></p>
						</div>	
				<div class="text-center">
					<a href="list_product.php">
						<input type="sumbit" class="btn btn-default" value="Retour">
					</a>
					<a href="cart.php?action=ajout&amp;l=<?php echo $produit['pdt_title']?>&amp;q=1&amp;p=<?php echo $produit['pdt_price']?>&amps;id=<?php echo $produit['pdt_id']; ?>" return false;">
						<button class="btn btn-info">Ajouter au panier</button>
					</a>
					<!--
					<a href="cart.php?action=ajout&amp;l=LIBELLEPRODUIT&amp;q=QUANTITEPRODUIT&amp;p=PRIXPRODUIT" onclick="window.open(this.href, '', 'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">
						<button class="btn btn-info">Ajouter au panier</button>
					</a>
					-->
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