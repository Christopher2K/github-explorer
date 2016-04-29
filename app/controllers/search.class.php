<?php
/**
 * Auteur:  christopher
 * Date:    25/04/16
 * Objet:   Module de recherche de repository
 */

namespace app\controllers;


use app\core\Controller;
use app\models\ClientGithub;
use app\models\PaginatorGithub;

class Search extends Controller
{
	/**
	 * Action permettant de lister les resultats de la recherche selon la requete et la page
	 * 50 résultats par pages
	 * @param string $query
	 * @param int $page
	 */
	public function result($query = ' ', $page = 1)
	{
		/*
		 * Utilisation de la librairie GitHub
		 */
		$query = str_replace('+', ' ', $query);
		//Récupération des résultats
		$client     = ClientGithub::getGithubClient();
		$search     = $client->api('search');
		$result     = PaginatorGithub::getPaginator($client)->fetchAll($search, 'repositories', array($query));

		//Mise en forme de la pagination
		$pagination = ceil(sizeof($result) / 50);
		$display    = [];

		if ($page <= $pagination){
			$start = $page * 50 - 50;
			$end   = $page == $pagination ? sizeof($result) : $page * 50;
			for ($i = $start; $i < $end; $i++)
			{
				$display[] = $result[$i];
			}

			//Formatage et envoie des données à la page
			$data = array($pagination, $display, $page);
			$this->view('search/result', $query, $data);
		}
		else
		{
			$data = [];
			$this->view('search/result', $query, $data);
		}
	}

	/**
	 * Action permettant de récupérer des informations sur un repository en particulier
	 * @param $username
	 * @param $name
	 */
	public function details($username, $name)
	{
		/*
		 * Récupération des informations à afficher
		 */
		$informations   = ClientGithub::getGithubClient()->api('repo')->show($username, $name);
		$client         = ClientGithub::getGithubClient();
		$repository     = $client->api('repo');
		$contributors   = PaginatorGithub::getPaginator($client)->fetchAll($repository, 'contributors', array($username, $name));

		$commit        = $repository->commits();
		$commit->setPerPage(100);
		$commits       = PaginatorGithub::getPaginator($client)->fetch($commit, 'all', array($username, $name, array('sha' => 'master')));

		/*
		 * Mise en forme des résultats
		 */
		$lastCommits    = [];
		$countCommits   = [];
		if (sizeof($commits) < 100)
		{
			for ($i = 0 ; $i < sizeof($commits); $i++)
			{
				$lastCommits[] = $commits[$i];
			}
		}
		else
		{
			for ($i = 0; $i < 100; $i++)
			{
				$lastCommits[] = $commits[$i];
			}
		}

		foreach ($commits as $commit)
		{
			if (isset($countCommit[$commit['author']['login']]))
			{
				$countCommit[$commit['author']['login']] += 1;
			}
			else
			{
				$countCommit[$commit['author']['login']] = 1;
			}
		}


		foreach ($countCommit as $login => $nbCommits) 
		{
			foreach ($contributors as $key => $contributor)
			{
				if ($login == $contributor['login'])
				{
					$contributors[$key]['100commits'] = $nbCommits;
				}
			}
		}

		//Appel de la vue
		$this->view('search/details', $name, array('contribs' => $contributors, 'infos' => $informations));
	}
}