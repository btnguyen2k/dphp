<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Utf8 support for vn_VI.
 *
 * LICENSE: This source file is subject to version 3.0 of the GNU Lesser General
 * Public License that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/lgpl.html. If you did not receive a copy of
 * the GNU Lesser General Public License and are unable to obtain it through the web,
 * please send a note to gnu@gnu.org, or send an email to any of the file's authors
 * so we can email you a copy.
 *
 * @package		Vnvi
 * @author		NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @id			$Id$
 * @since      	File available since v0.1
 */

/**
 * Utf8 support for vn_VI.
 *
 * This class provides support for vn_VI with Utf8 character encoding.
 *
 * @package    	Vnvi
 * @author     	NGUYEN, Ba Thanh <btnguyen2k@gmail.com>
 * @copyright	2008 DDTH.ORG
 * @license    	http://www.gnu.org/licenses/lgpl.html LGPL 3.0
 * @since      	Class available since v0.1
 */
class Ddth_Vnvi_Utf8 {

    private static $instance = NULL;

    private static $toneMarkRemovalSearches = NULL;
    private static $toneMarkRemovalReplaces = NULL;
    private static $tblToneMarkRemoval = Array(
        'à' => 'a',
        'ả' => 'a',
        'ã' => 'a',
		'á' => 'a',
        'ạ' => 'a',
        'ằ' => 'ă',
        'ẳ' => 'ă',
        'ẵ' => 'ă',
        'ắ' => 'ă',
        'ặ' => 'ă',
        'ầ' => 'â',
        'ẩ' => 'â',
        'ẫ' => 'â',
        'ấ' => 'â',
        'ậ' => 'â',
        'è' => 'e',
        'ẻ' => 'e',
        'ẽ' => 'e',
        'é' => 'e',
        'ẹ' => 'e',
        'ề' => 'ê',
        'ể' => 'ê',
        'ễ' => 'ê',
        'ế' => 'ê',
        'ệ' => 'ê',
        'ì' => 'i',
        'ỉ' => 'i',
        'ĩ' => 'i',
        'í' => 'i',
        'ị' => 'i',
        'ò' => 'o',
        'ỏ' => 'o',
        'õ' => 'o',
        'ó' => 'o',
        'ọ' => 'o',
        'ồ' => 'ô',
        'ổ' => 'ô',
        'ỗ' => 'ô',
        'ố' => 'ô',
        'ộ' => 'ô',
        'ờ' => 'ơ',
        'ở' => 'ơ',
        'ỡ' => 'ơ',
        'ớ' => 'ơ',
        'ợ' => 'ơ',
        'ù' => 'u',
        'ủ' => 'u',
        'ũ' => 'u',
        'ú' => 'u',
        'ụ' => 'u',
        'ừ' => 'ư',
        'ử' => 'ư',
        'ữ' => 'ư',
        'ứ' => 'ư',
        'ự' => 'ư',
        'ỳ' => 'y',
        'ỷ' => 'y',
        'ỹ' => 'y',
        'ý' => 'y',
        'ỵ' => 'y'
        );

        /**
         * Constructs a new Ddth_Vnvi_Utf8 object.
         */
        protected function __construct() {
            self::$toneMarkRemovalSearches = Array();
            self::$toneMarkRemovalReplaces = Array();
            foreach ( self::$tblToneMarkRemoval as $key => $value ) {
                self::$toneMarkRemovalSearches[] = $key;
                self::$toneMarkRemovalReplaces[] = $value;
            }
        }

        /**
         * Gets instance of this class.
         *
         * @return Ddth_Vnvi_Utf8
         */
        public static function getInstance() {
            if ( self::$instance == NULL ) {
                self::$instance = new Ddth_Vnvi_Utf8();
            }
            return self::$instance;
        }

        /**
         * Removes tone mark from a word.
         *
         * @param string
         * @return string the word after removing tone mark
         */
        public function removeToneMark($word) {
            if ( !is_string($word) ) {
                return $word;
            }
            return str_replace(self::$toneMarkRemovalSearches, self::$toneMarkRemovalReplaces, $word);
        }
}
?>