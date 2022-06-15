<?php


require_once('LotData.php');
require_once ('Database.php');
class LotsDataSet
{
    // protected fields
    protected $_dbHandle, $_dbInstance;

    // constructor
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    // returns one lot based on lotID parameter
    public function getOneLot($lotID) {
        {
            $sqlQuery = "SELECT * FROM lots WHERE LotID = $lotID";
        }

        // prepare a PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam("s",$auctionID);
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new LotData($row);
        }
        return $dataSet;
    }

    // changes the currentBid and currentBidUser fields to $bid and $user parameters based off the $lotID parameter
    public function addBid($lotID,$bid,$user) {
        $sqlQuery = "UPDATE lots SET bid = ' $bid ', bidUser = '$user' WHERE LotID = $lotID;";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $sqlQuery;
    }

    // changes the auctionEnd datetime to $auctionEnd parameter based off the $lotID parameter
    // sets the live field to T
    public function startAuction($lotID,$AuctionEnd) {
        $sqlQuery = "UPDATE lots SET live = 'T', auctionEnd = '$AuctionEnd' WHERE LotID = $lotID;";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $sqlQuery;
    }

    // changes the auctionEnd datetime to null parameter based off the $lotID parameter
    // sets the live field to E
    public function endAuction($lotID) {
        $sqlQuery = "UPDATE lots SET live = 'E', auctionEnd = null WHERE LotID = $lotID;";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $sqlQuery;
    }

    // fetches all lots in database whilst joining the auction table data
    public function fetchAllLots() {
        $sqlQuery = "SELECT * FROM lots RIGHT JOIN auctions ON lots.AuctionID = auctions.AuctionID;";  // put your students table name

        // echo $sqlQuery;  //helpful for debugging to see what SQL query has been created

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new LotData($row);
        }
        return $dataSet;  // return an array of StudentData objects
    }

    // fetches 6 lots which are like the $searchText parameter for the live search AJAX call
    public function fetchSomeSearchLots($searchSText) {

        $sqlQuery = "SELECT * FROM lots WHERE ItemMake LIKE ? LIMIT 6";

        $searchText="%".$searchSText."%";

	// prepare a PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1,$searchText);
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new LotData($row);
        }
        return $dataSet;
    }

    // fetch all lots that are like the $searchText parameter for the search button
    public function fetchSomeLots($searchText) {

        $sqlQuery = "SELECT * FROM lots WHERE ItemMake LIKE ?";

        $searchText="%".$searchText."%";

        // prepare a PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1,$searchText);
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new LotData($row);
        }
        return $dataSet;
    }

    // fetch all lots where auctionID matches the $auctionID parameter for the view my auctions and view more auctions systems
    public function fetchAuctionLots($auctionID) {
        {
            $sqlQuery = "SELECT * FROM lots WHERE AuctionID = $auctionID";
        }

        // prepare a PDO statement
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam("s",$auctionID);
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new LotData($row);
        }
        return $dataSet;
    }


}