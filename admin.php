<?php
ob_start();
session_start();
include "includes/header.php";


if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    // echo 'in';
    include("adminPanel.php");
}else{
    include("login.php");
}


?>