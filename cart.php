<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panier</title>
	<?php include 'inc/head.php' ;?>
</head>
<body>
	<main class="container">
		<?php include 'inc/menu.php' ;?>
		<div class="jumbotron">
				<div class="text-center">
					<a href="delete.php?id=<?php echo $idGet;?>">
					<input type="submit" class="btn btn-danger" value="supprimer" onclick="delete($getId)">
					</a>
					<a href="update.php?id=<?php echo $idGet;?>"">
						<input type="sumbit" class="btn btn-primary" value="Modifier">
					</a>
					<a href="list.php">
						<input type="sumbit" class="btn btn-default" value="Retour">
					</a>
					<a href="">
						<button class="btn btn-info">Ajouter au panier</button>
					</a>
				</div>
		</div>
	</main>
	<?php include 'inc/script.php' ;?>
</body>
</html>