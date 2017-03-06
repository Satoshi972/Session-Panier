<?php 

session_start();
require_once'inc/connect.php';
require_once 'inc/cart_function.php';

$display = true;

if(isset($_SESSION['is_loged']) && $_SESSION['is_loged'])
{
	if(!empty($_POST) && $_POST['order'] =='order')
	{
		$commande =  implode(\n,$_SESSION['panier']['libelleProduit']);
		$commande .= implode(\n, $_SESSION['panier']['qteProduit']);
		$commande .= implode(\n, $_SESSION['panier']['prixProduit']);

		$order= $bdd->prepare('INSERT INTO orders(ord_products, ord_date, ord_usr_id) VALUES (:ord_products, now(), :ord_usr_id)'); 
		$order->bindValue(':ord_products', $commande);
		$order->bindValue(':ord_usr_id', $_SESSION['id']);
		if($order->execute())
		{
			$success = 'Commande effectuer';
			$display = false;
		}
		else
		{
			var_dump($order->errorInfo());
		}
	}
}
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Récapitulatif de la commande</title>
	<?php include 'inc/head.php'; ?>
</head>
<body>
	<main class="container">
	<?php include 'inc/menu.php'; ?>
		<div class="jumbotron">
		<?php if(isset($display) && $display): ?>
			<form method="post" action="order_list.php">
				<table class="table table-striped">
					<legend class="text-center">
						Recapitulatif
					</legend>
					<tr>
						<td>Libellé</td>
						<td>Quantité</td>
						<td>Prix Unitaire</td>
					</tr>


					<?php
					//echo implode('<br>',$_SESSION['panier']['libelleProduit']);
					//var_dump($_SESSION['panier']);
					var_dump(json_encode($_SESSION['panier']));
					die;
						$nbArticles=count($_SESSION['panier']['libelleProduit']);
						if ($nbArticles <= 0)
						echo "<tr><td>Votre panier est vide </ td></tr>";
						else
						{
							for ($i=0 ;$i < $nbArticles ; $i++)
							{
								echo "<tr>";
								echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
								echo "<td>".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."</td>";
								echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])." €</td>";
								echo "</tr>";
							}
							# htmlspecialchars doc :  http://php.net/manual/fr/function.htmlspecialchars.php
							echo "<tr><td colspan=\"2\"> </td>";
							echo "<td colspan=\"2\">";
							echo "Total : ".MontantGlobal()." €";
							echo "</td></tr>";

							echo "<tr><td>";
							echo "<a href='cart.php'><input class='btn btn-default' type=\"submit\" value=\"Annuler\"/></a>";
							#bouton pour envoyer sur mon récapitulatif de commande et valider mon achat
							echo '<a href="order_list.php"><button class="btn btn-primary">Valider</button><input type="hidden" name="order" value="order" ></a>';

							echo "</td></tr>";
						}
					?>
				</table>
			</form>
		<?php else: 
				echo $success;
		?>

		<?php endif; ?>
		</div>		
	</main>
	<?php include 'inc/script.php'; ?>
</body>
</html>