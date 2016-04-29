<?php
/**
 * Auteur:  christopher
 * Date:    26/04/16
 * Objet:   Utilisation du pattern singleton pour l'appel à la librarie GitHub
 */

namespace app\models;


use Github\Client;

class ClientGithub
{
	/**
	 * Retourne une instance du client GitHub 
	 * @return Client
	 */
	public static function getGithubClient()
	{
		return new Client();
	}
}