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
    
    public function getOutput() {
       return $this->linkFinder()->urls();
      
        
/**
 $string = '{"a":"apple","b":"banana","c":"catnip"}';
 $pattern = array(',"', '{', '}');
 $replacement = array(",\n\t\"", "{\n\t", "\n}");
 echo str_replace($pattern, $replacement, $string); 
 */
        
//    $finder = new \webignition\WebDocumentLinkUrlFinder\WebDocumentLinkUrlFinder();
//    $finder->setSourceUrl($sourceUrl);
//    $finder->setRequestOptions(array(
//        'proxyhost' => 'localhost',
//        'proxyport' => 3128,
//        'proxytype' => HTTP_PROXY_HTTP
//    ));
//
//    $urls = $finder->urls();
//   
//    echo "Found ".count($urls)." urls\n";
//    
//    if (isset($_GET['verbose'])) {
//        foreach ($urls as $url) {
//            echo $url . "\n";
//        }
//    }        
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
            
//            $this->linkFinder->setRequestOptions(array(
//                'proxyhost' => 'localhost',
//                'proxyport' => 3128,
//                'proxytype' => 0
//            ));
            
//            var_dump($this->configuration->getProxyOptions());
//            exit();
            
            if ($this->configuration->has('proxy')) {                
                $this->linkFinder->setRequestOptions($this->configuration->getProxyOptions());            
            }            
        }
        
        return $this->linkFinder;
    }
    
}
