<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for in-memory cache engine.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2
 */

/**
 */
class MemoryCacheEngineTest extends PHPUnit_Framework_TestCase {

    protected function setup() {
        parent::setUp();
        global $DPHP_CACHE_CONFIG;
        $DPHP_CACHE_CONFIG = Array(
            'default' => Array(
                'cache.type' => 'memory'
                ),
            'memory' => Array(
                'cache.type' => 'memory'
                )
                );
    }

    /**
     * Tests creation of cache manager objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($obj1, "Can not create cache manager object!");

        $obj2 = Ddth_Cache_CacheManager::getInstance();
        $this->assertTrue($obj1===$obj2, "Two objects are expected to be equal!");

        $this->assertTrue($obj1 instanceof Ddth_Cache_CacheManager, "Object must be of type Ddth_Cache_CacheManager!");
    }

    /**
     * Tests creation of cache instances.
     */
    public function testGetCache() {
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager, "Object must be of type Ddth_Cache_CacheManager!");

        $cacheName = 'memory';
        $cache = $cm->getCache($cacheName);
        $this->assertNotNull($cache, "Can not get cache [$cacheName]!");
        $this->assertTrue($cache instanceof Ddth_Cache_ICache, "Object must be of type Ddth_Cache_ICache!");
        $this->assertEquals($cacheName, $cache->getName(), "Cache's name must be [$cacheName]!");
    }

    /**
     * Tests creation of cache instances.
     */
    public function testGetCache2() {
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager, "Object must be of type Ddth_Cache_CacheManager!");

        $cacheName = 'not-exists';
        $cache = $cm->getCache($cacheName);
        $this->assertNotNull($cache, "Can not get cache [$cacheName]!");
        $this->assertTrue($cache instanceof Ddth_Cache_ICache, "Object must be of type Ddth_Cache_ICache!");
        $this->assertEquals($cacheName, $cache->getName(), "Cache's name must be [$cacheName]!");
    }

    /**
     * Tests cache functionality.
     */
    public function testCacheTest1() {
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager, "Object must be of type Ddth_Cache_CacheManager!");

        $cacheName = 'not-exists';
        $cache = $cm->getCache($cacheName);
        $this->assertNotNull($cache, "Can not get cache [$cacheName]!");
        $this->assertTrue($cache instanceof Ddth_Cache_ICache, "Object must be of type Ddth_Cache_ICache!");
        $this->assertEquals($cacheName, $cache->getName(), "Cache's name must be [$cacheName]!");
        $cache->clear();

        $key = 'key1';
        $value = $cache->get($key);
        $this->assertNull($value, "[$key] must not exist!");

        $key = 'key1';
        $value = 'value1';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value1', $value);
        $value = $cache->get($key);
        $this->assertEquals('value1', $value);
        $value = $cache->get($key);
        $this->assertEquals('value1', $value);
    }

    /**
     * Tests cache functionality.
     */
    public function testCache2() {
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager);

        $cache = $cm->getCache('default');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_ICache);
        $this->assertTrue($cache->getName() === 'default');
        $cache->clear();

        $key = 'key1';
        $value = $cache->get($key);
        $this->assertNull($value);

        $key = 'key1';
        $value = 'value1';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value1', $value);

        sleep(2);

        $key = 'key2';
        $value = 'value2';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value2', $value);

        sleep(2);

        $key = 'key3';
        $value = 'value3';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value3', $value);
    }

    /**
     * Tests cache functionality.
     */
    public function testCache3() {
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager);

        $cache = $cm->getCache('default');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_ICache);
        $this->assertTrue($cache->getName() === 'default');
        $cache->clear();

        $key = 'key1';
        $value = 'value1';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value1', $value);
        $this->assertEquals(1, $cache->getSize());

        $key = 'key2';
        $value = 'value2';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value2', $value);
        $this->assertEquals(2, $cache->getSize());

        $key = 'key3';
        $value = 'value3';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value3', $value);
        $this->assertEquals(3, $cache->getSize());
    }
}
?>