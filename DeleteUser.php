<?php

session_start();

require_once "DB.php";
$ddb=new MysqlAdapter();
$ID=$_GET['user'];
$query= 'ID='."'$ID'";


$ddb->delete('users',$query);

if($_GET['user']==$_SESSION['ID']){
    header("Location: Register.php");
    session_destroy();
}
else{
    header("Location: ShowUsers.php");
}