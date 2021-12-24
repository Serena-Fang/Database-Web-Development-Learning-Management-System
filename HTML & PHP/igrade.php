<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Assignment</title>
    </head>
    <body>
        <h3>Grade Assignment</h3>
        <?php
$cid = $_SESSION['cid'];
$aname = $_POST['aname'];
$_SESSION['aname']=$aname;
$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }

$query = "select sid from takes where cid = '$cid';
";
if (!($result = mysqli_query($conn, $query))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
 # create a new paragraph
 print("<p>\n");
 print("<form action='g1.php' method='post'><table>\n");
 # write the contents of the table
 $header = false;
 $sids = array();
 while ($row = mysqli_fetch_assoc($result)){
    # print the attribute names once!
    if (!$header) {
       $header = true;
       print("<thead><tr>\n");
       foreach ($row as $key => $value) {
          print "<th>" . $key . "</th>";             // Print attr. name
	  print "<th>Grade</th>";
    }
       print("</tr></thead>\n");
    }
    print("<tr>\n");     # Start row of HTML table
    foreach ($row as $key => $value) {
       print ("<td>" . $value . "</td>"); # One item in row
       $sid2 = $row["sid"];
       $sids[] = $row["sid"];
       echo "<td><input type='text' name='grade[".$sid2."]' id='$sid'  /></td></tr>";
    }
    print ("</tr>\n");   # End row of HTML table
 }

 echo "<tr><td></td></tr>";
 print("</table><br><input type='submit' value='save'  /></form>\n");
 print("<p>\n");
$_SESSION["sids"]=$sids;
//print_r($sids);
 mysqli_free_result($result);
mysqli_close($conn);

?>
