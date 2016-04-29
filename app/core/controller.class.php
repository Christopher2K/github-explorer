<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Controlleur de base
 */

namespace app\core;


class Controller
{
	/**
	 * Retourne une instance du model demandé par le controlleur
	 * => Non utilisée ici
	 * @param $model
	 * @return mixed
	 */
	public function model($model)
	{
		require_once '../app/models/' . $model . '.class.php' ;
		$object = '\app\models\\' . ucfirst($model);
		return new $object();
	}


	/**
	 * Retourne une vue avec les paramètres spécifié
	 * @param $view             Nom de la vue
	 * @param string $title     Titre de la vue
	 * @param array $data       Données que la vue doit afficher
	 */
	public function view($view, $title = '', $data = [])
	{
		require_once '../app/views/' . $view . '.php';

	}

}