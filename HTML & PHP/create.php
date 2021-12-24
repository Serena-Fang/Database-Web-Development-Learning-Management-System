<?php
    session_start();
?>
<!DOCTYPE html>
<html>
   <head>
   <title> Authenticate </title>
   </head>
   <body>
   <h3>Grade assignment!</h3>
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
   $aname = $_POST['aname'];
   $duedate = $_POST['duedate'];
   $atext = $_POST['atext'];
   $points = $_POST['points'];
   $sid = $_SESSION['sid1'];
   $cid = $_SESSION['cid'];

//   echo $sid, $cid, $aname, $duedate, $atext, $points;
    $query = "INSERT INTO assignment (cid,aname,duedate,atext,points) VALUES ('$cid','$aname','$duedate','$atext','$points');
 ";
   $result = mysqli_query($conn,$query);
//      header("Location: homepage.php");
mysqli_free_result($result);
echo "\n";
$query2 = "select aname, duedate, atext, points from assignment where cid = '$cid';
";
if (!($result = mysqli_query($conn, $query2))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
 # create a new paragraph
 print("<p>\n");
 print("<table>\n");
 # write the contents of the table
 $header = false;
 while ($row = mysqli_fetch_assoc($result)){
    # print the attribute names once!
    if (!$header) {
       $header = true;
       print("<thead><tr>\n");
       foreach ($row as $key => $value) {
          print "<th>" . $key . "</th>";             // Print attr. name
       }
       print("</tr></thead>\n");
    }
    print("<tr>\n");     # Start row of HTML table
    foreach ($row as $key => $value) {
       print ("<td>" . $value . "</td>"); # One item in row
    }
    print ("</tr>\n");   # End row of HTML table
 }
 print("</table>\n");
 print("<p>\n");
 mysqli_free_result($result);
?>

<form action="igrade.php" method="POST">
    Assignment name:<br>
  <input type="text" name="aname">
  <br>
      <p>  <input type="submit" value="Grade"></p>
   </form>
<?php
  mysqli_close($conn);
?>
