<?php


class UserData
{
    // private fields
    private $userID, $name, $email, $password, $ownsAuction;

    // constructor
    public function __construct($dbrow) {
        $this->userID=$dbrow['userID'];
        $this->name=$dbrow['name'];
        $this->email=$dbrow['email'];
        $this->password=$dbrow['password'];
        $this->ownsAuction=$dbrow['ownsAuction'];
    }
    public function getUserID()
    {    // accessor for the id field
        return $this->userID;
    }
    public function getName()
    {    // accessor for the name field
        return $this->name;
    }
    public function getEmail()
    {    // accessor for the email field
        return $this->email;
    }
    public function getPassword()
    {    // accessor for the password field
        return $this->password;
    }
    public function getOwnsAuction()
    {    // accessor for the ownsAuction field - Check to see if the user owns an auction
        return $this->ownsAuction;
    }



}