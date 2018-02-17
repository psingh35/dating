<?php

function validState($state)
{
    global $f3;
    return in_array($state, $f3->get('states'));
}

if (!validState($state))
{
    $errors['state'] = "Please select a valid state";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = "Please enter a valid email";
}

if (!isset($seeking))
{
    $errors['seeking'] = "Please select at least one >";
}

if (empty($biography))
{
    $errors['biography'] = "Please write something about yourself here";
}

$success = sizeof($errors) == 0;