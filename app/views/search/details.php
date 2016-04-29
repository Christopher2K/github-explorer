<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Affichage des informations relatives à un repository
 */

function formaterDate($date)
{
    $date = str_replace('T', ' à ', $date);
    $date = str_replace('Z', '', $date);
    return $date;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Détails : <?php echo $title ?></title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/custom3.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="container">

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/">
                    <img id="githubImg" alt="GitHub Explorer" src="/images/github.png">
                </a>
            </div>

            <p class="navbar-text">Homework GitHub Explorer for Zengularity</p>
            <div class="nav navbar-nav navbar-right">
                <form class="navbar-form" role="search" method="post" action="/">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mots clefs..." required="required" id="query" name="query" />
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3>Projet : <?php echo $data['infos']['full_name'] ?></h3>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img id="repoImg" src="<?php
                                $img = isset($data['infos']['organization']['avatar_url']) ? $data['infos']['organization']['avatar_url'] : '/images/github.png';
                                echo $img;
                                ?>" alt="Github" />
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-4 vcenter">
                                    Propriétaire : <?php echo $data['infos']['owner']['login']; ?><br />
                                    Langage : <?php echo $data['infos']['language']; ?><br />
                                    Watchers : <?php echo $data['infos']['watchers']; ?><br />
                                </div>
                                <div class="col-md-5 vcenter">
                                    Création : <?php echo formaterDate($data['infos']['created_at']); ?><br />
                                    Mis à jour : <?php echo formaterDate($data['infos']['updated_at']); ?><br />
                                </div>
                                <div class="col-md-3 vcenter">
                                    <a href="http://<?php echo $data['infos']['homepage']; ?>">Vers le site...</a><br />
                                    <a href="<?php echo $data['infos']['html_url']; ?>">Vers GitHub...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h3>Liste des <?php echo sizeof($data['contribs']); ?> commiters</h3><hr />
            </div>
        </div>

        <?php
        if (empty($data['contribs']))
        {
            ?>
            <div class="alert alert-warning">
                Pas de contributeurs pour ce projet !
            </div>
            <?php
        }
        else
        {
        ?>
        <div class="wrapper col-md-8 col-md-offset-2">
        <?php
            foreach ($data['contribs'] as $contributeur)
            {
                ?>
                <div class="well well-sm row">
                    <div class="col-md-2"> 
                        <img class="avatar" alt="avatar" src="<?php echo $contributeur['avatar_url']; ?>" /> 
                    </div> 
                    <div class="col-md-3"> Pseudo : <?php echo $contributeur['login']; ?> <br />
                        <a href="<?php echo $contributeur['login']; ?>">Profil</a>
                    </div> 
                    <div class="col-md-3"> 
                        Contributions totales : <?php echo $contributeur['contributions']; ?>
                    </div>
                </div>
                <?php
            }
        ?>
        </div>
        <?php
        }
        ?>

        <div class="row">
            <div class="col-md-6">
                <h3>Sur les 100 derniers commits...</h3><hr />
                <?php
                foreach ($data['contribs'] as $contributeur)
                {
                    if (isset($contributeur['100commits']))
                    {
                        ?>
                        <div class="col-md-12">
                            <div class="well well-sm row">
                                <div class="col-md-4"> 
                                    <img class="avatar" alt="avatar" src="<?php echo $contributeur['avatar_url']; ?>" /> 
                                </div> 
                                <div class="col-md-8"> <b><?php echo $contributeur['login']; ?></b> <br />
                                    <?php echo $contributeur['100commits']; ?> contributions sur les 100 dernières.
                                </div> 
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
