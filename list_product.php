<?php 
require_once 'inc/connect.php';

$list = $bdd->prepare('SELECT * FROM products P, category C WHERE P.pdt_cat_id = C.cat_id');
if($list->execute())
{
	$list->fetchAll(PDO::FETCH_ASSOC);
	var_dump($list);
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
			<table>
			<thead>
				
			</thead>
				<tbody>
					<?php
						foreach ($list as $key => $value):
					?>
						<tr>
							
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