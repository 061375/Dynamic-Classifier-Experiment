<?php
/*****************************************************************

*
*	Database.class.php
*	Connects to Deletes, Adds and Edits Data in the database specified
*
*/

class Database
{
	private $errors;
	private $db;
	function __construct( $options )
	{
		$host		= isset($options['host'])	    ? $options['host']      : 'localhost';
        $port       = isset($options['port'])       ? $options['port']      : '3306';
		$user		= isset($options['user'])	    ? $options['user']      : '';
		$password	= isset($options['password'])   ? $options['password']	: '';
		$database	= isset($options['database'])	? $options['database']	: '';
		// connect to the server
        try {
            $this->db = new PDO(
                'mysql:host='.$host.';dbname='.$database.';port='.$port,
                $user,
                $password
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }	
    }
    function Query($s,$v = array(),$flags = false)
    {
        try {
            $q = $this->db->prepare($s);
	    //echo '<pre>';print_r($s );exit();/*REMOVE ME*/
            $q->execute($v);
            if(false !== $flags) {
                $re = array();
                foreach($flags as $flag) {
                    if(false !== method_exists($this,$flag))
                    $re[$flag] = $this->$flag($q);
                }
                return $re;
            }else{
                return $q;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    function lastId($q)
    {
        return $this->db->lastInsertId();
    }
    function FetchAssoc($q)
    {
        return $q->fetchAll();
    }
    function NumRows($q)
    {
        return $q->rowCount();
    }
    function RowsAffected($q)
    {
        return $q->rowCount($q);
    }
    function FetchResult($s,$k,$v = array(),$else = false)
    {
        $result = $this->Query($s,$v,array('FetchAssoc'));
        return isset($result['FetchAssoc'][0][$k]) ? $result['FetchAssoc'][0][$k] : $else;
    }
    function FetchArray($s)
    {
        $return = array();
        if(is_resource($s)) {
            while($row = $this->FetchAssoc($s)) {
                $return[] = $row;
            }
        }
        return $return;
    }
}
?>