<?php
    session_start();
?>

<!DOCTYPE html>
<html>
   <head>
   <title> Authenticate </title>
   </head>
   <body>
   <div class="container">
   </div>
   <P>       
   <?php
   # establish connection to cs377 database
   $conn = mysqli_connect("localhost",
                          "cs377", "ma9BcF@Y", "canvas");   
   # make sure no error in connection
   if (mysqli_connect_errno())
   {      
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }      
   # get the query that was posted
   $sid = $_POST['sid'];
   $lid = $_POST['lid']; 

   $query = "select * from student where sid='$sid' AND lid ='$lid';
";
   $result = mysqli_query($conn,$query);
   $row = mysqli_num_rows($result);
   if ($sid == "" || $lid == ""){
     echo "Empty username or login ID!";
 } elseif ($row != 1) {
     echo "Invalid username or login ID!";
} else {
     $_SESSION["sid"] = $sid;
     header("Location: homepage.php");
}

    mysqli_close($conn);
?> 
