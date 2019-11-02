<?php
$con=mysqli_connect("localhost","root","rootroot","php");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM users";
$result=mysqli_query($con,$sql);



// Associative array
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

print_r ($row);


printf ("%s (%s)\n",$row["Name"],$row["Email"]);

// Free result set
mysqli_free_result($result);

mysqli_close($con);
?>