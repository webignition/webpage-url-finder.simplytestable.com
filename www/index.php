<?php
ini_set('display_errors', 'On');
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/bootstrap.php');

$application = new \SimplyTestable\WebpageUrlFinder\Application\Controller($_SERVER['DOCUMENT_ROOT'].'/../config.json');
$application->setUrl(isset($_GET['url']) ? $_GET['url'] : '');

$jsonContent = json_encode($application->getOutput());

$search = array('["', ',"', '{', '}', '"]');
$replacement = array("[\n    \"", ",\n    \"", "{\n    ", "\n}", "\"\n]");
$prettyJsonContent = str_replace($search, $replacement, $jsonContent); 

header('Content-Type: application/json');

echo $prettyJsonContent;