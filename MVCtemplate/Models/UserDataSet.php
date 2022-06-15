<?php


require_once ('UserData.php');
require_once ('Database.php');
class userDataSet
{
    // protected fields
    protected $_dbHandle, $_dbInstance;

    // constructor
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    // return all users
    public function fetchAllUsers()
    {
        $sqlQuery = "SELECT * FROM users";  // put your students table name

        // echo $sqlQuery;  //helpful for debugging to see what SQL query has been created

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new LotData($row);
        }
        return $dataSet;  // return an array of StudentData objects
    }

    // return users where their email matches the parameter
    public function searchUsers($searchData){
        $sqlQuery = "SELECT * FROM users WHERE email='". $searchData."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataset=[];
        while ($row = $statement->fetch()){
            $dataset[] = new userData($row);
        }
        return $dataset;
    }
}
