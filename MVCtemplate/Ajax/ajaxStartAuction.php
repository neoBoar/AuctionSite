<?php

require_once('..\Models\lotsDataSet.php');

// Instantiating new lotsDataSet class
$lotsDataSet = new LotsDataSet();
// Sending _GET data to lotsDataSet to change live to 'T' and add the end date to the lot
$lotsDataSet = $lotsDataSet->startAuction($_GET["lotID"],$_GET["aEnd"]);

session_start();

// encoding any results to JSON
echo json_encode($lotsDataSet);

