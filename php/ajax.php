<?php
require_once('config.php');
require_once('error.class.php');
require_once('db.class.php');
require_once('first.class.php');
require_once('knearest.class.php');

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
    return First::train($data);
    return true;
}
