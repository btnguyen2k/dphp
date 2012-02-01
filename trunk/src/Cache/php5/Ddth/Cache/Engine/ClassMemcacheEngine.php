<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Memcache (using php-memcache APIs) cache engine.
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
 * Memcache (using php-memcache APIs) cache engine.
 *
 * This cache engine utilizes php-memcacheD APIs to store entries.
 *
 * @package     Cache
 * @subpackage  Engine
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since       Class available since v0.2
 */
class Ddth_Cache_Engine_MemcacheEngine extends Ddth_Cache_Engine_AbstractEngine {

    const CONF_SERVERS = 'memcache.servers';
    const CONF_SERVER_HOST = 'host';
    const CONF_SERVER_PORT = 'port';
    const CONF_SERVER_WEIGHT = 'weight';

    const DEFAULT_SERVER_HOST = 'localhost';
    const DEFAULT_SERVER_PORT = 11211;
    const DEFAULT_SERVER_WEIGHT = 1;

    private $memcache;

    /**
     * Gets the Memcache instance (PHP's Memcache class).
     *
     * @return Memcache
     */
    protected function getMemcacheObj() {
        return $this->memcache;
    }

    /**
     * @see Ddth_Cache_ICacheEngine::clear()
     */
    public function clear() {
        try {
            return $this->memcache->flush();
        } catch (Exception $e) {
            return FALSE;
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::destroy()
     */
    public function destroy() {
        try {
            $this->memcache->close();
        } catch (Exception $e) {
        }
    }

    /**
     * This function accepts an associative array as its parameter. Detailed specs of
     * the array:
     * <code>
     * Array(
     * 'memcache.servers'   => Array(
     * #list of MemcacheD servers
     * Array(
     * #see http://www.php.net/manual/en/memcached.addserver.php for more information
     * 'host'       => '192.168.0.1',
     * 'port'       => '(optional) 11211',
     * 'weight'     => '(optional) 1'
     * ),
     * Array(
     * 'host'       => 'unix:///path/to/memcached.sock',
     * 'port'       => 0, #must be 0 if using UNIX socket
     * 'weight'     => '(optional) 1'
     * )
     * )
     * )
     * </code>
     *
     * @see Ddth_Cache_ICacheEngine::init()
     */
    public function init($cache, $config) {
        if (!class_exists('Memcache', FALSE)) {
            $msg = 'PHP-Memcache is not available!';
            throw new Ddth_Cache_CacheException($msg);
        }
        parent::init($cache, $config);
        $servers = isset($config[self::CONF_SERVERS]) ? $config[self::CONF_SERVERS] : NULL;
        if ($servers === NULL || !is_array($servers) || count($servers) < 1) {
            $msg = 'No Memcache servers defined!';
            throw new Ddth_Cache_CacheException($msg);
        }
        $memcache = new Memcache();
        foreach ($servers as $server) {
            $host = isset($server[self::CONF_SERVER_HOST]) ? ($server[self::CONF_SERVER_HOST]) : (self::DEFAULT_SERVER_HOST);
            $port = isset($server[self::CONF_SERVER_PORT]) ? ($server[self::CONF_SERVER_PORT]) : (self::DEFAULT_SERVER_PORT);
            $weight = isset($server[self::CONF_SERVER_WEIGHT]) ? ($server[self::CONF_SERVER_WEIGHT]) : (self::DEFAULT_SERVER_WEIGHT);
            $memcache->addServer($host, $port, TRUE, $weight);
        }
        $this->memcache = $memcache;
        try {
            @$this->memcache->get('FOO');
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
        $statsKeyHits = $this->getCacheKeyPrefix() . '_stats_hits';
        $statsKeyMisses = $this->getCacheKeyPrefix() . '_stats_misses';
        $this->memcache->add($statsKeyHits, 0);
        $this->memcache->add($statsKeyMisses, 0);

        $newKey = $this->getCacheKeyPrefix() . $key;
        try {
            $result = $this->memcache->get($newKey);
            if ($result === FALSE) {
                $this->memcache->increment($statsKeyMisses);
                return NULL;
            } else {
                $this->memcache->increment($statsKeyHits);
                return $result;
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

            //Note: boolean and numeric values may cause annoying warning if using compression.
            //So below is a workaround for it (http://www.php.net/manual/en/memcache.set.php)
            $compress = is_bool($value) || is_int($value) || is_float($value) ? FALSE : MEMCACHE_COMPRESSED;
            $this->memcache->set($newKey, $value, $compress);
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
                $this->memcache->delete($newKey);
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
            $statsKeyHits = $this->getCacheKeyPrefix() . '_stats_hits';
            $numHits = $this->memcache->get($statsKeyHits);
            if ($numHits !== FALSE) {
                return $numHits;
            }

            $stats = $this->memcache->getExtendedStats();
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
            $statsKeyMisses = $this->getCacheKeyPrefix() . '_stats_misses';
            $numMisses = $this->memcache->get($statsKeyMisses);
            if ($numMisses !== FALSE) {
                return $numMisses;
            }

            $stats = $this->memcache->getExtendedStats();
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
            $stats = $this->memcache->getExtendedStats();
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
