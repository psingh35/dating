<?php
//parminder singh
//Premium.php


/**
 *
 * This class is used to make a primum member
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

    function __construct($first, $last, $age, $gender, $phone)
    {
        parent::__construct($first, $last, $age, $gender, $phone);
    }

    /**
     * @return mixed
     */
    public function getIndoor()
    {
        return $this->_indoor;
    }

    /**
     * @param mixed $indoor
     */
    public function setIndoor($indoor)
    {
        $this->_indoor = $indoor;
    }

    /**
     * @return mixed
     */
    public function getOutdoor()
    {
        return $this->_outdoor;
    }

    /**
     * @param mixed $outdoor
     */
    public function setOutdoor($outdoor)
    {
        $this->_outdoor = $outdoor;
    }

}