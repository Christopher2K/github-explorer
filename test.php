<?php
/**
 * Auteur:  christopher
 * Date:    22/04/16
 * Objet:   Test sur la librairie Github API
 */

require_once 'vendor/autoload.php';


$client     = new \Github\Client();
$commit    = $client->api('repo')->commits();
$paginator  = new \Github\ResultPager($client);
$parameters = array('KnpLabs', 'php-github-api', array('sha' => 'master'));
$result     = $paginator->fetchAll($commit, 'all', $parameters);

$lastCommits = [];
if (sizeof($result) < 100)
{
	for ($i = 0 ; $i < sizeof($result); $i++)
	{
		$lastCommits[] = $result[$i];
	}
}
else
{
	for ($i = 0 ; $i < 100; $i++)
	{
		$lastCommits[] = $result[$i];
	}
}

$countCommit = array();
foreach ($lastCommits as $commit)
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


var_dump($countCommit);






//$commits = $client->api('repo')->commits()->all('KnpLabs', 'php-github-api', array('sha' => 'master'));

//lister tous les auteurs de commits
/* for ($i = 0; $i < sizeof($commits); $i++)
{
	echo $commits[$i]['author']['login'] . '<br />';
}
*/

//Choper un auteur de commit
//echo $commits[0]['author']['login'];
