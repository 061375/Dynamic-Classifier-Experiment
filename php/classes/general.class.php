<?php 
class General {
	public static function mergeAll($data,$img) {
        $return = [];
        //echo '<pre>';print_r($data);die('END OF DUMP');
        foreach ($data[0] as $key => $value) {
            //$return[$key]['count'] = round(($data[1][$key]['count'] + $value['count']),2);
            //$return[$key]['count'] = round(($data[1][$key]['count'] + $value['count']) / count($data[0]),2);
            $return[$key]['count'] = $value['count'] . " : " . $data[1][$key]['count']; 
        }
        foreach ($img as $key => $value) {
        	$return[$key]['img'] = $value;
        }
        
        return $return;
    }	
    /** 
     * @param array
     * @param boolean
     * @return array
     * */
    public static function buildImage($data,$pixel = false) {
        $re = [];
        while ($row = $data->fetchArray()) {
            $i = 0;
            $re[$row['iid']] = [];
            for($y=0;$y<12;$y++) {
                for($x=0;$x<12;$x++) {
                    if(false === $pixel) {
                        $re[$row['iid']][$y][$x] = $row['c'.$i];
                    }else{
                        $re[$row['iid']][$y][$x]['pixel'] = $row['c'.$i];
                    }
                    $i++;
                }   
            }
        }
        return $re;
    }
    /** 
     * @param array
     * @param bool
     * @return string
     * */
    public static function makeInsertImage($data,$iid = false) {
        if(false === $iid)
            $iid = strtotime('now');

        $c = 0;
        $sql = "INSERT INTO data2 ";
        $cols = "(iid,cid,certainty,";
        $vals = "(".$iid.",0,100,";

        for($y=0;$y<12;$y++) {
            for($x=0;$x<12;$x++) {
                $cols.="c".$c.",";
                $vals.=$data[$y][$x].",";
                $c++;
            }
        }
        $cols = substr($cols,0,strlen($cols)-1);
        $vals = substr($vals,0,strlen($vals)-1);
        $sql .= $cols.") VALUES ".$vals.")";

        return $sql;
    }
    /** 
     * 
     * */
    public static function numRows($data) {
        $nrows = 0;
        $data->reset();
        while ($data->fetchArray())
            $nrows++;
        $data->reset();
        return $nrows;
    }
}
