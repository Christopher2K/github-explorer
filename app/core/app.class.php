<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Classe de l'applicaton lancée
 */

namespace app\core;


class App
{
	/*
	 * ATTRIBUTS DE CLASSE PAR DÉFAUT
	 */
	protected $controller = 'home';
	protected $method     = 'index';
	protected $param      = [];


	/**
	 * Lancement de l'application à chaque nouvelle requête HTTP
	 * 1 Découpage de l'URL
	 * App constructor.
	 */
	public function __construct()
	{
		$url = $this->parseUrl();

		//Test si le controleur existe
		if (file_exists('../app/controllers/' . $url[0] . '.class.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}

		//Chargement du controleur
		require_once '../app/controllers/' . $this->controller . '.class.php';
		$controller = '\app\controllers\\'. ucfirst($this->controller);
		$this->controller = new $controller;

		//Test si la méthode spécifiée dans le controleur existe
		if (isset($url[1]))
		{
			//Affectation de la méthode
			if (method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		//Affectation des parametres
		$this->params = $url ? array_values($url) : [] ;

		//Appel de la méthode correspondant à l'action
		call_user_func_array([$this->controller, $this->method], $this->params);

	}

	/**
	 * Formate l'URL sous forme de tableau dont le premier élément est le controleur et le second la méthode.
	 * Les autres éléments seront considérés comme des paramètres
	 * @return mixed
	 */
	public function parseUrl()
	{
		if (isset($_GET['url']))
		{
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

		}
	}
}