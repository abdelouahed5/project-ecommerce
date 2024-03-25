<?php
try
{
$chaine="mysql:host=localhost;dbname=ecomerce-app";
$user="root";
$pass="";


$db=new PDO($chaine,$user,$pass);


}
catch(PDOException $ex)
{
    die($ex->getMessage());
}
