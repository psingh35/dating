<?php

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


class database
{
    function connect()
    {
        try {
            $dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD );
            echo "Connected to database!!!";
            return $dbh;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }

    function getMembers()
    {
        global $dbh;

        $sql = "SELECT * FROM Members ORDER BY lname, fname";

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //execute the statement
        $statement->execute();

        //fetch the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
