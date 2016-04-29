<?php
/**
 * Auteur:  christopher
 * Date:    26/04/16
 * Objet:
 */

namespace app\models;



use Github\ResultPager;

class PaginatorGithub
{
	/**
	 * Retourne une instance du paginator avec l'API spéficiée
	 * @param $api
	 * @return ResultPager
	 */
	public static function getPaginator($client)
	{
		return new ResultPager($client);
	}
}