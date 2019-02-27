<?php
class DB {
    private $db;
    function __construct($conn) {
        try {
            $this->db = new SQLite3($conn);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
    public function prepare($sql) {
        return $this->db->prepare($sql);
    }
    public function query($sql) {
        return $this->db->query($sql);
    }
}
// no use getting the data in a different way for each algorithm
// lets do this once
class Data {
    public static function get_Count($x,$y) {
        $re = 0;
        $c = self::get($x, $y);
        while ($row = $c->fetchArray()) {
            if($row['pixel']==1)
                $re++;
        }
        return $re;
    }
    /**
     * @param array
     * @param string
     * @return object
     * */
    public static function get($x, $y) {
        global $db;
        $sql = "SELECT * FROM data WHERE x = :x and y = :y";
            $s = $db->prepare($sql);
            $s->bindValue(':x',$x);
            $s->bindValue(':y',$y);
        return $s->execute();
    }
    /**
     * @param array
     * @param string
     * @return object
     * */
    public static function set($pixel, $x, $y, $iid) {
        global $db;
        $sql = "INSERT INTO data (iid,cid,pixel,x,y,certainty) VALUES (:iid,0,:pixel,:x,:y,100)";
            $s = $db->prepare($sql);
            $s->bindValue(':pixel',$pixel);
            $s->bindValue(':x',$x);
            $s->bindValue(':y',$y);
            $s->bindValue(':iid',$iid);
        return $s->execute();
    }
    /**
     * @param array
     * @param string
     * @return object
     * */
    public static function set2($sql) {
        global $db;
        return $db->query($sql);
    }
    /**
     * @param array
     * @param string
     * @return object
     * */
    public static function setMulti($data) {
        global $db;
        $iid = strtotime('now');
        $sql = "";
        foreach($data as $y => $ydata) {
            foreach($ydata as $x => $value) {
                if(1 == $value) 
                    $sql .= "INSERT INTO data (iid,cid,x,y,certainty) VALUES (".$iid.",0,".$x.",".$y.",100);";
            }
        }

        $db->query($sql);
    }
    /**
     * @return object
     * */
    public static function getCount() {
        global $db;
        $sql = "select * from data where cid > 0";
        return $db->query($sql);
    }
    /**
     * @return object
     * */
    public static function getAll() {
        global $db;
        $sql = "select * from data2";
        return $db->query($sql);
    }
}