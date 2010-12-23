<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Alternative PHP Cache (APC) cache engine.
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
 * Alternative PHP Cache (APC) cache engine.
 *
 * This cache engine utilizes APC to store entries.
 *
 * @package     Cache
 * @subpackage  Engine
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2
 */
class Ddth_Cache_Engine_ApcEngine implements Ddth_Cache_ICacheEngine {

    /**
     * @see Ddth_Cache_ICacheEngine::clear()
     */
    public function clear() {
        apc_clear_cache();
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
        if ( !function_exists('apc_store') ) {
            $msg = 'APC is not available!';
            throw new Ddth_Cache_CacheException($msg);
        }
    }

    /**
     * @see Ddth_Cache_ICacheEngine::exists()
     */
    public function exists($key) {
        return apc_exists($key);
    }

    /**
     * @see Ddth_Cache_ICacheEngine::exists()
     */
    public function get($key) {
        $result = apc_fetch($key, $success);
        return $success?deserialize($result):NULL;
    }

    /**
     * @see Ddth_Cache_ICacheEngine::put()
     */
    public function put($key, $value) {
        $result = apc_fetch($key, $success);
        $value = serialize($value);
        apc_store($key, $value);
        return $success?$result:NULL;
    }

    /**
     * @see Ddth_Cache_ICacheEngine::put()
     */
    public function remove($key) {
        $result = apc_fetch($key, $success);
        if ( $success ) {
            apc_delete($key);
        }
        return $success?$result:NULL;
    }
}
?>
