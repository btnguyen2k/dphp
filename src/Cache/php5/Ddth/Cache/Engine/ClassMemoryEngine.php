<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * In-memory cache engine.
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
 * In-memory cache engine.
 *
 * This cache engine stores PHP variables as-is in current process's memory space. Cache
 * entries will NOT be persisted between HTTP requests.
 *
 * @package     Cache
 * @subpackage  Memcache
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
class Ddth_Cache_Engine_MemoryEngine implements Ddth_Cache_ICacheEngine {

    private $cache = Array();

    /**
     * @see Ddth_Cache_ICacheEngine::clear()
     */
    public function clear() {
        $this->cache = Array();
    }

    /**
     * @see Ddth_Cache_ICacheEngine::destroy()
     */
    public function destroy() {
        //EMPTY
    }

    /**
     * @see Ddth_Cache_ICacheEngine::init()
     */
    public function init($config) {
        //EMPTY
    }

    /**
     * Checks if an entry exists.
     *
     * @param string $key
     * @return bool
     */
    public function exists($key);

    /**
     * Retrieves a cache entry.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Puts an entry into the cache.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed old entry with the same key (if exists)
     */
    public function put($key, $value);

    /**
     * Removes an entry.
     *
     * @param string $key
     * @return mixed existing entry associated with the key (if exists)
     */
    public function remove($key);

}
?>