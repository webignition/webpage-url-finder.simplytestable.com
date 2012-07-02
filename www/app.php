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

if ($application->hasUrl()) {
    $jsonContent = json_encode($application->getOutput());

    $search = array('["', ',"', '{', '}', '"]');
    $replacement = array("[\n    \"", ",\n    \"", "{\n    ", "\n}", "\"\n]");
    $prettyJsonContent = str_replace($search, $replacement, $jsonContent); 

    header('Content-Type: application/json');

    echo $prettyJsonContent;    
} else {
    header('HTTP/1.1 400 Bad Request');
    
echo <<<'EOD'
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset=utf-8>
    <title>HTTP/1.1 400 Bad Request</title>
  </head>
  <body>
     <p>
       Missing or empty 'url' parameter in query string.
     </p>
     <p>
       If you're a person, take a look at the documentation: <a href="https://github.com/webignition/webpage-url-finder.simplytestable.com">https://github.com/webignition/webpage-url-finder.simplytestable.com</a>
     </p>
  </body>	
</html>
EOD;
}