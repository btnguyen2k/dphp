<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Cache manager.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Cache
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2
 */

/**
 * Cache manager.
 *
 * This class provides APIs to manage caches.
 *
 * @package     Cache
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version    	$Id$
 * @since      	Class available since v0.2
 */
class Ddth_Cache_CacheManager {

    /**
     * Name of the default cache.
     *
     * @var string
     */
    const DEFAULT_CACHE_NAME = 'default';

    /**
     * Cache type: memcache
     */
    const CACHE_TYPE_MEMCACHE = 'memcache';

    /**
     * Cache type: APC.
     */
    const CACHE_TYPE_APC = 'apc';

    /**
     * Cache type: in-memory object cache.
     */
    const CACHE_TYPE_MEMORY = 'memory';

    /**
     * Config key: type of cache
     * @var string
     */
    const CONF_CACHE_TYPE = 'cache.type';

    /**
     * Config key: cache's class name
     * @var string
     */
    const CONF_CACHE_CLASS = 'cache.class';

    /**
     * @var Array
     */
    private $config;

    /**
     * @var Array
     */
    private $caches = Array();

    /**
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    /**
     * Constructs a new Ddth_Cache_CacheManager object.
     *
     * @param Array $config
     */
    public function __construct($config) {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        $this->config = $config;
    }

    /**
     * Perform clean-up work before shutting down this cache manager.
     */
    public function destroy() {
        if ( $this->LOGGER->isDebugEnabled() ) {
            $this->LOGGER->debug(__CLASS__.'::'.__FUNCTION__.'() is called');
        }
        //EMPTY
    }

    /**
     * Performs initializing work before using this cache manager.
     */
    public function init() {
        if ( $this->LOGGER->isDebugEnabled() ) {
            $this->LOGGER->debug(__CLASS__.'::'.__FUNCTION__.'() is called');
        }
        //EMPTY
    }

    /**
     * Gets a cache by its name.
     *
     * @param string
     * @return Ddth_Cache_ICache
     */
    public function getCache($name) {
        $cache = isset($this->caches[$name])?$this->caches[$name]:NULL;
        if ( $cache === NULL ) {
            if ( $this->LOGGER->isDebugEnabled() ) {
                $this->LOGGER->debug("Can not get cache [$name] from pool.");
            }
            $cache = $this->createCache($name);
            if ( $cache !== NULL ) {
                $this->caches[$name] = $cache;
            }
        }
        return $cache;
    }

    /**
     * Creates a cache by name.
     *
     * @param string $name
     */
    protected function createCache($name) {
        if ( $this->LOGGER->isInfoEnabled() ) {
            $this->LOGGER->info("Creating cache [$name]...");
        }
        $cacheConfig = isset($this->config[$name])?$this->config[$name]:NULL;
        if ( $cacheConfig === NULL ) {
            if ( $this->LOGGER->isInfoEnabled() ) {
                $this->LOGGER->info("Can not find configurations for cache [$name], fall back to default.");
            }
            $tempName = self::DEFAULT_CACHE_NAME;
            $cacheConfig = isset($this->config[$tempName])?$this->config[$tempName]:NULL;
        }
        if ( $cacheConfig === NULL ) {
            $this->LOGGER->error("Can not create cache [$name]!");
            return NULL;
        }
        $cache = $this->_createCache($name, $cacheConfig);
        return $cache;
    }

    private function _createCache($name, $cacheConfig) {
        /**
         * @var Ddth_Cache_ICache
         */
        $cache = NULL;
        $cacheClass = isset($cacheConfig[self::CONF_CACHE_CLASS])?$cacheConfig[self::CONF_CACHE_CLASS]:NULL;
        if ( $cacheClass === NULL ) {
            if ( $this->LOGGER->isDebugEnabled() ) {
                $this->LOGGER->debug("Found configuration cache class [$cacheClass].");
            }
            $cache = new $cacheClass();
        } else {
            $cacheType = isset($cacheConfig[self::CONF_CACHE_TYPE])?$cacheConfig[self::CONF_CACHE_TYPE]:NULL;
            if ( $this->LOGGER->isDebugEnabled() ) {
                $this->LOGGER->debug("Creating a new cache of type [$cacheType].");
            }
            $cache = new Ddth_Cache_GenericCache();
            /*
             switch ( $cacheType ) {
             case (self::CACHE_TYPE_MEMCACHE): {
             $cache = new Ddth_Cache_MemcacheCache();
             break;
             }
             case (self::CACHE_TYPE_APC): {
             $cache = new Ddth_Cache_ApcCache();
             break;
             }
             default: {
             $cache = new Ddth_Cache_MemoryCache();
             break;
             }
             }
             */
        }
        if ( $cache !== NULL ) {
            $cache->init($name, $cacheConfig, $this);
        }
        return $cache;
    }

    /**
     * Shortcut for {@link getCache()}.{@link Ddth_Cache_ICache::clear() clear()}.
     *
     * @param string $name
     */
    public function clearCache($name) {
        $cache = $this->getCache();
        if ( $cache !== NULL ) {
            $cache->clear();
        }
    }

    /**
     * Shortcut for {@link getCache()}.{@link Ddth_Cache_ICache::get() get()}.
     *
     * @param string $name name of the cache
     * @param string $key the entry's key
     * @return mixed
     */
    public function getFromCache($name, $key) {
        $cache = $this->getCache();
        if ( $cache !== NULL ) {
            return $cache->get($key);
        }
        return NULL;
    }

    /**
     * Shortcut for {@link getCache()}.{@link Ddth_Cache_ICache::put() put()}.
     *
     * @param string $name name of the cache
     * @param string $key the entry's cache
     * @param mixed $value
     * @return mixed old entry with the same key (if exists)
     */
    public function putToCache($name, $key, $value) {
        $cache = $this->getCache();
        if ( $cache !== NULL ) {
            return $cache->put($key, $value);
        }
        return NULL;
    }

    /**
     * Shortcut for {@link getCache()}.{@link Ddth_Cache_ICache::remove() remove()}.
     *
     * @param string $name name of the cache
     * @param string $key the entry's key.
     * @return mixed existing entry associated with the key (if exists)
     */
    public function removeFromCache($name, $key) {
        $cache = $this->getCache();
        if ( $cache !== NULL ) {
            return $cache->remove($key);
        }
        return NULL;
    }
}
?>
