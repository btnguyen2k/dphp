<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for APC cache engine.
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
class ApcCacheEngineTest extends PHPUnit_Framework_TestCase {

    protected function setup() {
        parent::setUp();
        global $DPHP_CACHE_CONFIG;
        $DPHP_CACHE_CONFIG = Array(
            'default' => Array(
                'cache.type' => 'apc'
                ),
            'apc' => Array(
                'cache.type' => 'apc'
                )
                );
    }

    /**
     * Tests creation of cache manager objects.
     */
    public function testObjCreation() {
        if ( !function_exists('apc_store') ) {
            echo "Warning: APC is not available!\n";
            return;
        }
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
        if ( !function_exists('apc_store') ) {
            echo "Warning: APC is not available!\n";
            return;
        }
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager, "Object must be of type Ddth_Cache_CacheManager!");

        $cacheName = 'apc';
        $cache = $cm->getCache($cacheName);
        $this->assertNotNull($cache, "Can not get cache [$cacheName]!");
        $this->assertTrue($cache instanceof Ddth_Cache_ICache, "Object must be of type Ddth_Cache_ICache!");
        $this->assertEquals($cacheName, $cache->getName(), "Cache's name must be [$cacheName]!");
    }

    /**
     * Tests creation of cache instances.
     */
    public function testGetCache2() {
        if ( !function_exists('apc_store') ) {
            echo "Warning: APC is not available!\n";
            return;
        }
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
        if ( !function_exists('apc_store') ) {
            echo "Warning: APC is not available!\n";
            return;
        }
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager, "Object must be of type Ddth_Cache_CacheManager!");

        $cacheName = 'apc';
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
    public function testCacheTest2() {
        if ( !function_exists('apc_store') ) {
            echo "Warning: APC is not available!\n";
            return;
        }
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager);

        $cacheName = 'apc';
        $cache = $cm->getCache($cacheName);
        $this->assertNotNull($cache, "Can not get cache [$cacheName]!");
        $this->assertTrue($cache instanceof Ddth_Cache_ICache, "Object must be of type Ddth_Cache_ICache!");
        $this->assertEquals($cacheName, $cache->getName(), "Cache's name must be [$cacheName]!");
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
    public function testCacheTest3() {
        if ( !function_exists('apc_store') ) {
            echo "Warning: APC is not available!\n";
            return;
        }
        $cm = Ddth_Cache_CacheManager::getInstance();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_CacheManager);

        $cacheName = 'default';
        $cache = $cm->getCache($cacheName);
        $this->assertNotNull($cache, "Can not get cache [$cacheName]!");
        $this->assertTrue($cache instanceof Ddth_Cache_ICache, "Object must be of type Ddth_Cache_ICache!");
        $this->assertEquals($cacheName, $cache->getName(), "Cache's name must be [$cacheName]!");
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