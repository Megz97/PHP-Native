<?php

session_start();

require_once "DB.php";
$ddb=new MysqlAdapter();
$ID=$_GET['user'];
$query= 'ID='."'$ID'";


echo "1";
$ddb->delete('users',$query);
echo "2";
echo $_GET['user']."<br>";
echo $_SESSION['ID'];

if($_GET['user']==$_SESSION['ID']){
    header("Location: Register.php");
    session_destroy();
}
else{
    header("Location: ShowUsers.php");
}