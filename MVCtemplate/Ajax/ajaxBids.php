<?php

require_once('..\Models\lotsDataSet.php');

// Instantiating new lotsDataSet class
$lotsDataSet = new LotsDataSet();
// Sending _GET data to lotsDataSet to add bid to lot
$lotsDataSet = $lotsDataSet->addBid($_GET["lID"],$_GET["bid"],$_GET["user"]);

session_start();
$_SESSION['activeBidLot'] = $_GET['lTD'];
$_SESSION['activeBid'] = $_GET['bid'];
$_SESSION['activeBidUser'] = $_GET['user'];

// encoding any results to JSON
echo json_encode($lotsDataSet);

