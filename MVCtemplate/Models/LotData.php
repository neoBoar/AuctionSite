<?php


class LotData implements JsonSerializable
{
    // private fields
    private $LotID, $ItemMake, $ItemModel, $ModelYear, $ModelColour, $Image, $AuctionID, $Bid, $bidUser, $live, $auctionEnd;

    // constructor
    public function __construct($dbRow)
    {                 // constructor
        $this->LotID = $dbRow['LotID'];
        $this->ItemMake = $dbRow['itemMake'];
        $this->ItemModel = $dbRow['itemModel'];
        $this->ModelYear = $dbRow['modelYear'];
        $this->ModelColour = $dbRow['modelColour'];
        $this->Image = $dbRow['Image'];
        $this->AuctionID = $dbRow['AuctionID'];
        $this->Bid = $dbRow['bid'];
        $this->bidUser = $dbRow['bidUser'];
        $this->live = $dbRow['live'];
        $this->auctionEnd = $dbRow['auctionEnd'];

    }
    // required function as class implies JsonSerializable
    // returns fields when called by JSON.parse
    public function jsonSerialize()
    {
        return [
            '_id' => $this->LotID,
            '_title' => $this->ItemMake,
            '_model' => $this->ItemModel,
            '_year' => $this->ModelYear,
            '_colour' => $this->ModelColour,
            '_image' => $this->Image,
            '_auctionID' => $this->AuctionID,
            '_bid' => $this->Bid,
            '_bidUser' => $this->bidUser,
            '_live' => $this->live,
            '_auctionEnd' => $this->auctionEnd
        ];
    }

    public function getLotID()
    {    // accessor for the id field
        return $this->LotID;
    }
    public function getItemMake()
    {    // accessor for the item make field
        return $this->ItemMake;
    }
    public function getItemModel()
    {    // accessor for the item model field
        return $this->ItemModel;
    }
    public function getModelYear()
    {    // accessor for the model year field
        return $this->ModelYear;
    }
    public function getModelColour()
    {    // accessor for the model colour field
        return $this->ModelColour;
    }
    public function getImage()
    {    // accessor for the image
        return $this->Image;
    }
    public function getAuctionID()
    {    // accessor for the auction id
        return $this->AuctionID;
    }
    public function getCurrentBid()
    {    // accessor for the current bid field
        return $this->Bid;
    }
    public function getCurrentBidUser()
    {    // accessor for the current highest bidder
        return $this->bidUser;
    }
    public function getLive()
    {
        // accessor for the live field
        return $this->live;
    }
    public function getAuctionEnd()
    {
        // accessor for the auction end datetime
        return $this->auctionEnd;
    }
}