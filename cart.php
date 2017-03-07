<?php 
session_start();

require_once 'inc/connect.php';
require_once 'inc/cart_function.php';


$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   $id = (isset($_POST['id'])? $_POST['id']:  (isset($_GET['id'])? $_GET['id']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   $id = (int)$id;

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q))
   {
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu)
      {
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur)
{
   switch($action)
   {
      Case "ajout":
         ajouterArticle($l,$q,$p,$id);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Panier</title>
	<?php include 'inc/head.php' ;?>
</head>
<body>
	<main class="container">
		<?php include 'inc/menu.php' ;?>
		<div class="jumbotron">
				
				<form method="post" action="cart.php">
					<table class="table table-striped">
						<tr>
							<td colspan="4">Votre panier</td>
						</tr>
						<tr>
							<td>Libellé</td>
							<td>Quantité</td>
							<td>Prix Unitaire</td>
							<td>Action</td>
						</tr>


						<?php
						if (creationPanier())
						{
							$nbArticles=count($_SESSION['panier']['libelleProduit']);
							if ($nbArticles <= 0)
							echo "<tr><td>Votre panier est vide </ td></tr>";
							else
							{
								for ($i=0 ;$i < $nbArticles ; $i++)
								{
									echo "<tr>";
									echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
									echo "<td><input type=\"number\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
									echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
									echo "<td><a href=\"".htmlspecialchars("cart.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">Supprimer</a></td>";
									echo "</tr>";
								}
								# htmlspecialchars doc :  http://php.net/manual/fr/function.htmlspecialchars.php
								echo "<tr><td colspan=\"2\"> </td>";
								echo "<td colspan=\"2\">";
								echo "Total : ".MontantGlobal();
								echo "</td></tr>";

								echo "<tr><td colspan=\"4\">";
								echo "<input type=\"submit\" class='btn btn-default' value=\"Rafraichir\"/>";
								echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
								if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'])
								{
								#bouton pour envoyer sur mon récapitulatif de commande et valider mon achat
								echo '<a href="order.php"><input type="button" class="btn btn-primary" value="Commander"></a>';
								}
								else
								{
									echo '<a href="log_in.php">';
									echo "<button class='btn btn-info'>Connectez vous pour finaliser l'achat</button>";
									echo '</a>';
								}
								echo "</td></tr>";
							}
						}
						?>
					</table>
				</form>
		</div>
	</main>
	<?php include 'inc/script.php' ;?>
</body>
</html>