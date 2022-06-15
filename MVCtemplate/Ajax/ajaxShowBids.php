<?php

require_once('..\Models\lotsDataSet.php');

// Instantiating new lotsDataSet class
$lotsDataSet = new LotsDataSet();
// Sending _GET data to lotsDataSet to return 1 lot
$lotsDataSet = $lotsDataSet->getOneLot($_GET["_id"]);

// encoding results to JSON
echo json_encode($lotsDataSet);

