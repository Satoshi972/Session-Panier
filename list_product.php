<?php 
require_once 'inc/connect.php';

$list = $bdd->prepare('SELECT * FROM products, category WHERE pdt_cat_id = cat_id');
if($list->execute())
{
	$res = $list->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	var_dump($list->errorInfo());
}

?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>liste des produits</title>
	<?php include 'inc/head.php' ;?>
</head>
<body>
	<main class="container">
	<?php 
		include 'inc/menu.php';
	?>
		<div class="jumbotron">
			<table class="table table-striped">
			<thead>
				<th>Libéllé</th>
				<th>Catégorie</th>
				<th></th>
			</thead>
				<tbody>
					<?php
						foreach ($res as $key => $value):
					?>
						<tr>
							<td><?php echo $value['pdt_title'];?></td>
							<td><?php echo $value['cat_name'];?></td>
							<td><a href="detail_product.php?id=<?php echo $value['pdt_id'];?>">Voir plus...</a></td>
						</tr>
					<?php
						endforeach;
					?>
				</tbody>
			</table>
		</div>
	</main>
	<?php include 'inc/script.php' ;?>
</body>
</html>