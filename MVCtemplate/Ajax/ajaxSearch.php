<?php

require_once('..\Models\lotsDataSet.php');

// Instantiating new lotsDataSet class
$lotsDataSet = new LotsDataSet();
// Sending _GET data to lotsDataSet to fetch 6 lots that are like the _GET string
$lotsDataSet = $lotsDataSet->fetchSomeSearchLots($_GET["q"]);

session_start();

// checking token to make sure the call is valid
$token="";
if(isset($_SESSION["ajaxToken"])) {
    $token = $_SESSION["ajaxToken"];
}

if (!isset($_GET["token"]) || $_GET["token"] != $token) {
    $data = new stdClass();
    $data->error = "No data for you";
    echo json_encode($data);
}
else {
    // sending results back through JSON
    echo json_encode($lotsDataSet);
}