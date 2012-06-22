<?php
ini_set('display_errors', 'On');
require_once(__DIR__.'/../lib/bootstrap.php');

class ConfigurationTest extends PHPUnit_Framework_TestCase {
    
    public function testDefaultConfigurationOnly() {        
        $configuration = new \SimplyTestable\WebpageUrlFinder\Application\Configuration();
        
        $this->assertEquals('SimplyTestable Webpage URL Finder/1.0 (http://simplytestable.com/)', $configuration->getUserAgent());
        $this->assertEquals(array(), $configuration->getProxyOptions());
        
    }
    
}