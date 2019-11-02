<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
    <link href="style.css" rel="stylesheet">

</head>
<body>


<?php
$errArray=[];

require_once "check.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $errArray=checkForm($_POST);

  if (isset($_FILES['Image']['name']) && empty($_FILES['Image']['name'])) {
    $errArray['Image'] = "*err";
  }

  if (sizeof($errArray)==0)
  {
    $photoName=addPhoto($_FILES);
      $_POST['Image']=$photoName;

      require_once "DB.php";
      $db=new MysqlAdapter();
      // $data=['Name'=>'mostafa',"Email"=>"mm@mm.com","password"=>"123456","gender"=>'male',"role"=>'user',"image"=>'img.png'];
      // print_r ($data);
      // echo "<br>";
      // print_r ($_POST);
      $db->insert('users',$_POST);
      header("Location: Login.php");
  }


}
?>


<div class="testbox">
  <h1>Registration</h1>

  <form name="myform" method="post" action="Register.php" enctype="multipart/form-data">
      <hr>

  <label id="icon" for="name">Name</i></label>
  <input type="text" name="Name" id="name" value="<?php echo $_POST['Name']?>" /><span><?php if (isset($errArray['Name'])) echo $errArray['Name'] ?></span>
  <label id="icon" for="name">Email</label>
  <input type="text" name="Email" id="name" value="<?php echo $_POST['Email']?>" /><span><?php if (isset($errArray['Email'])) echo $errArray['Email'] ?></span>
  <label id="icon" for="name">Password</label>
  <input type="password" name="Password" id="name" placeholder="Password" /><span><?php if (isset($errArray['Password'])) echo $errArray['Password'] ?></span>
  <label id="icon" for="name">Photo</i></label>
  <input type="file" class="inputfile" name="Image" id="name" style="width: 105px;"><span><?php if (isset($errArray['Image'])) echo $errArray['Image'] ?></span>
  <div class="gender">
    <input type="radio" value="male" id="male" name="Gender"  <?php if ($_POST['Gender']=='male') { ?> checked <?php } ?> />
    <label for="male" class="radio" chec>Male</label>
    <input type="radio" value="female" id="female" name="Gender"  <?php if ($_POST['Gender']=='female') { ?> checked <?php } ?> />
    <label for="female" class="radio">Female</label> 
   </div> 

   <input type="submit" class="button" value="submit" id="submitButoon" ><br><br>
    <a style="color: Blue; margin-left: 30%;" href="Login.php">I have an Account</a>
  </form>
</div>
</body>
</html>