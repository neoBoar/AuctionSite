<?php

require_once('Models/LotsDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Lots';
$view->loggedin = 'not logged in';
$LotsDataSet = new LotsDataSet();
$_POST['auctionID'] = null;

session_start();
// var_dump($_SESSION);

if(isset($_SESSION["specListing"])) {
    $lotID = $_SESSION["specListing"];
    $view->LotsDataSet = $LotsDataSet->getOneLot($lotID);
}
else if(isset($_GET["0"]))
{
    $lotID = $_GET["0"];
}
else {
    $lotID = $_POST['lotID'];
    $view->LotsDataSet = $LotsDataSet->getOneLot($lotID);
}

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

/**
 * search button click
 */
if (isset($_POST['searchButton'])) {
    // if input is lot ID
    if(is_numeric($_POST['searchText']))
    {
        $lotID = $_POST['searchText'];
        $view->LotsDataSet = $LotsDataSet->getOneLot($lotID);
    }
    else
    $_SESSION["searchTerm"] = $_POST['searchText'];
    // only show records that match the entered search term
    header("Location: lots.php");
}

/**
 * View more auctions button click on the listing page
 */
if(isset($_POST['viewMoreAuctions']))
{
    if(isset($_GET["6"]))
    {
        $_SESSION["vmauctionID"] = $_GET["6"];
        unset($_SESSION["_AuctionID"]);
        header("Location: lots.php");
    }
    else
    {
        $_SESSION["vmauctionID"] = $_POST['viewMoreAuctions'];
        unset($_SESSION["_AuctionID"]);
        header("Location: lots.php");
    }
}

/**
 * MY AUCTIONS button in header click when logged in as Auctioneer
 */
if(isset($_POST['myAuctions']))
{
    unset($_GET["6"]);
    unset($_SESSION["vmauctionID"]);
    unset($_SESSION['_AuctionID']);
    $_SESSION["vMyAuctionID"] = $_SESSION["auctioneer"];
    header("Location: lots.php");
}

require_once('Views/listing.phtml');
?>
