<?php 
class Knearest {
	public static function first($data,$samples) {
		$scount = count($samples);
		$count = [];
		//echo '<pre>';print_r($samples);die('END OF DUMP');
		foreach($samples as $key => $sample) {
            foreach($data as $y => $ydata) {
                foreach($ydata as $x => $value) {
                	$count[$key][$y][$x] = 0;
                	$temp = [];
                	foreach($sample as $yy => $yydata) {
                		foreach($yydata as $xx => $samplevalue) {
		                	if($samplevalue['pixel']==1) {
		                    	$temp[] = [
		                    		'pos'=>[$yy,$xx],
		                    		'weight' => self::disToPoint($xx,$yy,$x,$y)
		                    	];
		               		}
		               	}
		            }
		            usort($temp, 'order_by_weight');

		            //echo '<pre>';print_r($temp);die('END OF DUMP');
		            foreach ($temp as $kkk => $vvv) {
		            	if($vvv['weight'] < QSIZE) {
		            		$count[$key][$y][$x]+=$vvv['weight'];
		            	}else{
		            		contnue;
		            	}
		            }
                }
            }  
        }

        //echo '<pre>';print_r($count);die('END OF DUMP');
        $return = [];
        foreach($count as $key => $value) {
            foreach($value as $y => $ydata) {
                foreach($ydata as $x => $xdata) {
                    if(isset($return[$key])) {
                        $return[$key]['count']+=$xdata;   
                    }else{
                        $return[$key]['count']=$xdata;
                    }
                }
            }
        }
        foreach ($return as $key => $value) {
        	//$return[$key]['count'] = ($return[$key]['count'] / $scount);
        }
        //echo '<pre>';print_r($return);die('END OF DUMP');

        return $return;
	}

	public static function disToPoint($x1,$y1,$x2,$y2) {
		return hypot($x2-$x1,$y2-$y1);
	}
}
function order_by_weight($a, $b) {
    return $b['weight'] > $a['weight'] ? -1 : 1;
}