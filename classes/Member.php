<?php
//Parminder Singh
//Member.php
//3/1/18


/**
 *Member class to make members, this is option for non premmium members.
 * It takes basic data from the data.
 *
 * @author Parminder Singh
 * @copyright 2018
 */

class Member
{
    //fields
    protected $first;
    protected $last;
    protected $age;
    protected $gender;
    protected $state;
    protected $phone;
    protected $email;
    protected $seeking;
    protected $biography;


    /**
     * Member constructor, get and set the following variables from the form
     * @param $first
     * @param $last
     * @param $age
     * @param $gender
     * @param $phone
     */
    function __construct($first, $last, $age, $gender, $phone)
    {
        $this->first = $first;
        $this->last = $last;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    /**
     * Gets the first name
     * @return mixed
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * To set the first name
     * @param  $first
     */
    public function setFirst($first)
    {
        $this->first = $first;
    }

    /**
     * To Get the last name
     * @return last name
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * To Set the last name
     * @param  $last
     */
    public function setLast($last)
    {
        $this->last = $last;
    }

    /**
     * To Get the age
     * @return age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * To set the age, sets only if age is non negative and numeric.
     * @param mixed $age
     */
    public function setAge($age)
    {
        if (is_numeric($age) && $age > 0)
            $this->age = $age;
        else
            $this->age ="";
    }

    /**
     * It gets the gender
     * @return gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * It sets the gender
     * @param  $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * It gets the phone number
     * @return phone number
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * To set the phone number only if it is numeric empty string otherwise.
     * @param  $phone
     */
    public function setPhone($phone)
    {
        if (is_numeric($phone))
            $this->phone = $phone;
        else
            $this->phone = "";
    }

    /**
     * To get the email
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * To set the email only if it is a valid email address using the filter_var function
     * @param  $email
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $this->email = "";
        else
            $this->email = $email;
    }

    /**
     * To get the seeking
     * @return seeking
     */
    public function getSeeking()
    {
        return $this->seeking;
    }

    /**
     * To set the seeking
     * @param  $seeking
     */
    public function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }

    /**
     * Gets the bio
     * @return bio
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Sets the bio
     * @param mixed $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * Gets the state
     * @return state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Sets the state
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

}