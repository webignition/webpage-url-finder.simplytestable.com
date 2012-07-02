<?php
ini_set('display_errors', 'On');
require_once(__DIR__.'/../lib/bootstrap.php');

class InvalidHostnameTest extends PHPUnit_Framework_TestCase {
    
    public function testGracefulHandlingOfInvalidHostname() {        
        $finder = new \webignition\WebDocumentLinkUrlFinder\WebDocumentLinkUrlFinder();
        $finder->setSourceUrl('http://news.bbc');
        
        $this->assertEquals(array(), $finder->urls());        
    }
    
}