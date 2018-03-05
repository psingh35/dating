<?php
//parminder singh
function validName($first)
{
    return !empty($first) && ctype_alpha($first);
}

validName($last);

function validAge($age)
{
    return is_numeric($age) && ($age >= 18);
}

function validPhone($phone)
{
    return is_numeric($phone) && strlen($phone)  <= 10;
}


if(!validName($first))
{
    $errors['first'] = "Please enter a valid Name";
}

if(!validName($last))
{
    $errors['last'] = "Please enter a valid Name";
}


if(!validAge($age))
{
    $errors['age'] = "Please enter a valid age";
}

if(!validPhone($phone))
{
    $errors['phone'] = "Please enter a valid Phone Number";
}

if (!isset($gender))
{
    $errors['gender'] = "Please select atleast one";
}


$success = sizeof($errors) == 0;