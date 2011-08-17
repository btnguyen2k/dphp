<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * "as-is" parameter for {@link Ddth_Dao_SqlStatement::prepare()}.
 *
 * LICENSE: See the included license.txt file for detail.
 *
 * COPYRIGHT: See the included copyright.txt file for detail.
 *
 * @package     Dao
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @version     $Id$
 * @since       File available since v0.2.4
 */

/**
 * "as-is" parameter for {@link Ddth_Dao_SqlStatement::prepare()}.
 *
 * Method {@link Ddth_Dao_SqlStatement::prepare()} will use the parameter's value
 * "as-is", e.g. no quotes are automatically added even if the value is of type string.
 *
 * @package     Dao
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since      	Class available since v0.2.4
 */
class Ddth_Dao_ParamAsIs {

    private $value = NULL;

    public function __construct($value = NULL) {
        $this->value = $value;
    }

    /**
     * Gets the parameter's value.
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
}
?>
