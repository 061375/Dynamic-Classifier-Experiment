<?php 
class Angles {
	/** 
	 * @param array
	 * @param string for debugging only
	 * */
	public static function right($data,$key='') {
//if($key == '1551113338')echo '<pre>';print_r($data);die('END OF DUMP');
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
	/** 
	 * @param array
	 * @param string for debugging only
	 * */
	public static function slope($data,$key='') {
		global $AngleTemplates;

		$count = 0;
		$l = count($data);
		for($y = 0;$y<$l;$y++) {
            for($x=0;$x<$l;$x++) {
            	if(isset($data[$y][$x]['pixel'])) {
            		foreach ($AngleTemplates as $template) {

            			$found = 0;
	            		for($yy=0;$yy<3;$yy++) {
	            			for($xx=0;$xx<3;$xx++) {
	            				if(isset($data[$yy+$y][$xx+$x]['pixel']) AND $data[$yy+$y][$xx+$x]['pixel'] == $template[$yy][$xx])
	            					$found++;
	            			}
	            		}
	            		if($found ==3)
	            			$count++;
	            		$found = 0;
	            	}
            	}else{
            		foreach ($AngleTemplates as $template) {
            			//echo '<pre>';print_r($template);die('END OF DUMP');
            			$found = 0;
	            		for($yy=0;$yy<3;$yy++) {
	            			for($xx=0;$xx<3;$xx++) {
	            				//echo $data[$yy+$y][$xx+$x].' '.$template[$yy][$xx]."\n";
	            				if(isset($data[$yy+$y][$xx+$x]) AND $data[$yy+$y][$xx+$x] == $template[$yy][$xx])
	            					$found++;
	            			}
	            		}
	            		if($found ==3)
	            			$count++;
	            		$found = 0;
	            	}
            	}
            }
        }
        //if($key=='1551112647')echo '<pre>';print_r($count);die('END OF DUMP');
        return $count;
	}
}