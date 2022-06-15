<?php


class AuctionData
{
    // private fields
    private $AuctionID, $AuctionName, $AuctionAddress;

    // constructor
    public function __construct($dbRow)
    {
        $this->AuctionID = $dbRow['AuctionID'];
        $this->AuctionName = $dbRow['AuctionName'];
        $this->AuctionAddress = $dbRow['AuctionAddress'];
    }
    public function getAuctionID()
    {    // accessor for the auction id
        return $this->AuctionID;                // need to write the other accessors
    }
    public function getAuctionName()
    {    // accessor for the auction name
        return $this->AuctionName;                // need to write the other accessors
    }
    public function getAuctionAddress()
    {    // accessor for the auction address
        return $this->AuctionAddress;                // need to write the other accessors
    }
}