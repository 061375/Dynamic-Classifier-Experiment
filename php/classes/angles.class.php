<?php 
/** 
 * @version 1.0.2
 *
 * @note - I think I can do away with right by expanding the $AngleTemplate
 *
 * */
class Angles {
	/** 
	 * 
	 * @param array
	 * @param string for debugging only
	 * */
	public static function right($data,$key='') {

		$found = [];
		$check = [];
		$smin = (SSIZE/2);
		$l = count($data);
		for($y = 0;$y<$l;$y++) {
            for($x=0;$x<$l;$x++) {
            	if(isset($data[$y][$x]['pixel'])) {
            		if(isset($data[$y][$x]['pixel']) AND isset($data[$y-1][$x]['pixel']) AND isset($data[$y-2][$x]['pixel'])) {
	            		if($data[$y][$x]['pixel']==1 AND $data[$y-1][$x]['pixel']==1 AND $data[$y-2][$x]['pixel']==1) {
	            			$found['y'][$y-2][$x] = 1;
	            			$found['y'][$y-1][$x] = 1;
	            			$found['y'][$y][$x] = 1;
	            		}	
	            	}
	            	if(isset($data[$y][$x]['pixel']) AND isset($data[$y][$x-1]['pixel']) AND isset($data[$y][$x-2]['pixel'])) {
	            		if($data[$y][$x]['pixel']==1 AND  $data[$y][$x-1]['pixel']==1 AND $data[$y][$x-2]['pixel']==1) {
	            			$found['x'][$y][$x-2] = 1;
	            			$found['x'][$y][$x-1] = 1;
	            			$found['x'][$y][$x] = 1;
	            		}	
	            	}
            	}else{
            		if(isset($data[$y][$x]) AND isset($data[$y-1][$x]) AND isset($data[$y-2][$x])) {
	            		if($data[$y][$x]==1 AND $data[$y-1][$x]==1 AND $data[$y-2][$x]==1) {
	            			$found['y'][$y-2][$x] = 1;
	            			$found['y'][$y-1][$x] = 1;
	            			$found['y'][$y][$x] = 1;
	            		}	
	            	}
	            	if(isset($data[$y][$x]) AND isset($data[$y][$x-1]) AND isset($data[$y][$x-2])) {
	            		if($data[$y][$x]==1 AND  $data[$y][$x-1]==1 AND $data[$y][$x-2]==1) {
	            			$found['x'][$y][$x-2] = 1;
	            			$found['x'][$y][$x-1] = 1;
	            			$found['x'][$y][$x] = 1;
	            		}	
	            	}
            	}
            }
        }
        $angles = 0;
        $x = count($found['x']);
        $y = count($found['y']);
        if($x>$y) {
        	$loop = $found['x'];	
        }else{
        	$loop = $found['y'];
        }

        foreach ($loop as $y => $ydata) {
        	foreach ($ydata as $x => $xdata) {
            	if(isset($found['x'][$y][$x]) && isset($found['y'][$y][$x])) 
            		$angles++;
            }
        }

        return $angles;
	}
	/** 
	 * @param array
	 * @param string for debugging only
	 * */
	public static function slope($data,$key='') {
		global $AngleTemplates;

		// @var number
		$count = 0;
		// @var number
		$l = count($data);
		// loop the data
		for($y = 0;$y<$l;$y++) {
            for($x=0;$x<$l;$x++) {
            	// stored samples as a key 'pixels'

            	// STORED SAMPLE
            	if(isset($data[$y][$x]['pixel'])) {
            		foreach ($AngleTemplates as $template) {
            			// @var number
            			$found = 0;
            			// loop the angle template variable
	            		for($yy=0;$yy<ASIZE;$yy++) {
	            			for($xx=0;$xx<ASIZE;$xx++) {
	            				// if this is a set key and it matches this coord then add one
	            				if(isset($data[$yy+$y][$xx+$x]['pixel']) AND $data[$yy+$y][$xx+$x]['pixel'] == $template[$yy][$xx])
	            					$found++;
	            			}
	            		}
	            		// a find should match the ASIZE var perfectly
	            		if($found == ASIZE)
	            			$count++;
	            		// reset
	            		$found = 0;
	            	}
            	}else{
            		foreach ($AngleTemplates as $template) {
            			$found = 0;
	            		for($yy=0;$yy<ASIZE;$yy++) {
	            			for($xx=0;$xx<ASIZE;$xx++) {
	            				if(isset($data[$yy+$y][$xx+$x]) AND $data[$yy+$y][$xx+$x] == $template[$yy][$xx])
	            					$found++;
	            			}
	            		}
	            		if($found == ASIZE)
	            			$count++;
	            		$found = 0;
	            	}
            	}
            }
        }

        return $count;
	}
	/** 
	 * @param array
	 * @param string for debugging only
	 * */
	public static function curve($data,$key='') {
		global $CurveTemplates;

		// @var number
		$count = 0;
		// @var number
		$l = count($data);
		// loop the data
		for($y = 0;$y<$l;$y++) {
            for($x=0;$x<$l;$x++) {
            	// stored samples as a key 'pixels'

            	// STORED SAMPLE
            	if(isset($data[$y][$x]['pixel'])) {
            		foreach ($AngleTemplates as $template) {
            			// @var number
            			$found = 0;
            			// loop the angle template variable
	            		for($yy=0;$yy<CSIZE;$yy++) {
	            			for($xx=0;$xx<CSIZE;$xx++) {
	            				// if this is a set key and it matches this coord then add one
	            				if(isset($data[$yy+$y][$xx+$x]['pixel']) AND $data[$yy+$y][$xx+$x]['pixel'] == $template[$yy][$xx])
	            					$found++;
	            			}
	            		}
	            		// a find should match the CSIZE var perfectly
	            		if($found == CSIZE)
	            			$count++;
	            		// reset
	            		$found = 0;
	            	}
            	}else{
            		foreach ($CurveTemplates as $template) {
            			$found = 0;
	            		for($yy=0;$yy<CSIZE;$yy++) {
	            			for($xx=0;$xx<CSIZE;$xx++) {
	            				if(isset($data[$yy+$y][$xx+$x]) AND $data[$yy+$y][$xx+$x] == $template[$yy][$xx])
	            					$found++;
	            			}
	            		}
	            		if($found == CSIZE)
	            			$count++;
	            		$found = 0;
	            	}
            	}
            }
        }
//if($key=='1551200961')echo '<pre>';print_r($count);die('END OF DUMP');
        return $count;
	}
}