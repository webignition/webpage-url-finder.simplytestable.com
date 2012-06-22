<?php
namespace SimplyTestable\WebpageUrlFinder\Application;

class Configuration {
    
    const DEFAULT_USER_AGENT = 'SimplyTestable Webpage URL Finder/1.0 (http://simplytestable.com/)';
    const DEFAULT_PROXY_HOST = 'localhost';
    const DEFAULT_PROXY_PORT = 3128;
    const DEFAULT_PROXY_TYPE = \HTTP_PROXY_HTTP;    
       
    private $defaultProxyOptions = array(
        'host' => self::DEFAULT_PROXY_HOST,
        'port' => self::DEFAULT_PROXY_PORT,
        'type' => self::DEFAULT_PROXY_TYPE
    );
    
    /**
     * Full path to configuration file
     * 
     * @var string
     */
    private $configurationFilePath = null;
    
    
    /**
     * Parsed content of configuration file
     * 
     * @var \stdClass
     */
    private $configuration = null;
    
    /**
     *
     * @return string
     */
    public function getUserAgent() {        
        return $this->has('user-agent') ? $this->configuration()->{'user-agent'} : self::DEFAULT_USER_AGENT;
    }
    
    
    /**
     *
     * @return null|\stdClass
     */
    public function getProxyOptions() {
        if (!$this->has('proxy')) {
            return array();
        }
        
        $proxyConfigurationOptions = $this->configuration->proxy;
        $proxyOptionKeys = array('host', 'port', 'type');
        
        $proxyOptions = array();

        foreach ($proxyOptionKeys as $proxyOptionKey) {
            $proxyOptions['proxy'.$proxyOptionKey] = is_null($proxyConfigurationOptions->$proxyOptionKey) ? $this->defaultProxyOptions[$proxyOptionKey] : $proxyConfigurationOptions->$proxyOptionKey;
        }        
        
        return $proxyOptions;
    }
    
    
    /**
     * Return to default state
     *  
     */
    public function reset() {
        $this->configuration = null;
    }
    
    
    /**
     *
     * @param string $configurationFilePath 
     */
    public function setConfigurationFilePath($configurationFilePath) {
        $this->configurationFilePath = $configurationFilePath;
    }
    
    
    /**
     *
     * @return \stdClass
     */
    private function configuration() {        
        if (is_null($this->configuration)) {
            if (file_exists($this->configurationFilePath) && is_file($this->configurationFilePath)) {
                $this->configuration = json_decode(file_get_contents($this->configurationFilePath));
            } else {
                $this->configuration = new \stdClass();
            }
        }
        
        return $this->configuration;
    }
    
    /**
     *
     * @param string $key
     * @return boolean
     */
    public function has($key) {
        return !is_null($this->configuration()->$key);
    }
    
}