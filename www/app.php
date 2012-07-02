<?php
/**
 * Modified version of default index.php for deploying in live environment in a directory
 * named 'app' below the document root.
 */
ini_set('display_errors', 'On');
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/../app');

require_once('lib/bootstrap.php');

$application = new \SimplyTestable\WebpageUrlFinder\Application\Controller($_SERVER['DOCUMENT_ROOT'].'/../config.json');
$application->setUrl(isset($_GET['url']) ? $_GET['url'] : '');

$jsonContent = json_encode($application->getOutput());

$search = array('["', ',"', '{', '}', '"]');
$replacement = array("[\n    \"", ",\n    \"", "{\n    ", "\n}", "\"\n]");
$prettyJsonContent = str_replace($search, $replacement, $jsonContent); 

header('Content-Type: application/json');

echo $prettyJsonContent;