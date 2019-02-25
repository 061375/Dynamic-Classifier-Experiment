<?php 
class Angles {
	public static function right($data,$key='') {
//if($key == '1551113338')echo '<pre>';print_r($data);die('END OF DUMP');
		$found = [];
		$check = [];
		$smin = (SSIZE/2);
		$l = count($data);
		for($y = 0;$y<$l;$y++) {
            for($x=0;$x<$l;$x++) {
            	if(isset($data[$y][$x]['pixel'])) {
            		if(isset($data[$y][$x]['pixel']) && isset($data[$y-1][$x]['pixel']) && isset($data[$y-2][$x]['pixel'])) {
	            		if($data[$y][$x]['pixel']==1 && $data[$y-1][$x]['pixel']==1 AND $data[$y-2][$x]['pixel']==1) {
	            			$found['y'][$y-2][$x] = 1;
	            			$found['y'][$y-1][$x] = 1;
	            			$found['y'][$y][$x] = 1;
	            		}	
	            	}
	            	if(isset($data[$y][$x]['pixel']) && isset($data[$y][$x-1]['pixel']) && isset($data[$y][$x-2]['pixel'])) {
	            		if($data[$y][$x]['pixel']==1 &&  $data[$y][$x-1]['pixel']==1 AND $data[$y][$x-2]['pixel']==1) {
	            			$found['x'][$y][$x-2] = 1;
	            			$found['x'][$y][$x-1] = 1;
	            			$found['x'][$y][$x] = 1;
	            		}	
	            	}
            	}else{
            		if(isset($data[$y][$x]) && isset($data[$y-1][$x]) && isset($data[$y-2][$x])) {
	            		if($data[$y][$x]==1 && $data[$y-1][$x]==1 AND $data[$y-2][$x]==1) {
	            			$found['y'][$y-2][$x] = 1;
	            			$found['y'][$y-1][$x] = 1;
	            			$found['y'][$y][$x] = 1;
	            		}	
	            	}
	            	if(isset($data[$y][$x]) && isset($data[$y][$x-1]) && isset($data[$y][$x-2])) {
	            		if($data[$y][$x]==1 &&  $data[$y][$x-1]==1 AND $data[$y][$x-2]==1) {
	            			$found['x'][$y][$x-2] = 1;
	            			$found['x'][$y][$x-1] = 1;
	            			$found['x'][$y][$x] = 1;
	            		}	
	            	}
            	}
            }
        }

        //$angles = [];
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
            		//$angles[] = ['y'=>$y,'x'=>$x];
            }
        }
//if($key == '1551113338')echo '<pre>';print_r($angles);die('END OF DUMP');
        return $angles;
	}
}