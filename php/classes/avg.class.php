<?php 
class Avg {
	/** 
	 * @param array
	 * */
	public static function first($data, $samples) {
        $scount = count($samples);
		$count = [];
        $return = [];
        //$samples = [];
        //$img = [];

        if(!is_int(SSIZE / 2)) {
            Errors::set_error('const SSIZE must be divisible by 2');
            return false;
        }
        $smin = (SSIZE/2);
/*
        $s = Data::getAll();
        
            while ($row = $s->fetchArray()) {
                $img[$row['iid']][$row['y']][$row['x']] = $row['pixel'];
                $samples[$row['iid']][$row['y']][$row['x']]['pixel'] = $row['pixel'];
            }
*/
            foreach($samples as $key => $sample) {
                foreach($data as $y => $ydata) {
                    foreach($ydata as $x => $value) {
                        $count[$key][$y][$x] = 0;
                        for($yy = ($y-$smin);$yy<$y+SSIZE;$yy++) {
                            for($xx = ($x-$smin);$xx<$x+SSIZE;$xx++) {
                                if(isset($sample[$yy][$xx]) && isset($data[$yy][$xx])) {
                                    if($sample[$yy][$xx]['pixel'] == $value)
                                        $count[$key][$y][$x]++;   
                                }
                            }
                        }
                    }
                }
                
            }
            
            foreach($count as $key => $value) {
                foreach($value as $y => $ydata) {
                    foreach($ydata as $x => $xdata) {
                        if(isset($return[$key])) {
                            $return[$key]['count']+=$xdata;   
                        }else{
                            $return[$key]['count']=$xdata;
                            //$return[$key]['img']=$img[$key];
                            $return[$key]['stats']=$value;
                        }
                    }
                }
            }

        //echo '<pre>';print_r($return);exit();/*REMOVE ME*/
        return $return;
	}
}