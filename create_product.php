<?php 

require_once 'inc/connect.php';

#fonction pour calculer le ttc
function ttc($ht,$tva)
{
	return $ttc = $ht * $tva + $ht;
}


#définition de quelques variabl pour gerer les images
$maxSize = (1024 * 1000) * 2; // Taille maximum du fichier
$uploadDir = 'uploads/'; // Répertoire d'upload
$mimeTypeAvailable = ['image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];

#variable pour gerer le formulaire
$post = [];
$errors = [];

#requette de selection pour l'affichage des catégorie
$category = $bdd->prepare('SELECT * FROM category');

if($category->execute())
{
	$cat = $category->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	var_dump($category->errorInfo());
}

#verification de mes données
if(!empty($_POST))
{
	$post = array_map('trim', array_map('strip_tags', $_POST)); //equivalent du foreach pour nettoyage

	if(strlen($post['title']) <3)
	{
		$error[] = 'Le libellé est trop court';
	}
	if(strlen($post['description'])<10)
	{
		$error[] = 'La description doit faire 10 miniutes';
	}
	if(!is_numeric($post['ht']) || $post['ht'] < 0)
	{
		$error[] = 'Le prix doit être indiqué';
	}
	if(!is_numeric($post['tva']) || $post['tva'] < 0 ||$post['tva'] > 1)
	{
		$error[] = 'La tva doit être indiqué';
	}
	if(!is_numeric($post['category']) || $post['category'] < 0)
	{
		$error[] = 'La tva doit être indiqué';
	}

	if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0)
	{

		$finfo = new finfo(); //déclaration d'un objet de type finfo
		$mimeType = $finfo->file($_FILES['picture']['tmp_name'], FILEINFO_MIME_TYPE); // récuperation du type mime du fichier, cette façon de faire est la plus sécure

		$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);//Récuperer l'extension du ficher grace au path info

		if(in_array($mimeType, $mimeTypeAvailable))
		{
			if($_FILES['picture']['size'] <= $maxSize)
			{
				if(!is_dir($uploadDir))
				{
					mkdir($uploadDir, 0755);//création du dossier via le CHmod, permet d'avoir les droit d'ecriture
				}

				$newPictureName = uniqid('picture_').'.'.$extension;//changeent du nom du fichier avec le prefixe avatar et lui donnant un id unique. Adie les remplacement

				if(!move_uploaded_file($_FILES['picture']['tmp_name'], $uploadDir.$newPictureName))
				{
					$errors[] = 'Erreur lors de l\'upload de la photo';
				}
			}

			else 
			{
				$errors[] = 'La taille du fichier excède 2 Mo';
			}
		}

		else 
		{
			$errors[] = 'Le fichier n\'est pas une image valide';
		}
	}
	else 
	{
		$errors[] = 'Erreur d\'envoi du fichier';
	}

	if(!is_numeric($post['category']))
	{
		$errors[] = 'La catégorie doit être indiqué';
	}
	
	#s'il n'y a pas d'erreur
	if(count($errors) === 0)
	{
		$insert = $bdd->prepare('INSERT INTO products (pdt_title, pdt_description, pdt_ref, pdt_ht, pdt_tva, pdt_price, pdt_picture, pdt_cat_id) VALUES(:pdt_title, :pdt_description, :pdt_ref, :pdt_ht, :pdt_tva, :pdt_price,  :pdt_picture, :pdt_cat_id)');
		$insert->bindValue(':pdt_title',$post['title']);
		$insert->bindValue(':pdt_description',$post['description']);
		$insert->bindValue(':pdt_ref',$post['ref']);
		$insert->bindValue(':pdt_ht',$post['ht']);
		$insert->bindValue(':pdt_tva',$post['tva']);
		$insert->bindValue(':pdt_price',ttc($post['ht'],$post['tva']));
		$insert->bindValue(':pdt_picture',$uploadDir.$newPictureName);
		$insert->bindValue(':pdt_cat_id',$post['category'],PDO::PARAM_INT);

		if($insert->execute())
		{
			header('Location: list_product.php');
		}
		else
		{
			var_dump($insert->errorInfo());
		}
	#sinon affiche les erreurs
	}
	else
	{
		$textError = implode('<p class="alert alert-danger">', $errors);
	}
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

			<legend class="text-center">Nouveau produit</legend>

			<?php if(isset($textError)){echo $textError;} ?>

			<div class="form-group">
				<label for="title">Libellé du produit</label>
				<input type="text" name="title" id="title" class="form-control">
			</div>

			<div class="form-group">
				<label for="description">Description du produit</label>
				<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
			</div>

			<div class="form-group">
				<label for="ref">Référence du produit</label>
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
					<option value="0.05">5%</option>
					<option value="0.1">10%</option>
					<option value="0.2">20%</option>
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
						<option value="<?php echo $value['cat_id'];?>"> <?php echo $value['cat_name']?></option>
					<?php
					endforeach;
				?>

				</select>
				
			</div>

			<div class="text-center">
				<input type="submit" value="Stocker" class="btn btn-primary">
			</div>
		</form>

	</main>
	<?php include 'inc/script.php';?>
</body>
</html>

