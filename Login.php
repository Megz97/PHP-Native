<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
    <link href="style.css" rel="stylesheet">
    <style>
      .testbox {
        height: 290px;
        margin-top: 12%;
      }
      input[type=password]{
         margin-bottom: 25px;
      }
    </style>

</head>
<body>


<?php
$errArray=[];
require_once "check.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $errArray=checkForm($_POST);

  if (sizeof($errArray)==0)
  {
      require_once "DB.php";
      $db=new MysqlAdapter();
      $errArray=checkLogin($_POST['Email'],$_POST['Password']);
      if (sizeof($errArray)==0)
      {
        header("Location: ShowUsers.php");
      }
  }
}
?>


<div class="testbox">
  <h1>Login</h1>

  <form name="myform" method="post" action="Login.php">
      <hr>

  <label id="icon" for="name">Email</label>
  <input type="text" name="Email" id="name" placeholder="Email" /><span><?php if (isset($errArray['Email'])) echo $errArray['Email'] ?></span>
  <label id="icon" for="name">Password</label>
  <input type="password" name="Password" id="name" placeholder="Password" /><span><?php if (isset($errArray['Password'])) echo $errArray['Password'] ?></span>
   <input type="submit" class="button" value="submit" id="submitButoon" ><br><br>
    <a style="color: Blue; margin-left: 25%;" href="Register.php">I dont have an Account</a>

  </form>
</div>
</body>
</html>