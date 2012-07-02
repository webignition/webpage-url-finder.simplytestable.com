<?php
namespace SimplyTestable\WebpageUrlFinder\Application;

class Controller {
    
    /**
     *
     * @var \SimplyTestable\WebpageUrlFinder\Application\Configuration
     */
    private $configuration = null;
    
    /**
     * URL of document from which we want to extract URLs
     * 
     * @var string
     */
    private $url = null;    
    
    /**
     *
     * @var \webignition\WebDocumentLinkUrlFinder\WebDocumentLinkUrlFinder
     */
    private $linkFinder = null;
    
    
    /**
     *
     * @param string $configurationFilePath 
     */
    public function __construct($configurationFilePath) {
        $this->configuration = new \SimplyTestable\WebpageUrlFinder\Application\Configuration();
        $this->configuration->setConfigurationFilePath($configurationFilePath);        
    }
    
    
    /**
     *
     * @param string $url 
     */
    public function setUrl($url) {        
        if ($url != $this->url) {
            $this->url = $url;
            $this->linkFinder = null;
        }
    }
    
    
    /**
     *
     * @return boolean 
     */
    public function hasUrl() {        
        if (!is_string($this->url)) {
            return false;
        }
        
        return trim($this->url) == '';
    }
    
    
    /**
     *
     * @return array
     */
    public function getOutput() {
       return $this->linkFinder()->urls();      
    }
    
    
    /**
     *
     * @return \webignition\WebDocumentLinkUrlFinder\WebDocumentLinkUrlFinder 
     */
    private function linkFinder() {
        if (is_null($this->linkFinder)) {
            $this->linkFinder = new \webignition\WebDocumentLinkUrlFinder\WebDocumentLinkUrlFinder();
            $this->linkFinder->setSourceUrl($this->url);
            $this->linkFinder->setRequestHeaders(array(
                'User-Agent' => $this->configuration->getUserAgent()
            ));
            
            if ($this->configuration->has('proxy')) {                
                $this->linkFinder->setRequestOptions($this->configuration->getProxyOptions());            
            }            
        }
        
        return $this->linkFinder;
    }
    
}