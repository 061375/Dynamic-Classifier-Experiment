<?php
class First {
    /** 
     * 
     * */
    public static function train($data,$s) {
        return Avg::first($data,$s);
    }
    /**
     * Simply storing the data unclassified
     * @param array
     * * */
    public static function set($data) {
        $sql = General::makeInsertImage($data); 
        Data::set2($sql);
        /*
        foreach($data as $y => $ydata) {
            foreach($ydata as $x => $value) {
                Data::set($value,$x,$y,$iid);   
            }
        }
        */
    }
}