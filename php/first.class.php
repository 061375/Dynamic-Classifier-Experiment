<?php
class First {
    public static function train($data) {
        $count = [];
        $return = [];
        $samples = [];
        $img = [];
        $s = Data::getAll();
            while ($row = $s->fetchArray()) {
                $img[$row['iid']][$row['y']][$row['x']] = $row['pixel'];
                $samples[$row['iid']][$row['y']][$row['x']]['pixel'] = $row['pixel'];
            }
            foreach($samples as $key => $sample) {
                foreach($data as $y => $ydata) {
                    foreach($ydata as $x => $value) {
                        $count[$key][$y][$x] = 0;
                        for($yy = ($y-1);$yy<$y+2;$yy++) {
                            for($xx = ($x-1);$xx<$x+2;$xx++) {
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
                            $return[$key]['img']=$img[$key];
                            $return[$key]['stats']=$value;
                        }
                    }
                }
            }
        //echo '<pre>';print_r($return);exit();/*REMOVE ME*/
        return $return;
    }
    /**
     * Simply storing the data unclassified
     * @param array
     * * */
    public static function set($data) {
        $iid = strtotime('now');
        foreach($data as $y => $ydata) {
            foreach($ydata as $x => $value) {
                Data::set($value,$x,$y,$iid);   
            }
        }
        //Data::setMulti($data);
    }
}