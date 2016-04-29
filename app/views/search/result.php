<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Affichage d'une recherche des repository PHP avec pagination
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GitHub : <?php echo $title; ?></title>
    <!-- Inclusion de Boostrap -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
    <!-- Feuille de style perso -->
    <link rel="stylesheet" href="/css/custom2.css" />
</head>
<body class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/">
                    <img id="githubImg" alt="GitHub Explorer" src="/images/github.png">
                </a>
            </div> <!-- navbar-header -->

            <p class="navbar-text">Homework GitHub Explorer for Zengularity</p>
            <div class="nav navbar-nav navbar-right">
                <form class="navbar-form" role="search" method="post" action="/">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mots clefs..." required="required" id="query" name="query" />
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div><!-- navbar-nav -->
        </div> <!-- container -->
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Résultats de la recherche</h1>
                <hr />
            </div>
        </div>

        <?php
        if (empty($data[1]))
        {
            ?>
            <div class="alert alert-warning">
                Pas de résultats pour la requête précédente !
            </div>
            <?php
        }
        else {
            foreach ($data[1] as $repo) {
                ?>
                <div class="well well-sm row">
                    <div class="titre col-md-2">
                        <?php echo $repo['name']; ?>
                    </div>
                    <div class="auteur col-md-2">
                        <?php echo $repo['owner']['login']; ?>
                    </div>
                    <div class="description col-md-6">
                        <?php echo $repo['description']; ?>
                    </div>
                    <div class="lien col-md-2">
                        <a href="/search/details/<?php echo $repo['full_name'] ?>">Voir les
                            détails</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <hr />
        <?php
        if (sizeof($data) > 1 && $data[0] > 1)
        {
            ?>
            <ul class="pagination pagination-sm">
                <?php
                for($i = 1; $i <= $data[0]; $i++)
                {
                    if ($data[2] == $i)
                    {
                        ?>
                        <li class="active"><a href="/search/result/<?php echo $title . '/'. $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="/search/result/<?php echo $title . '/'. $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
            <?php
        }
        ?>

    </div>
    <!-- Bibliothèque JQuery -->
    <script src="/scripts/jquery-2.2.2.js"></script>
    <!-- Bibliothèque Boostrap -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
