<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Controleur de la page de recherche de base
 */

namespace app\controllers;


use app\core\Controller;

class Home extends Controller
{
	/**
	 * Action de base
	 * Retourne la page d'accueil du site correspondant à la page de recherche
	 */
	public function index()
	{
		$this->view('home/index');
	}
	
}