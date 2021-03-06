<?php
//parminder singh
//2/1/2018
//index.php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

require_once('/home/psinghgr/config.php');
require_once('vendor/autoload.php');
require_once ('model/database.php');


//include "classes/Member.php";
//include "classes/Premium.php";
session_start();

//Create an instance of the Base Class
$f3 = Base :: instance();

//Debug level
$f3->set('DEBUG', 3);

//make an object of database class and call the connect function
$database = new Database();
$dbh = $database->connect();


$f3->route('GET /', function($f3)
{
    $template = new Template();
    echo $template->render('pages/home.html');

});

$f3->route('GET|POST /personal', function($f3)
{
    if (isset($_POST['submit']))
    {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $memberP = $_POST['member'];

        require ('model/validate.php');

        $f3->set('first',$first);
        $f3->set('last',$last);
        $f3->set('age',$age);
        $f3->set('gender',$gender);
        $f3->set('phone',$phone);
        $f3->set('success',$success);
        $f3->set('errors', $errors);
        $_SESSION['memberP'] = $memberP;
        if($success)
        {
            //if the user checked whether the premium was selected or not
            if (isset($memberP))
            {
                $member = new Premium($first, $last, $age, $gender, $phone);
                $_SESSION['member'] = $member;
                //echo $member->getFirst();
                $f3->reroute('/profile');
            }
            if (!isset($memberP))
            {
                $member = new Member($first, $last, $age, $gender, $phone);
                $_SESSION['member'] = $member;
                //echo $member->getFirst();

                //re route to the profile page
                $f3->reroute('/profile');
            }
//            $_SESSION['first'] = $_POST['first'];
//            $_SESSION['last'] = $_POST['last'];
//            $_SESSION['gender'] = $_POST['gender'];
//            $_SESSION['age'] = $_POST['age'];
//            $_SESSION['phone'] = $_POST['phone'];


        }
    }
    $template = new Template();
    echo $template->render('pages/personal.html');

});

//states array
$f3->set('states',array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Washington'));

$f3->route('GET|POST /profile', function($f3)
{
    if (isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $biography = $_POST['biography'];

        require('model/validatepro.php');

        $f3->set('email',$email);
        $f3->set('stateselect',$state);
        $f3->set('seeking',$seeking);
        $f3->set('biography',$biography);
        $f3->set('success',$success);
        $f3->set('errors', $errors);

        if($success)
        {
            $member = $_SESSION['member'];

            $member->setBiography($biography);
            $member->setEmail($email);
            $member->setSeeking($seeking);
            $member->setState($state);

            //if the user selected wheter the preimuim was selected or not
            if ($_SESSION['memberP'] == 'on')
            {
                $f3->reroute('/interests');
            }
            else
            {
                $f3->reroute('/summary');

            }

//            $_SESSION['email'] = $_POST['email'];
//            $_SESSION['state'] = $_POST['state'];
//            $_SESSION['seeking'] = $_POST['seeking'];
//            $_SESSION['biography'] = $_POST['biography'];

        }
    }
    $template = new Template();
    echo $template->render('pages/profile.html');

});

$f3->set('indoor', array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games'));
$f3->set('outdoor', array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing'));

$f3->route('GET|POST /interests', function($f3)
{
    //if submit
    if (isset($_POST['submit']))
    {

        //get outdoor and indoor
        $outdoor = $_POST['outdoors'];
        $indoor = $_POST['indoors'];

        //validate
        require('model/valididateInterest.php');

        $member = $_SESSION['member'];
        $member->setOutdoor($_POST['outdoors']);
        $member->setIndoor($_POST['indoors']);
        $_SESSION['member'] = $member;

        $f3->set('outdoor',$outdoor);
        $f3->set('indoor',$indoor);
        $f3->set('success',$success);
        $f3->set('errors', $errors);
        if ($success)
        {
            $_SESSION['outdoor'] = $_POST['outdoors'];
            $_SESSION['indoor'] = $_POST['indoors'];
            $f3->reroute('/summary');
        }
    }
    //render
    $template = new Template();
    echo $template->render('pages/interests.html');

});

$f3->route('GET|POST /summary', function($f3)
{
     $member = $_SESSION['member'];
    // print_r($member);
     //echo $member->getSeeking();

    $first = $member->getFirst();
    $last = $member->getLast();
    $age = $member->getAge();
    $gender = $member->getGender();
    $state = $member->getState();
    $phone = $member->getPhone();
    $email = $member->getEmail();
    $seeking = $member->getSeeking();
    $bio = $member->getBiography();
    $interest = "";
    //print_r($_SESSION['memberP']);


    if ($_SESSION['memberP'] == 'on')
    {
        //merge array
        $outIn = array_merge($member->getOutdoor(),$member->getIndoor());

        //join and add to a variable
        foreach ($outIn as $in)
        {
            $interest.=$in.", ";
        }

        $database = new Database();
        //insert to memebers
        $database->insertMember(null, $first, $last, $age, $gender, $phone, $email, $state, $seeking, $bio, 0, "", $interest);
        $f3->set('outdoor', $member->getOutdoor());
        $f3->set('indoor', $member->getIndoor());
    }
    else
    {
        $database = new Database();
        //indert to members
        $database->insertMember(null, $first, $last, $age, $gender, $phone, $email, $state, $seeking, $bio, 1, "", $interest);
        $f3->set('outdoor', '');
        $f3->set('indoor', '');
    }

    $f3->set('first', $member->getFirst());
    $f3->set('last', $member->getLast());
    $f3->set('age', $member->getAge());
    $f3->set('gender', $member->getGender());
    $f3->set('phone', $member->getPhone());
    $f3->set('email', $member->getEmail());
    $f3->set('seeking', $member->getSeeking());
    $f3->set('biography', $member->getBiography());
    //session_destroy();

    $template = new Template();
    echo $template->render('pages/summary.html');

});

$f3->route('GET /admin', function($f3, $params) {

    //create obj
    $database = new Database();

    //from the database
    $members = $database->getMembers();
    //set to fatfree variable
    $f3->set('members', $members);


    $template = new Template();
    echo $template->render('pages/adminlogin.html');
});

$f3->route('GET /admin/@lname', function($f3, $params) {

    $database = new database();

    $lname = $params['lname'];

    $member = $database->indiviual($lname);

    $f3->set('member', $member);

    $template = new Template();
    echo $template->render('pages/indiviual.html');
});

//Run fat free
$f3->run();