<?php

/**
 * Class MemcacheSessionHandle
 */
class MemcacheSessionHandle implements SessionHandlerInterface
{

    private $_memcache = null;
    
    private $_lifeTime = 7200;
    
    private $_sessionName = null;
    
    private $_staticCache = array();
    
    public function __construct($config)
    {
        $this->_config = array(
            'host' => $config->memcache->host,
            'port' => $config->memcache->port,
            'lifeTime' => $config->memcache->lifeTime
        );
    }
    
    public function close()
    {
        $this->_memcache->close();
        $this->_memcache = null;
        
        return false;
    }
    
    public function destroy($sessionId)
    {
        $key = $this->_sessionName . $sessionId;
        
        if (isset($this->_staticCache[$key])) {
            unset($this->_staticCache[$key]);
        }
        
        return $this->_memcache->delete($key);
    }
    
    public function gc($sessionMaxLifeTime)
    {
        //不需要实现, memcache有自己的过期处理机制
        
        return true;
    }
    
    public function open($savePath, $sessionName)
    {
        $this->_sessionName = $sessionName;
        
        $this->_memcache = new memcache();

        $this->_lifeTime = $this->_config['lifeTime'] ? $this->_config['lifeTime'] : 7200;

        $result = $this->_memcache->connect($this->_config['host'], $this->_config['port']);
    
        return $result;
    }
    
    public function read($sessionId)
    {
        $key = $this->_sessionName . $sessionId;
        
        if (isset($this->_staticCache[$key])) {
            $result = $this->_staticCache[$this->sessionName . $sessionId];
        } else {
            $result = $this->_memcache->get($key);
            
            if ($result) {
                $this->_staticCache[$key] = $result;
            }
        }
        
        return $result;
    }
    
    public function write($sessionId, $sessionData)
    {
        $key = $this->_sessionName . $sessionId;
        
        $this->_staticCache[$key] = $sessionData;
        
        return $this->_memcache->set($key, $sessionData, false, $this->_lifeTime);
    }
}