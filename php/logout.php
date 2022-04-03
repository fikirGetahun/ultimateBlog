<?php
require_once "auth.php";
ob_start();
session_start();
session_destroy();
$uid = $_SESSION['idz'];

$out = $auth->lastLoged($uid);
header('Location: ../admin/admin.php')
?>