<?php

$host='localhost';
$user='root';
$dbpassword=//password;
$database=//dbname;

$conn= mysqli_connect($host,$user,$dbpassword,$database);

if(!$conn){
    die("Connection failed" .mysqli_connect_error());
}