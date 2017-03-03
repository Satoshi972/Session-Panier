<?php 

require_once 'inc/connect.php';

$category = $bdd->prepare('SELECT * FROM category');
if($category->execute())
{
	$cat = $category->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	var_dump($category->errorInfo());
}


?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Création de produit</title>
	<?php include 'inc/head.php';?>
</head>
<body>
	<main class="container">
		<?php include 'inc/menu.php';?>
	
		<form method="post" class="form-horizontal jumbotron" enctype="multipart/form-data">
			<div class="form-group">
				<label for="title">Libéllé du produit</label>
				<input type="text" name="title" id="title" class="form-control">
			</div>

			<div class="form-group">
				<label for="description">Description du produit</label>
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
			</div>

			<div class="form-group">
				<label for="ref">Référence du prodduit</label>
				<input type="text" name="ref" id="ref" class="form-control">
			</div>

			<div class="form-group">
				<label for="ht">Prix hors taxes</label>
				<input type="text" name="ht" id="ht" class="form-control">
			</div>


			<div class="form-group">
			<label for="tva">Choix de TVA</label>
				<select name="tva" id="tva" class="selectpicker">
					<option>---Sélectionnez un taux---</option>
					<option value="5.5">5%</option>
					<option value="10">10%</option>
					<option value="20">20%</option>
				</select>
			</div>
			
			<div class="form-group">
				<label for="picture">Photo du produit</label>
				<input type="file" name="picture" id="picture">
			</div>

			<div class="form-group">
				<label for="category">Catégorie du produit</label>
				<select name="category" id="category" class="selectpicker">
				<option>---Sélectionnez un type---</option>
				<?php 
					foreach ($cat as $key=> $value):
					?>
						<option value="<?php echo $key['cat_id'];?>"> <?php echo $value['cat_name']?></option>
					<?php
					endforeach;
				?>

				</select>
				
			</div>

			<div class="text-center">
				<input type="sumbit" value="Stocker" class="btn btn-primary">
			</div>
		</form>

	</main>
	<?php include 'inc/script.php';?>
</body>
</html>

