<?php
    session_start();
?>

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
   $conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
   # make sure no error in connection
   if (mysqli_connect_errno())
   {      
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }      
   # get the query that was posted
   $pnum = $_SESSION['pnum_r'];
$rtext = $_POST['query'];
$cid = $_SESSION['cid'];
$sid = $_SESSION['sid'];

$query2 = "select max(rnum) as r from reply where cid = '$cid' AND qnum = '$pnum' from reply;
";
$result = mysqli_query($conn,$query2);
$row = mysqli_num_rows($result);
while($data = mysqli_fetch_array($result))
{ $rnum = $data['r']+1;}
$_SESSION["rnum"]=$rnum;
mysqli_free_result($result);

echo "Successfully Replied!";



$query = "INSERT INTO reply(cid,qnum,rnum,sid,time,rtext) VALUES ('$cid','$pnum','0','0','$rtext');
 ";
   $result = mysqli_query($conn,$query);
//      header("Location: homepage.php");
mysqli_free_result($result);

    mysqli_close($conn);
?>
</body>
</html>
