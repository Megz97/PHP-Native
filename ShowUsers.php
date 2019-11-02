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
	a {
	font-size: 19px;
  font-weight: 600;
  color: white;
  display: inline-block;
  text-decoration: none;
  width: 60px; height: 23px; 
  border-radius: 10px; 
  background-color: rgb(50,50,175,.9);
  

}


a:hover {
	top: 3px;
  cursor: pointer;
  background-color:#2e458b;
  -webkit-box-shadow: none; 
  -moz-box-shadow: none; 
  box-shadow: none;
  
}
</style>
<body>

<?php
require_once "DB.php";
$db=new MysqlAdapter();

$db->select('users');
$allUsers=$db->fetchALL();

?>
	<div class="limiter">
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
										<a onClick="javascript: return confirm('Please confirm deletion');" href="deleteUser.php?user=<?php echo $user['ID'] ?>"  >Delete</a>
										<a href="EditUser.php?user=<?php echo $user['ID'] ?>">Edit</a>
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