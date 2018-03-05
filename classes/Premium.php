<?php
//parminder singh
//Premium.php
//2/28/18


/**
 *
 * This class is used to make a primium members, when users cheks the premium member checkmark,
 * It extends from the Member class, lets you add outdoor and indoor interests
 *
 * Class Premium
 *
 * @author Parminder Singh
 * @copyright 2018
 */
class Premium extends Member
{
    private $_indoor;
    private $_outdoor;

    /**
     * Premium constructor to get data from the form and pass some to the super class and rest for its own
     * @param $first
     * @param $last
     * @param $age
     * @param $gender
     * @param $phone
     */
    function __construct($first, $last, $age, $gender, $phone)
    {
        parent::__construct($first, $last, $age, $gender, $phone);
    }

    /**
     * To get indoor interests
     * @return indoor interests
     */
    public function getIndoor()
    {
        return $this->_indoor;
    }

    /**
     * To set the indoor interests
     * @param mixed $indoor
     */
    public function setIndoor($indoor)
    {
        $this->_indoor = $indoor;
    }

    /**
     * TO get the outdoor interests
     * @return outdoor interests
     */
    public function getOutdoor()
    {
        return $this->_outdoor;
    }

    /**
     * To set the outdoor interests
     * @param $outdoor
     */
    public function setOutdoor($outdoor)
    {
        $this->_outdoor = $outdoor;
    }
}