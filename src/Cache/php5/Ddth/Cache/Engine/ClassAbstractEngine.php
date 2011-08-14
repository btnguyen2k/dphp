<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Abstract cache engine implementation.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Cache
 * @subpackage  Engine
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2.1
 */

/**
 * Abstract cache engine implementation.
 *
 * @package     Cache
 * @subpackage  Engine
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2.1
 */
abstract class Ddth_Cache_Engine_AbstractEngine implements Ddth_Cache_ICacheEngine {

    const CONF_KEY_PREFIX = 'cache.keyPrefix';

    private $config = Array();
    private $keyPrefix = NULL;

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
        $this->config = is_array($config) ? $config : Array();
    }

    /**
     * Gets a configuration setting.
     *
     * @param string $key
     * @param mixed
     */
    protected function getConfig($key) {
        return isset($this->config[$key]) ? $this->config[$key] : NULL;
    }

    /**
     * Gets cache key prefix setting.
     *
     * @return string
     */
    protected function getCacheKeyPrefix() {
        if ($this->keyPrefix === NULL) {
            $this->keyPrefix = $this->getConfig(self::CONF_KEY_PREFIX);
            if ($this->keyPrefix === NULL) {
                $this->keyPrefix = '';
            }
        }
        return $this->keyPrefix;
    }
}
?>
