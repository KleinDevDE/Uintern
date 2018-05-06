<?php
function updatePassword($type, $password)
{
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql->exec("UPDATE accounts SET password='".$password."' WHERE account_type='".$type."';");
}

function setRepresentationPlan($date, $class, $hour, $subject, $room, $note)
{

}

function cleanUpDatabase($olderThanDays)
{

}

function upload()
{

}