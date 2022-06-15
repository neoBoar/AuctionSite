<?php

require_once('..\Models\lotsDataSet.php');

// Instantiating new lotsDataSet class
$lotsDataSet = new LotsDataSet();
// Sending _GET data to lotsDataSet to set aunctionEND to ''
$lotsDataSet = $lotsDataSet->endAuction($_GET["lotID"]);

session_start();
// encoding any results to JSON
echo json_encode($lotsDataSet);
