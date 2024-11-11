<?php
$host= "localhost";
$user= "root";
$password= "";
$database= "weatherfriend";
$connect= mysqli_connect($host, $user, $password, $database);

if(!$connect)
{
    die('Not Connected'.mysqli_connect_error());
}
session_start();

?>
