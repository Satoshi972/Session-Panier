<?php
session_start();
require_once 'inc/connect.php';
if (!isset($_SESSION['is_logged']) || !$_SESSION['is_logged']) 
{
	header("Location : log_in.php");
}

$history=$bdd->prepare('SELECT ord_products FROM orders WHERE ord_usr_id= :id');
$history->bindValue(':id',$_SESSION['id'], PDO::PARAM_INT);

if($history->execute())
{
	$hist = $history->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	var_dump($history->errorInfo());
}


?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Mon compte</title>
	<?php include 'inc/head.php'; ?>
</head>
<body>
	<main class="container">
		<?php include 'inc/menu.php'; ?>
		<div class="jumbotron">
			<?php 
				foreach ($hist as $key => $value):
				var_dump($value);
				var_dump(json_decode($value));
				var_dump(json_decode(implode('<br>',$value)));
				var_dump($key[$value]);
			?>
				
					<div class="list-group-item">
						<h4 class="list-group-item-heading"></h4>
						<p class="list-group-item-text"><?php echo $value; ?></p>
					</div>	
			<?php
				endforeach;	
			?>
		</div>
	</main>
	<?php include 'inc/script.php'; ?>
</body>
</html>