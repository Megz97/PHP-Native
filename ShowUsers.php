<?php  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<style>
	a.view {
	font-size: 19px;
  font-weight: 600;
  color: white;
  display: inline-block;
  text-decoration: none;
  width: 60px; height: 23px; 
  border-radius: 10px; 
  background-color: rgb(50,50,175,.9);
  

}


a.view:hover {
	top: 3px;
  cursor: pointer;
  background-color:#2e458b;
  -webkit-box-shadow: none; 
  -moz-box-shadow: none; 
  box-shadow: none;
  
}
</style>
<body style="margin: auto;">

<?php
require_once "DB.php";
$db=new MysqlAdapter();

$db->select('users');
$allUsers=$db->fetchALL();

?>
<div style="width: 100%;height: 80x;background-color: beige ;float: left; display: flex;">
	<div> 
		<img style="" src="<?php echo 'uploads/'.$_SESSION['Image']; ?>" alt="no Image" border=3 height=80 width=80> 
	</div>
	<div style="font-size: 28px; margin-top:15px ; margin-left: 10px ;font-family: 'Adobe Hebrew'"> <?php echo $_SESSION["Name"] ?>  
	<br><a style="font-size: 20px;" href="Login.php">Logout</a>	
	</div>
</div>


</div>
	<div class="limiter" style="margin: auto;">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Name</th>
								<th class="column2">Email</th>
								<th class="column3">Gender</th>
								<th class="column4">Role</th>
								<th class="column5">Image</th>
								<th class="column6">Action</th>

							</tr>
						</thead>
						<tbody>
							<?php foreach ($allUsers as $user ){   ?>
								<tr>
									<td class="column1"><?php echo $user['Name']?></td>
									<td class="column2"><?php echo $user['Email']?></td>
									<td class="column3"><?php echo $user['Gender']?></td>
									<td class="column4"><?php echo $user['Role']?></td>
									<td class="column5"><img src="<?php echo 'uploads/'.$user['Image']; ?>" alt="no Image" border=3 height=70 width=70></td>
									<td class="column6">
									<a href="#" class="view">View</a>
									<?php
									if(strtolower($_SESSION['Role'])==strtolower('admin') || $_SESSION['ID']==$user['ID'])
									{ ?>
										<a class="view" onClick="javascript: return confirm('Please confirm deletion');" href="deleteUser.php?user=<?php echo $user['ID'] ?>"  >Delete</a>
										<a class="view" href="EditUser.php?user=<?php echo $user['ID'] ?>">Edit</a>
									<?php }

									?>

									</td>
								</tr>
							<?php } ?>													
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	



</body>
</html>