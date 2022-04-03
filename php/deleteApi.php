<?php

require_once "auth.php";
require_once "adminCrude.php";
require_once "fetchApi.php";
ob_start();
session_start();

if(isset($_POST['bid'])){
    $bid = $_POST['bid'];
    $del = $auth->postDeleter('blogPost', $bid );

    if($del){
        echo 'Post Deleted';

    }else{
        echo 'Error';
    }
}


////to delete user
if(isset($_POST['eid'])){
    $eid = $_POST['eid'];
    $del = $auth->postDeleter('user', $eid );

    if($del){
        echo 'USER REMOVED!';

    }else{
        echo 'Error';
    }
}


if(isset($_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['password'])){
    $fname = $_POST['firstName'];
    $lname =$_POST['lastName'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];

    $update = $admin->updateUserData($_SESSION['id'],$pass,$fname,$lname,$phone);
    if($update){
        echo 'Saved Changes';
    }else{
        echo 'ERROR';
    }
}

if(isset($_FILES['photo'])){
    $name = $_FILES['photo']['name'];
    $temp = $_FILES['photo']['tmp_name'];
    $del = $get->allPostListerOnColumen('user', 'id', $_SESSION['id']);
    $up = $del->fetch_assoc();

    unlink('.'.$up['photoPath1']);
    $off = $admin->updateUserPhoto($name, $temp, $_SESSION['id']);
    if($off){
        echo 'Saved Changes';
    }else{
        echo 'error';
    }
}


?>