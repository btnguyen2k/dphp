<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * A cache entry wrapper.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package Cache
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version $Id: ClassCacheEntry.php 251 2010-12-25 19:21:35Z
 *          btnguyen2k@gmail.com $
 * @since File available since v0.1
 */

/**
 * A cache entry wrapper.
 *
 * This class wraps a cache entry inside and also provides extra functionality
 * such as
 * max idle time.
 *
 * Usage:
 * <code>
 * $cacheEntry = new Ddth_Cache_CacheEntry($realValue, 3600); //max idle time =
 * 3600 seconds
 * //put $cacheEntry to cache
 * $cache->put($key, $cacheEntry);
 * //...
 * //get $cacheEntry from cache
 * $cacheEntry = $cache->get($key);
 * $value = $cacheEntry!==NULL ? $cacheEntry->getValue() : NULL;
 * </code>
 *
 * @package Cache
 * @author Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since Class available since v0.1
 */
class Ddth_Cache_CacheEntry {
    /**
     *
     * @var mixed
     */
    private $value;

    /**
     * Specifies that cache entry should expire once a fixed duration (in
     * seconds) has
     * elapsed after the entry's creation.
     *
     * @var int
     */
    private $expireAfterWrite = -1;

    /**
     * Specifies that cache entry should expire once a fixed duration (in
     * seconds) has
     * elapsed after the entry's creation, or its last access.
     *
     * @var int
     */
    private $expireAfterAccess = -1;

    /**
     *
     * @var int
     */
    private $creationTimestamp;

    /**
     *
     * @var int
     */
    private $lastAccessTimestamp;

    /**
     * Constructs a new Ddth_Cache_CacheEntry object
     *
     * @param mixed $value
     * @param int $expireAfterWrite
     *            (in seconds)
     * @param int $expireAfterAccess
     *            (in seconds)
     */
    public function __construct($value, $expireAfterWrite = -1, $expireAfterAccess = -1) {
        $this->value = $value;
        $this->expireAfterAccess = $expireAfterAccess;
        $this->expireAfterWrite = $expireAfterWrite;
        $timestamp = time();
        $this->creationTimestamp = $timestamp;
        $this->lastAccessTimestamp = $timestamp;
    }

    /**
     * Gets entry's value.
     *
     * @return mixed
     */
    public function &getValue() {
        if (!$this->isExpired()) {
            $this->lastAccessTimestamp = time();
            return $this->value;
        } else {
            return NULL;
        }
    }

    public function getExpireAfterWrite() {
        return $this->expireAfterWrite;
    }

    public function setExpireAfterWrite($expireAfterWrite) {
        $this->expireAfterWrite = $expireAfterWrite;
    }

    public function getExpireAfterAccess() {
        return $this->expireAfterAccess;
    }

    public function setExpireAfterAccess($expireAfterAccess) {
        $this->expireAfterAccess = $expireAfterAccess;
    }

    /**
     * Gets entry's creation timestamp.
     *
     * @return int UNIX timestamp
     */
    public function getCreationTimestamp() {
        return $this->creationTimestamp;
    }

    /**
     * Gets entry's last access timestamp.
     *
     * @return int UNIX timestamp
     */
    public function getLastAccessTimestamp() {
        return $this->lastAccessTimestamp;
    }

    /**
     * Checks if this entry is expired.
     *
     * @return bool
     */
    public function isExpired() {
        if ($this->expireAfterWrite >= 0) {
            return $this->expireAfterWrite + $this->creationTimestamp < time();
        }
        if ($this->expireAfterAccess >= 0) {
            return $this->expireAfterAccess + $this->lastAccessTimestamp < time();
        }
        return TRUE;
    }
}
