<?php

session_start();

require_once "DB.php";

function checkForm($formData)
{
    $errArray=[];

    foreach ($formData as $key=>$value){
        if (isset($formData[$key]) && empty($formData[$key])) {
            $errArray[$key] = "*error";
        }
    }

    return $errArray;

}


function checkLogin($Email , $Password){
    $errArray=[];
    $db=new MysqlAdapter();
    // $db->select('users','Name='.$Name. 'and Email='.$Email);
    $query= 'Email='."'$Email'". ' and Password='. "'$Password'";
    $db->select('users',$query);
    if($user=$db->fetch()){
        print_r ($user);
        $_SESSION['ID']=$user['ID'];
        $_SESSION['Name']=$user['Name'];
        $_SESSION['Email']=$user['Email'];
        $_SESSION['Role']=$user['Role'];
        $_SESSION['Image']=$user['Image'];
        return $errArray;
    }
    $errArray['Email'] = "*error";
    $errArray['Password'] = "*error";
    return $errArray;
}


function addPhoto($file){
    $target_dir = "uploads/";
      $photoName=time().$file['Image']['name'];
      $uploadfile = $target_dir .$photoName ;
      move_uploaded_file($file['Image']['tmp_name'], $uploadfile);

      return $photoName;
}