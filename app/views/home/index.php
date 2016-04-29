<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Page d'index du module de recherche avec formulaire
 */

/**
 * Cette page contient un formulaire. Afin de garder l'aspect clean URL lors de la recherche
 * on utilise une astuce qui consiste à post les données sur la même page puis rediriger
 * En fonction du résultat du formulaire
 */

if (isset($_POST['query']) && !empty($_POST['query']))
{
    //Formattage
    $query      = strtolower(htmlspecialchars($_POST['query']));
    $query      = str_replace(' ', '+', $query);
    //Redirection vers le module de recherche
    header('Location: search/result/' . $query);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>GitHub Explorer v1</title>
	<!-- Inclusion de Boostrap -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
	<!-- Feuille de style perso -->
	<link rel="stylesheet" href="css/custom.css" />
</head>
<body class="container-fluid vcenter">
	<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<div class="well well-lg">
			<h1>GitHub Explorer for Zengularity</h1>
			<form class="form-inline" method="post" action="">
				<fieldset>
					<legend>Recherche de repository</legend>
					<div class="form-group">
						<input class="form-control" type="text" placeholder="Mots clefs..." required="required" id="query" name="query" />
						<button class="btn btn-primary" type="submit">Go !</button>
					</div>
				</fieldset>
			</form>

		</div>
	</div>


	<!-- Bibliothèque JQuery -->
	<script src="scripts/jquery-2.2.2.js"></script>
	<!-- Bibliothèque Boostrap -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>