<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * PHPUnit (http://www.phpunit.de/) test case for Cache - Memcache implementation.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

//initialization
//defines package name and package php version
if ( !defined('PACKAGE') ) {
    define('PACKAGE', 'Cache');
}
if ( !defined('PACKAGE_PHP_VERSION') ) {
    define('PACKAGE_PHP_VERSION', 'php5');
}
$REQUIRED_PACKAGES = Array('Commons');

//setting up include path
$dir = dirname(dirname(dirname(dirname(__FILE__))));
$INCLUDE_PATH = '.';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/libs/PHPUnit-3.2.9';
$INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.PACKAGE.'/'.PACKAGE_PHP_VERSION;
foreach ( $REQUIRED_PACKAGES as $package ) {
    $INCLUDE_PATH .= PATH_SEPARATOR.$dir.'/'.$package.'/'.PACKAGE_PHP_VERSION;
}
ini_set('include_path', $INCLUDE_PATH);

require_once 'PHPUnit/Framework.php';
require_once 'Ddth/Cache/ClassCacheFactory.php';

class MemcacheTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests creation of cache manager objects.
     */
    public function testObjCreation() {
        $obj1 = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertNotNull($obj1, "Can not create cache manager object!");

        $obj2 = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertTrue($obj1===$obj2);

        $this->assertTrue($obj1 instanceof Ddth_Cache_Memcache_MemCacheManager);
    }

    /**
     * Tests creation of cache instances.
     */
    public function testGetCache() {
        $cm = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_Memcache_MemCacheManager);

        $cache = $cm->getCache('test');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_Memcache_MemCache);
        $this->assertTrue($cache->getName() == 'test');
        $this->assertTrue($cache->getCapacity() == 100);
    }

    /**
     * Tests creation of cache instances.
     */
    public function testGetCache2() {
        $cm = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_Memcache_MemCacheManager);

        $cache = $cm->getCache('nontest');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_Memcache_MemCache);
        $this->assertTrue($cache->getName() == 'nontest');
        $this->assertTrue($cache->getCapacity() == 1000);
    }

    /**
     * Tests cache functionality.
     */
    public function testCacheTest() {
        $cm = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_Memcache_MemCacheManager);
        $cm->clearCache('test');

        $cache = $cm->getCache('test');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_Memcache_MemCache);
        $this->assertTrue($cache->getName() == 'test');
        $this->assertTrue($cache->getCapacity() == 100);

        $key = 'key1';
        $value = $cache->get($key);
        $this->assertNull($value);

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
    public function testCacheSmall() {
        $cm = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_Memcache_MemCacheManager);
        $cm->clearCache('small');

        $cache = $cm->getCache('small');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_Memcache_MemCache);
        $this->assertTrue($cache->getName() == 'small');
        $this->assertTrue($cache->getCapacity() == 2);

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
    public function testCacheDefault() {
        $cm = Ddth_Cache_CacheFactory::getCacheManager();
        $this->assertNotNull($cm, "Can not create cache manager object!");
        $this->assertTrue($cm instanceof Ddth_Cache_Memcache_MemCacheManager);
        $cm->clearCache('notspecify');

        $cache = $cm->getCache('notspecify');
        $this->assertNotNull($cache);
        $this->assertTrue($cache instanceof Ddth_Cache_Memcache_MemCache);
        $this->assertTrue($cache->getName() == 'notspecify');
        $this->assertTrue($cache->getCapacity() == 1000);

        $key = 'key1';
        $value = 'value1';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value1', $value);
        $this->assertEquals(1, $cache->countElementsInMemory());
        
        $key = 'key2';
        $value = 'value2';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value2', $value);
        $this->assertEquals(2, $cache->countElementsInMemory());
        
        $key = 'key3';
        $value = 'value3';
        $cache->put($key, $value);
        $value = $cache->get($key);
        $this->assertEquals('value3', $value);
        $this->assertEquals(3, $cache->countElementsInMemory());
    }
}
?>