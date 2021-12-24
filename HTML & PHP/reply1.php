<?php
    session_start();
?>

<!DOCTYPE html>
<html>
   <head>
   <title> Authenticate </title>
   </head>
   <body>
   <h3>Homepage</h3>
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
   $pnum = $_REQUEST['pnum'];
   $_SESSION['pnum_r'] = $pnum;
?>
<h3>Type reply:</h3>
   <form action="reply2.php" method="POST">
      <p>
      Query:
      </p>
      <TEXTAREA name="query" rows="20" cols="60">
      </TEXTAREA>

      <p> Press to execute query: <input type="submit" value="Send"></p>
      <p> Press to clear input: <input type="reset"></p>
   </form>

<?php
    mysqli_close($conn);
?>
</body>
</html>
