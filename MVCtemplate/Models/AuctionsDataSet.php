<?php


require_once('AuctionData.php');
require_once ('Database.php');
class AuctionsDataSet
{
    // protected fields
    protected $_dbHandle, $_dbInstance;

    // constructor
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    // return all auctions
    public function fetchAllAuctions() {
        $sqlQuery = "SELECT * FROM auctions";  // put your students table name

        // echo $sqlQuery;  //helpful for debugging to see what SQL query has been created

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AuctionData($row);
        }
        return $dataSet;  // return an array of StudentData objects
    }

    // return some auctions where the parameter passed relates to the auctionID
    public function fetchSomeAuctions($searchText)
    {
        if ($searchText == "") {
            $sqlQuery = "SELECT * FROM auctions";
        } else {
            $sqlQuery = "SELECT * FROM auctions 
                        WHERE AuctionName LIKE '$searchText'";
        }
        // prepare a PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam("s", $searchText);
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AuctionData($row);
        }
        return $dataSet;
    }

    // Return the number of lots per auctionID to show on the "lots view button"
    public function fetchLotTotals($auctionID)
    {
        $sqlQuery =    "SELECT count(lotID)
                        AS lot_count
                        FROM lots
                        RIGHT JOIN auctions ON lots.AuctionID = auctions.AuctionID
                        WHERE auctions.AuctionID = '$auctionID'
                        GROUP BY auctions.AuctionID;";
        // prepare a PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam("s", $searchText);
        $statement->execute(); // execute the PDO statement

        $row = $statement->fetch();
        return $sum = $row['lot_count'];
    }
}