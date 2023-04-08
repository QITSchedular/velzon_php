<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use \Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__. '/../../');
$dotenv->load();

$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_name1 = $_ENV['DB_NAME1'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];


$conn=mysqli_connect($db_host,$db_username,$db_password,$db_name) or die($conn);
$conn1=mysqli_connect($db_host,$db_username,$db_password,$db_name1) or die($conn);

    // $conn=mysqli_connect("localhost","root","","quanta1") or die($conn);
    // $conn1=mysqli_connect("localhost","root","","country") or die($conn);
   
?>