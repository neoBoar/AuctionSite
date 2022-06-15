<?php
require_once('Models/AuctionsDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Auctions';
$auctionsDataSet = new AuctionsDataSet();
$_SESSION['loggedin'] = null;
session_start();
if(isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = true;
}

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
}


if (isset($_POST['searchButton'])) {
if(is_numeric($_POST['searchText']))
{
    $_SESSION["SpecListing"] = $_POST['searchText'];
}

    header("Location: lots.php");
}

else {
    $view->auctionsDataSet = $auctionsDataSet->fetchAllAuctions();
}

if(isset($_POST['myAuctions']))
{
    $_SESSION["vmauctionID"] = $_SESSION["auctioneer"];
    header("Location: lots.php");
}

require_once('Views/index.phtml');
?>




