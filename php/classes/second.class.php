<?php 
class Second {
	/** 
     * 
     * */
    public static function train($data,$samples) {
    	$return = [];
        //return Knearest::first($data,$s);
        $aright = Angles::right($data);
        $aslope = Angles::slope($data);
        $acurve = Angles::curve($data);
        foreach ($samples as $key => $value) {
        	//
        	$caright = Angles::right($value,$key);
	        if($aright == $caright) {
	        	$return[$key]['count'] += ($aright * 100);
	        }else{
	        	if(!isset($return[$key]['count']))
	        		$return[$key]['count'] = 0;
	        }

	        //
	        $caslope = Angles::slope($value,$key);
	        //echo $caslope.' :: '.$aslope."\n";
	        if($aslope == $caslope) {
	        	$return[$key]['count'] += ($aslope * 100);
	        }else{
	        	if(!isset($return[$key]['count']))
	        		$return[$key]['count'] = 0;
	        }
	        //
	        $cacurve = Angles::curve($value,$key);
	        //echo $cacurve.' :: '.$acurve."\n";
	        if($acurve == $cacurve) {
	        	$return[$key]['count'] += ($acurve * 100);
	        }else{
	        	if(!isset($return[$key]['count']))
	        		$return[$key]['count'] = 0;
	        }
        }
        return $return;
    }



}