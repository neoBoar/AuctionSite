<?php

require_once('Models/LotsDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Lots';
$view->loggedin = 'not logged in';
$LotsDataSet = new LotsDataSet();


session_start();
// var_dump($_SESSION);

if (isset($_POST["loginButton"]))
{
    header("Location: logIn.php");
}

if (isset($_POST["logoutButton"]))
{
    unset($_SESSION['loggedin']);
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["auctioneer"]);
    header("Location: index.php");
}

if (isset($_POST['searchButton'])) {
    if(is_numeric($_POST['searchText']) || isset($_SESSION["SpecListing"]))
    {
        $searchTerm = $_POST['searchText'];
        $view->LotsDataSet = $LotsDataSet->getOneLot($searchTerm);
        unset($_SESSION["SpecListing"]);
    }
    else {
        $searchTerm = $_POST['searchText'];
        // only show records that match the entered search term
        $view->LotsDataSet = $LotsDataSet->fetchSomeLots($searchTerm);
    }
}
else if(isset($_SESSION["searchTerm"]))
{
    $searchTerm = $_SESSION["searchTerm"];
    // only show records that match the entered search term
    $view->LotsDataSet = $LotsDataSet->fetchSomeLots($searchTerm);
    unset($_SESSION["searchTerm"]);
}
/**
 * logged in as Auctioneer, clicked My Auctions button in the header
 */
if(isset($_SESSION["auctioneer"]) && isset($_POST['myAuctions'])) {
    $myAuctionID = $_POST['myAuctions'];
    $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($myAuctionID);
}
if(isset($_SESSION["auctioneer"]) && isset($_SESSION["vMyAuctionID"])) {
    $myAuctionID = $_SESSION["vMyAuctionID"];
    $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($myAuctionID);
    unset($_SESSION["vMyAuctionID"]);
}
/**
 * logged in as Auctioneer, click view more auctions button
 */
if(isset($_SESSION["auctioneer"]) && isset($_SESSION["vmauctionID"])) {
        $myAuctionID = $_SESSION["vmauctionID"];
        $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($myAuctionID);
        unset($_SESSION["vmauctionID"]);
        unset($_SESSION['_AuctionID']);
}
/**
 * logged in as Auctioneer, click the search button with search text
 */
if(isset($_SESSION["auctioneer"]) && isset($_POST['auctionID'])){
    $auctionID = $_POST['auctionID'];
    $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($auctionID);
}
else if (isset($_POST['auctionID'])) {
    $auctionID = $_POST['auctionID'];
    $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($auctionID);
}
if(isset($_SESSION["auctioneer"]) && isset($_SESSION['_AuctionID'])){
   $vmauctionID = $_SESSION['_AuctionID'];
   $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($vmauctionID);
   unset($_SESSION['_AuctionID']);
}
else if (isset($_SESSION['_AuctionID'])) {
    $vmauctionID = $_SESSION['_AuctionID'];
    $view->LotsDataSet = $LotsDataSet->fetchAuctionLots($vmauctionID);
    unset($_SESSION['_AuctionID']);
}



require_once('Views/lots.phtml');
?>