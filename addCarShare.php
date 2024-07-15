<?php
require_once('functions.php');
connectdb();

$userid = $_POST["uid"];
$from = $_POST["from"];
$to = $_POST["to"];
$cid = $_POST["cid"];
$query = 'SELECT * FROM offers where id="' . $cid . '"';
$host = "localhost";
$user = "root";
$password = "";
$database = "nuvshare1";
$con = mysqli_connect($host, $user, $password, $database);
//$mysqli = new mysqli("localhost","root","","nuvshare1");
$result = mysqli_query($con, $query) or die("error!!!" . mysqli_connect_error());
$row = mysqli_fetch_array($result);
$timestamp = date("Y-m-d H:i:s");

$sender = $row["uid"];
//pooler waiting for approval from owner

$query = 'INSERT INTO notifications (sender, receiver, type ,cid, timestamp, status) VALUES("' . $userid . '","' . $userid . '", 4, "' . $cid . '","' . $timestamp . '", 0)';

$result = mysqli_query($con, $query) or die("error23!");

//sent for appoval to car owner
$query = 'INSERT INTO notifications (sender, receiver, type ,cid, timestamp, status) VALUES("' . $userid . '","' . $sender . '","1","' . $cid . '","' . $timestamp . '", 0)';

$result = mysqli_query($con, $query) or die("error!45!");
header("Location: index2.php?success=1");
