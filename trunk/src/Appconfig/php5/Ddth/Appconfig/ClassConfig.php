<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * An application configuration setting.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Appconfig
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id: ClassIAdodbFactory.php 144 2008-02-29 15:34:04Z btnguyen2k@gmail.com $
 * @since       File available since v0.1
 */

/**
 * This class represents an application configuration setting.
 *
 * A configuration is identified by an id, which is a combination of $domain and $key. $domain
 * is the configuration namespace, and $key is to distinguish configurations within a
 * $domain/namespace.
 *
 * @package    	Appconfig
 * @author     	Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.1
 */
class Ddth_Appconfig_Config {

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $key;

    /**
     * Integer-based value.
     *
     * @var int
     */
    private $intValue = NULL;

    /**
     * Floating point-based value.
     *
     * @var double
     */
    private $realValue = NULL;

    /**
     * String-based value (~255 character length).
     *
     * @var string
     */
    private $stringValue = NULL;

    /**
     * Binary string-based value (~unlimitted binary length).
     *
     * @var string
     */
    private $binaryStringValue = NULL;

    /**
     * Timestamp value.
     *
     * @var mixed
     */
    private $timestampValue = NULL;

    /**
     * Boolean value.
     *
     * @var bool
     */
    private $booleanValue = FALSE;

    /**
     * Constructs a new Ddth_Appconfig_Config object.
     *
     * @param string $domain
     * @param string $key
     */
    public function __construct($domain, $key) {
        $this->setDomain($domain);
        $this->setKey($key);
    }

    /**
     * Gets the configuration $domain (aka namespace).
     *
     * @return string
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * Sets configuration $domain (aka namespace).
     *
     * @param string $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }

    /**
     * Gets the configuration $key.
     *
     * @return string
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * Sets configuration $key.
     *
     * @param string $key
     */
    public function setKey($key) {
        $this->key = $key;
    }

    /**
     * Gets the configuration value as an integer.
     *
     * @return int
     */
    public function getIntValue() {
        return $this->intValue;
    }

    /**
     * Sets configuration's integer value.
     *
     * @param int $intValue
     */
    public function setIntValue($intValue) {
        $this->intValue = $intValue;
    }

    /**
     * Gets the configuration value as a floating-point.
     *
     * @return double
     */
    public function getRealValue() {
        return $this->realValue;
    }

    /**
     * Sets configuration's floating-point value.
     *
     * @param double $realValue
     */
    public function setRealValue($realValue) {
        $this->realValue = $realValue;
    }

    /**
     * Gets the configuration value as a string.
     *
     * @return string
     */
    public function getStringValue() {
        return $this->stringValue;
    }

    /**
     * Sets configuration's string value.
     *
     * @param string $stringValue
     */
    public function setStringValue($stringValue) {
        $this->stringValue = $stringValue;
    }

    /**
     * Gets the configuration value as a binary string.
     *
     * @return string
     */
    public function getBinaryStringValue() {
        return $this->binaryStringValue;
    }

    /**
     * Sets configuration's binary string value.
     *
     * @param string $binaryStringValue
     */
    public function setBinaryStringValue($binaryStringValue) {
        $this->binaryStringValue = $binaryStringValue;
    }

    /**
     * Gets the configuration value as a timestamp.
     *
     * @return int
     */
    public function getTimestampValue() {
        return $this->timestampValue;
    }

    /**
     * Sets the configuration's timestamp value.
     *
     * @param mixed $timestampValue
     */
    public function setTimestampValue($timestampValue) {
        $this->timestampValue = $timestampValue;
    }

    /**
     * Gets the configuration value as a boolean.
     *
     * @return bool
     */
    public function getBooleanValue() {
        return $this->booleanValue;
    }

    /**
     * Sets configuratoin's boolean value.
     *
     * @param bool $booleanValue
     */
    public function setBooleanValue($booleanValue) {
        $this->booleanValue = $booleanValue;
    }
}
?>
