<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Assignment</title>
    </head>
    <body>
	<h3>Assignments</h3>
<a href="qa.php">See Q&A Page!</a>
        <?php
            // prints hello world
	  $cnum = $_POST['cnum'];
          $semester = $_POST['semester']; 
	  $year = $_POST['year'];
	  $sid = $_SESSION['sid'];
$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
$cid = $_REQUEST['cid'];
echo $cid;
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }

$query = "select cid from class where cnum='$cnum' AND semester ='$semester' AND year = '$year';
";
$result = mysqli_query($conn,$query);
$row = mysqli_num_rows($result);
while($data = mysqli_fetch_array($result))
{ $cid = $data['cid'];}
$_SESSION["cid"]=$cid;
mysqli_free_result($result);
//$query1 = "select * from grade where sid = 'loWO7ep40W' AND cid = 7;
//$query1 = "select * from takes t join grade g on t.sid = g.sid and t.cid = g.cid where g.sid = '$sid' and g.cid = '$cid';
//";

$query1 = "select cid,aid,ngrade from grade where sid = '$sid' AND cid = '$cid';
";

if (!($result = mysqli_query($conn, $query1))) {
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

//echo "\n";

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

mysqli_close($conn);

       ?>
    </body>
</html>
