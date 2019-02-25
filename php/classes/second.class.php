<?php 
class Second {
	/** 
     * 
     * */
    public static function train($data,$s) {
    	$return = [];
        //return Knearest::first($data,$s);
        $data = Angles::right($data);
        foreach ($s as $key => $value) {
        	$s = Angles::right($value,$key);
        	/*
        	$angles = [];
	        $x = count($data);
	        $y = count($s);
	        if($x>$y) {
	        	$loop = $data;
	        	$_loop = $s;	
	        }else{
	        	$loop = $s;
	        	$_loop = $data;
	        }
	        foreach ($loop as $k => $value) {
	        	if(isset($_loop[$k]))
	        		if($value['x'] == $_loop[$k]['x'] && 
	        			$value['y'] == $_loop[$k]['y']) {
	        				if(isset($return[$key])) {
	        					$return[$key]['count']+=150;
	        				}else{
	        					$return[$key]['count']=150;
	        				}
	        		}
	        }
	        */
	        if($data == $s) {
	        	$return[$key]['count'] = ($data * 100);
	        }else{
	        	$return[$key]['count'] = 0;
	        }
        }
        return $return;
    }



}