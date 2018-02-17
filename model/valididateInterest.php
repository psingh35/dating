<?php

if (!isset($indoor)) //variable selected in interests indoor
{
    $errors['indoor'] = "Please select minimum one indoor activity";
}

if (!isset($outdoor)) //variable selected in interests outdoor
{
    $errors['outdoor'] = "Select minimum one outdoor activity!";
}
$success = sizeof($errors) == 0;

