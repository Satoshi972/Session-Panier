<?php 

 if ($_GET['lang']=='fr') 
 {// si la langue est 'fr' (français) on inclut le fichier fr-lang.php
	include'lang/fr-lang.php';
}

else if ($_GET['lang']=='en') 
{ 
	include'lang/lang-en.php'; 
}

else 
{      
	include'lang/lang_fr.php';
}
?>