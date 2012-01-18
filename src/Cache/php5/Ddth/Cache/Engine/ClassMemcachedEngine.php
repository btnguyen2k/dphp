<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Memcache (using php-memcacheD APIs) cache engine.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Cache
 * @subpackage  Engine
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2
 */

/**
 * Memcache (using php-memcacheD APIs) cache engine.
 *
 * This cache engine utilizes php-memcacheD APIs to store entries.
 *
 * @package     Cache
 * @subpackage  Engine
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
class Ddth_Cache_Engine_MemcachedEngine extends Ddth_Cache_Engine_AbstractEngine {

    const CONF_SERVERS = 'memcached.servers';
    const CONF_SERVER_HOST = 'host';
    const CONF_SERVER_PORT = 'port';
    const CONF_SERVER_WEIGHT = 'weight';

    const DEFAULT_SERVER_HOST = 'localhost';
    const DEFAULT_SERVER_PORT = 11211;
    const DEFAULT_SERVER_WEIGHT = 1;

    private $memcached;

    /**
     * Gets the Memcached instance (PHP's Memcached class).
     *
     * @return Memcached
     */
    protected function getMemcachedObj() {
        return $this->memcached;
    }

    /**
     * @see Ddth_Cache_ICacheEngine::clear()
     */
    public function clear() {
        try {
            return $this->memcached->flush();
        } catch (Exception $e) {
            return FALSE;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::destroy()
     */
    public function destroy() {
        //EMPTY
    }

    /**
     * This function accepts an associative array as its parameter. Detailed specs of
     * the array:
     * <code>
     * Array(
     * 'memcached.servers'   => Array(
     * #list of MemcacheD servers
     * Array(
     * #see http://www.php.net/manual/en/memcached.addserver.php for more information
     * 'host'       => '192.168.0.1',
     * 'port'       => '(optional) 11211',
     * 'weight'     => '(optional) 1'
     * ),
     * Array(
     * 'host'       => '192.168.0.2',
     * 'port'       => '(optional) 11211',
     * 'weight'     => '(optional) 1'
     * )
     * )
     * )
     * </code>
     *
     * @see Ddth_Cache_ICacheEngine::init()
     */
    public function init($cache, $config) {
        if (!class_exists('Memcached', FALSE)) {
            $msg = 'PHP-Memcached is not available!';
            throw new Ddth_Cache_CacheException($msg);
        }
        parent::init($cache, $config);
        $servers = isset($config[self::CONF_SERVERS]) ? $config[self::CONF_SERVERS] : NULL;
        if ($servers === NULL || !is_array($servers) || count($servers) < 1) {
            $msg = 'No Memcache servers defined!';
            throw new Ddth_Cache_CacheException($msg);
        }
        $memcached = new Memcached();
        foreach ($servers as $server) {
            $host = isset($server[self::CONF_SERVER_HOST]) ? $server[self::CONF_SERVER_HOST] : self::DEFAULT_SERVER_HOST;
            $port = isset($server[self::CONF_SERVER_PORT]) ? $server[self::CONF_SERVER_PORT] : self::DEFAULT_SERVER_PORT;
            $weight = isset($server[self::CONF_SERVER_WEIGHT]) ? $server[self::CONF_SERVER_WEIGHT] : self::DEFAULT_SERVER_WEIGHT;
            $memcached->addServer($host, $port, $weight);
        }
        $this->memcached = $memcached;
        try {
            @$this->memcached->get('FOO');
        } catch (Exception $e) {
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::exists()
     */
    public function exists($key) {
        return $this->get($key) !== NULL;
    }

    /**
     * @see Ddth_Cache_ICacheEngine::get()
     */
    public function get($key) {
        $newKey = $this->getCacheKeyPrefix() . $key;
        try {
            $result = $this->memcached->get($newKey);
            if ($this->memcached->getResultCode() !== Memcached::RES_NOTFOUND) {
                return $result;
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            return NULL;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::put()
     */
    public function put($key, $value) {
        $newKey = $this->getCacheKeyPrefix() . $key;
        try {
            $result = $this->get($key);
            $this->memcached->set($newKey, $value);
            return $result;
        } catch (Exception $e) {
            return NULL;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::remove()
     */
    public function remove($key) {
        $newKey = $this->getCacheKeyPrefix() . $key;
        try {
            $result = $this->get($key);
            if ($result !== NULL) {
                $this->memcached->delete($newKey);
            }
            return $result;
        } catch (Exception $e) {
            return NULL;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::getNumHits()
     */
    public function getNumHits() {
        try {
            $stats = $this->memcached->getStats();
            $numHits = 0;
            foreach ($stats as $serverName => $serverStats) {
                $numHits += $serverStats['get_hits'];
            }
            return $numHits;
        } catch (Exception $e) {
            return -1;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::getNumMisses()
     */
    public function getNumMisses() {
        try {
            $stats = $this->memcached->getStats();
            $numMisses = 0;
            foreach ($stats as $serverName => $serverStats) {
                $numMisses += $serverStats['get_misses'];
            }
            return $numMisses;
        } catch (Exception $e) {
            return -1;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::getSize()
     */
    public function getSize() {
        try {
            $stats = $this->memcached->getStats();
            $size = 0;
            foreach ($stats as $serverName => $serverStats) {
                $size += $serverStats['curr_items'];
            }
            return $size;
        } catch (Exception $e) {
            return -1;
        }
    }
}
