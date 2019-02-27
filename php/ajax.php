<?php
require_once('config.php');
$classes = array_diff(scandir(getcwd().'/classes/'), array('..', '.'));
foreach ($classes as $class) {
    require_once(getcwd().'/classes/'.$class);
}
// get the database 
$db = new DB(getcwd().'/../data/data.db');
if(false === $db)
    die(json_encode([
        'success'=>0,
        'error'=>Errors::get_errors()
    ]));

$method = isset($_POST['method']) ? $_POST['method'] : false;
if(false === $method) {
    die('method is required');    
}

$data = isset($_POST['data']) ? $_POST['data'] : [];

if(!function_exists($method)) {
    die('method does not exist');
}

$result = $method($data);
if(false === $result) {
    die(json_encode([
        'success'=>0,
        'error'=>Errors::get_errors()
    ]));
}else{
    die(json_encode([
        'success'=>1,
        'message'=>$result
    ]));
}

// --- WRAPPERS

function setFirst($data) {
    $data = isset($data['sample']) ? $data['sample'] : false;
    First::set($data);
    return true;
}

function setTrain($data) {
    $data = isset($data['sample']) ? $data['sample'] : false;

    $results = [];
    $samples = [];
    $img = [];
    
/*
    $alldata = Data::getAll();
    $all = [];
    $c = 0;
    while ($row = $alldata->fetchArray()) {
        if(!isset($all[$row['iid']])) {
            $c = 0;
            $all[$row['iid']] = [
                'iid'=>$row['iid'],
                'cid'=>0,
                'certainty'=>100,
                'c0'=>$row['pixel']
            ];
        }else{
            $c++;
            $all[$row['iid']]['c'.$c] = $row['pixel'];
        }
    }

    global $db;
    foreach ($all as $iid => $row) {
        $sql = "INSERT INTO data2 ";
        $cols = "";
        $vals = "";
        foreach ($row as $column => $value) {
            $cols.=$column.",";
            $vals.=$value.",";
        }
        $cols = substr($cols,0,strlen($cols)-1);
        $vals = substr($vals,0,strlen($vals)-1);
        $sql .= "(".$cols.") VALUES (".$vals.")";
        //echo '<pre>';print_r($sql);die('END OF DUMP');
        $db->query($sql);
    }

    // get the samples
    $s = Data::getAll();
    while ($row = $s->fetchArray()) {
        $img[$row['iid']][$row['y']][$row['x']] = $row['pixel'];
        $samples[$row['iid']][$row['y']][$row['x']]['pixel'] = $row['pixel'];
    }
*/

    $s = Data::getAll();
    $img = General::buildImage($s);
    $samples = General::buildImage($s,true);

    $results[] = First::train($data,$samples);

    $results[] = Second::train($data,$samples);
//echo '<pre>';print_r($results);die('END OF DUMP');
    $return = General::mergeAll($results,$img);

    return $return;
}
