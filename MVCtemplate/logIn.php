<?php
require_once('Models/UserDataSet.php');
$view = new stdClass();
// Set the page title to Log In
$view->pageTitle = 'Log In';
$view->loggedin = "not logged in";
$userDataSet = new UserDataSet();
// Start Session
session_start();

if (isset($_POST["loginButton"])) {
    // login button was pressed create a session
    $searchData = $_POST['email'];
    $password=$_POST['password'];

    $view->userDataSet = $userDataSet->searchUsers($searchData);

    foreach ($view->userDataSet as $UserData) {
        $pWordCompare=$UserData->getPassword();
        if($pWordCompare==$password) {
            $_SESSION["loggedin"] = true;
            $_SESSION["name"] = $UserData->getName();
            $_SESSION["email"] = $UserData->getEmail();
            $_SESSION["auctioneer"] = $UserData->getOwnsAuction();
            header("Location: index.php");
        }
        else {
            // If email and password do not match what is on the staff database then post error
            echo '<script>alert("Incorrect Email/Password")</script>';
            $_SESSION['loggedin'] = false;
        }
    }
}

require_once('Views/logIn.phtml');

