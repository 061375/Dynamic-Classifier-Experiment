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
}