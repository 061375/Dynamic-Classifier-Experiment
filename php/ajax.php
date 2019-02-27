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

    

    $s = Data::getAll();
    $img = General::buildImage($s);
    $samples = General::buildImage($s,true);

    $results[] = First::train($data,$samples);
//echo '<pre>';print_r($results);die('END OF DUMP');
    $results[] = Second::train($data,$samples);

        

    $return = General::mergeAll($results,$img);

    $t = Data::getImage($data);
    if(General::numRows($t)<1) {
        First::set($data);
    }

    return $return;
}
