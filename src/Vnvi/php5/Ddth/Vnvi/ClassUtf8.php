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

    private static $tblAllLettersLower = Array (
    	'a', 'à', 'ả', 'ã', 'á', 'ạ',
    	'ă', 'ằ', 'ẳ', 'ẵ', 'ắ', 'ặ',
    	'â', 'ầ', 'ẩ', 'ẫ', 'ấ', 'ậ',
    	'b', 'c', 'd', 'đ',
    	'e', 'è', 'ẻ', 'ẽ', 'é', 'ẹ',
    	'ê', 'ề', 'ể', 'ễ', 'ế', 'ệ',
        'f', 'g', 'h',
    	'i', 'ì', 'ỉ', 'ĩ', 'í', 'ị',
    	'j', 'k', 'l', 'm', 'n',
    	'o', 'ò', 'ỏ', 'õ', 'ó', 'ọ',
    	'ô', 'ồ', 'ổ', 'ỗ', 'ố', 'ộ',
    	'ơ', 'ờ', 'ở', 'ỡ', 'ớ', 'ợ',
    	'p', 'q', 'r', 's', 't',
     	'u', 'ù', 'ủ', 'ũ', 'ú', 'ụ',
    	'ư', 'ừ', 'ử', 'ữ', 'ứ', 'ự',
    	'v', 'w', 'x',
    	'y', 'ỳ', 'ỷ', 'ỹ', 'ý', 'ỵ',
    	'z');

    private static $tblAllLettersUpper = Array (
    	'A', 'À', 'Ả', 'Ã', 'Á', 'Ạ',
    	'Ă', 'Ầ', 'Ẳ', 'Ẵ', 'Ắ', 'Ặ',
    	'Â', 'Ầ', 'Ẩ', 'Ẫ', 'Ấ', 'Ậ',
    	'B', 'C', 'D', 'Đ',
    	'E', 'È', 'Ẻ', 'Ẽ', 'É', 'Ẹ',
    	'Ê', 'Ề', 'Ể', 'Ễ', 'Ế', 'Ệ',
        'F', 'G', 'H',
    	'I', 'Ì', 'Ỉ', 'Ĩ', 'Í', 'Ị',
    	'J', 'K', 'L', 'M', 'N',
    	'O', 'Ò', 'Ỏ', 'Õ', 'Ó', 'Ọ',
    	'Ô', 'Ồ', 'Ổ', 'Ỗ', 'Ố', 'Ộ',
    	'Ơ', 'Ờ', 'Ở', 'Ỡ', 'Ớ', 'Ợ',
    	'P', 'Q', 'R', 'S', 'T',
     	'U', 'Ù', 'Ủ', 'Ũ', 'Ú', 'Ụ',
    	'Ư', 'Ừ', 'Ử', 'Ữ', 'Ứ', 'Ự',
    	'V', 'W', 'Z',
    	'Y', 'Ỳ', 'Ỷ', 'Ỹ', 'Ý', 'Ỵ',
    	'Z');

    private static $toneMarkRemovalSearches = NULL;
    private static $toneMarkRemovalReplaces = NULL;
    private static $tblToneMarkRemoval = Array(
        'À' => 'A', 'à' => 'a',
        'Ả' => 'A', 'ả' => 'a',
        'Ã' => 'A', 'ã' => 'a',
		'Á' => 'A', 'á' => 'a',
        'Ạ' => 'A', 'ạ' => 'a',
        'Ằ' => 'Ă', 'ằ' => 'ă',
        'Ẳ' => 'Ă', 'ẳ' => 'ă',
        'Ẵ' => 'Ă', 'ẵ' => 'ă',
        'Ắ' => 'Ă', 'ắ' => 'ă',
        'Ặ' => 'Ă', 'ặ' => 'ă',
        'Ầ' => 'Â', 'ầ' => 'â',
        'Ẩ' => 'Â', 'ầ' => 'â',
        'Ẫ' => 'Â', 'ẫ' => 'â',
        'Ấ' => 'Â', 'ấ' => 'â',
        'Ậ' => 'Â', 'ậ' => 'â',
        'È' => 'E', 'è' => 'e',
        'Ẻ' => 'E', 'ẻ' => 'e',
        'Ẽ' => 'E', 'ẻ' => 'e',
        'É' => 'E', 'é' => 'e',
        'Ẹ' => 'E', 'é' => 'e',
        'Ề' => 'Ê', 'ề' => 'ê',
        'Ể' => 'Ê', 'ể' => 'ê',
        'Ễ' => 'Ê', 'ễ' => 'ê',
        'Ế' => 'Ê', 'ế' => 'ê',
        'Ệ' => 'Ê', 'ế' => 'ê',
        'Ì' => 'I', 'ì' => 'i',
        'Ỉ' => 'I', 'ỉ' => 'i',
        'Ĩ' => 'I', 'ĩ' => 'i',
        'Í' => 'I', 'í' => 'i',
        'Ị' => 'I', 'ị' => 'i',
        'Ò' => 'O', 'ò' => 'o',
        'Ỏ' => 'O', 'ỏ' => 'o',
        'Õ' => 'O', 'õ' => 'o',
        'Ó' => 'O', 'ó' => 'o',
        'Ọ' => 'O', 'ọ' => 'o',
        'Ồ' => 'Ô', 'ồ' => 'ô',
        'Ổ' => 'Ô', 'ồ' => 'ô',
        'Ỗ' => 'Ô', 'ỗ' => 'ô',
        'Ố' => 'Ô', 'ố' => 'ô',
        'Ộ' => 'Ô', 'ộ' => 'ô',
        'Ờ' => 'Ơ', 'ờ' => 'ơ',
        'Ở' => 'Ơ', 'ở' => 'ơ',
        'Ỡ' => 'Ơ', 'ỡ' => 'ơ',
        'Ớ' => 'Ơ', 'ớ' => 'ơ',
        'Ợ' => 'Ơ', 'ợ' => 'ơ',
        'Ù' => 'U', 'ù' => 'u',
        'Ủ' => 'U', 'ù' => 'u',
        'Ũ' => 'U', 'ũ' => 'u',
        'Ú' => 'U', 'ú' => 'u',
        'Ụ' => 'U', 'ú' => 'u',
        'Ừ' => 'Ư', 'ừ' => 'ư',
        'Ử' => 'Ư', 'ừ' => 'ư',
        'Ữ' => 'Ư', 'ữ' => 'ư',
        'Ứ' => 'Ư', 'ứ' => 'ư',
        'Ự' => 'Ư', 'ự' => 'ư',
        'Ỳ' => 'Y', 'ỳ' => 'y',
        'Ỷ' => 'Y', 'ỷ' => 'y',
        'Ỹ' => 'Y', 'ỹ' => 'y',
        'Ý' => 'Y', 'ý' => 'y',
        'Ỵ' => 'Y', 'ỵ' => 'y');

    private static $deVietnameseSearches = NULL;
    private static $deVietnameseReplaces = NULL;
    private static $tblDeVietnamese = Array(
    	'À' => 'A', 'à' => 'a',
    	'Ả' => 'A', 'ả' => 'a',
        'Ã' => 'A', 'ã' => 'a',
     	'Á' => 'A', 'á' => 'a',
     	'Ạ' => 'A', 'ạ' => 'a',
     	'Ă' => 'A', 'ă' => 'a',
     	'Ằ' => 'A', 'ằ' => 'a',
     	'Ẳ' => 'A', 'ẳ' => 'a',
     	'Ẵ' => 'A', 'ẵ' => 'a',
     	'Ắ' => 'A', 'ắ' => 'a',
     	'Ặ' => 'A', 'ặ' => 'a',
     	'Â' => 'A', 'â' => 'a',
     	'Ầ' => 'A', 'ầ' => 'a',
     	'Ẩ' => 'A', 'ẩ' => 'a',
     	'Ẫ' => 'A', 'ẫ' => 'a',
     	'Ấ' => 'A', 'ấ' => 'a',
     	'Ậ' => 'A', 'ậ' => 'a',
    	'Đ' => 'D', 'đ' => 'd',
    	'È' => 'E', 'è' => 'e',
     	'Ẻ' => 'E', 'ẻ' => 'e',
     	'Ẽ' => 'E', 'ẽ' => 'e',
     	'É' => 'E', 'é' => 'e',
     	'Ẹ' => 'E', 'ẹ' => 'e',
     	'Ê' => 'E', 'ê' => 'e',
     	'Ề' => 'E', 'ề' => 'e',
     	'Ể' => 'E', 'ể' => 'e',
     	'Ễ' => 'E', 'ễ' => 'e',
     	'Ế' => 'E', 'ế' => 'e',
     	'Ệ' => 'E', 'ệ' => 'e',
    	'Ì' => 'I', 'ì' => 'i',
     	'Ỉ' => 'I', 'ỉ' => 'i',
     	'Ĩ' => 'I', 'ĩ' => 'i',
     	'Í' => 'I', 'í' => 'i',
     	'Ị' => 'I', 'ị' => 'i',
     	'Ò' => 'O', 'ò' => 'o',
     	'Ỏ' => 'O', 'ỏ' => 'o',
     	'Õ' => 'O', 'õ' => 'o',
     	'Ó' => 'O', 'ó' => 'o',
     	'Ọ' => 'O', 'ọ' => 'o',
     	'Ô' => 'O', 'ô' => 'o',
     	'Ồ' => 'O', 'ồ' => 'o',
     	'Ổ' => 'O', 'ổ' => 'o',
     	'Ỗ' => 'O', 'ỗ' => 'o',
     	'Ố' => 'O', 'ố' => 'o',
     	'Ộ' => 'O', 'ộ' => 'o',
     	'Ơ' => 'O', 'ơ' => 'o',
     	'Ờ' => 'O', 'ờ' => 'o',
     	'Ở' => 'O', 'ở' => 'o',
     	'Ỡ' => 'O', 'ỡ' => 'o',
     	'Ớ' => 'O', 'ớ' => 'o',
     	'Ợ' => 'O', 'ợ' => 'o',
    	'Ù' => 'U', 'ù' => 'u',
     	'Ủ' => 'U', 'ủ' => 'u',
     	'Ũ' => 'U', 'ũ' => 'u',
     	'Ú' => 'U', 'ú' => 'u',
     	'Ụ' => 'U', 'ụ' => 'u',
     	'Ư' => 'U', 'ư' => 'u',
     	'Ừ' => 'U', 'ừ' => 'u',
     	'Ử' => 'U', 'ử' => 'u',
     	'Ữ' => 'U', 'ữ' => 'u',
     	'Ứ' => 'U', 'ứ' => 'u',
     	'Ự' => 'U', 'ự' => 'u',
     	'Ỳ' => 'Y', 'ỳ' => 'y',
     	'Ỷ' => 'Y', 'ỷ' => 'y',
     	'Ỹ' => 'Y', 'ỹ' => 'y',
     	'Ý' => 'Y', 'ý' => 'y',
     	'Ỵ' => 'Y', 'ỵ' => 'y');

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

        self::$deVietnameseSearches = Array();
        self::$deVietnameseReplaces = Array();
        foreach ( self::$tblDeVietnamese as $key => $value ) {
            self::$deVietnameseSearches[] = $key;
            self::$deVietnameseReplaces[] = $value;
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
     * De-Vietnameses a string.
     *
     * @param string
     * @return string the string after de-Vietnamesed
     */
    public function deVietnamese($str) {
        if ( !is_string($str) ) {
            return $str;
        }
        return str_replace(self::$deVietnameseSearches,
        self::$deVietnameseReplaces, $str);
    }

    /**
     * Removes tone marks from a string.
     *
     * @param string
     * @return string the string after removing tone marks
     */
    public function removeToneMarks($str) {
        if ( !is_string($str) ) {
            return $str;
        }
        return str_replace(self::$toneMarkRemovalSearches,
        self::$toneMarkRemovalReplaces, $str);
    }

    /**
     * Makes a string lower-case.
     *
     * @param string
     * @return string the string after lower-cased
     */
    public function toLower($str) {
        if ( !is_string($str) ) {
            return $str;
        }
        return str_replace(self::$tblAllLettersUpper, self::$tblAllLettersLower, $str);
    }

    /**
     * Makes a string upper-case.
     *
     * @param string
     * @return string the string after upper-cased
     */
    public function toUpper($str) {
        if ( !is_string($str) ) {
            return $str;
        }
        return str_replace(self::$tblAllLettersLower, self::$tblAllLettersUpper, $str);
    }
}
?>