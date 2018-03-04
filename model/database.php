<?php
//parminder singh
//2/1/2018
//database.php

//CREATE TABLE `psinghgr_grc`.`Members` ( `member_id` INT(40) NOT NULL AUTO_INCREMENT ,
//`fname` VARCHAR(20) NOT NULL ,
//`lname` VARCHAR(20) NOT NULL ,
//`age` TINYINT(20) NOT NULL ,
//`gender` VARCHAR(20) NOT NULL ,
//`phone` VARCHAR(20) NOT NULL ,
//`email` VARCHAR(40) NOT NULL ,
//`state` VARCHAR(20) NOT NULL ,
//`seeking` VARCHAR(20) NOT NULL ,
//`bio` TEXT NOT NULL ,
//`premium` TINYINT(10) NOT NULL ,
//`image` VARCHAR(20) NOT NULL ,
//`interests` TEXT NOT NULL ,
//PRIMARY KEY (`member_id`)) ENGINE = MyISAM;


/**
 * Database class to interact with the database and insert and retrieve the info to render in html pages.
 * Class Database
 */
class Database
{
    /**
     * Coonect function to connect to the database
     * @return PDO|void
     */
    function connect()
    {
        try {
            $dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD );
            //echo "Connected to database!!!";
            return $dbh;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }

    /**
     * Get function to tget the members it gets the memebers from the database ordered by last name.
     * @return array
     */
    function getMembers()
    {
        global $dbh;

        //select from the members table
        $sql = "SELECT * FROM Members ORDER BY lname, fname";

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //execute the statement
        $statement->execute();

        //fetch the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @param $memberID
     * @param $first
     * @param $last
     * @param $age
     * @param $gender
     * @param $phone
     * @param $email
     * @param $state
     * @param $seeking
     * @param $bio
     * @param $memberP
     * @param $image
     * @param $interests
     * @return bool
     */
    //this Function is used to insert data from the form to members table
    function insertMember($member_id, $first, $last, $age, $gender, $phone, $email, $state, $seeking, $bio, $memberP, $image, $interests)
    {
        global $dbh;

        //insert to db
        $sql = "INSERT INTO Members VALUES (:memberID, :fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

        //prepare statement
        $statement = $dbh->prepare($sql);

        //bind params
        $statement->bindParam(':memberID', $member_id, PDO::PARAM_STR);
        $statement->bindParam(':fname', $first, PDO::PARAM_STR);
        $statement->bindParam(':lname', $last, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $memberP, PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        //execute statement
        $success = $statement->execute();

        //return $success
        return $success;
    }
}
