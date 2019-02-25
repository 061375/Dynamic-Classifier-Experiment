<?php
/**
 *  
 *  Errors
 *  @author By Jeremy Heminger <contact@jeremyheminger.com>
 *  @copyright © 2013 to present 
 *
 * */

class Errors 
{
    /**
     * Get Error messages
     *
     * @return array
     */
    public static function get_errors() {
        if (count($GLOBALS['errors']) > 0) {
            $tmp = $GLOBALS['errors'];
            $GLOBALS['errors'] = array();
            return $tmp;
        }
        return array();
    }
    // --------------------------------------------------------------------
    /**
     * Set Error messages
     * @param string $message
     * @return array
     */
    public static function set_error($message)
    {
        if ($message != '') {
            $GLOBALS['errors'][] = $message;
        }
    }
	
    // --------------------------------------------------------------------

    /**
     * Has Error
     * @return array
     */
    public static function has_error()
    {
        if (isset($GLOBALS['errors'])) {
            if (count($GLOBALS['errors']) > 0) {
                return true;
            }
        }
        return false;
    }
}