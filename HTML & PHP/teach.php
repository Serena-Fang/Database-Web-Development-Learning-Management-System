<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Course(instructor)</title>
    </head>
    <body>
        <h3>Course (instructor)</h3>
<a href="qa.php">See Q&A Page!</a><br>

<br><a href="create.php">Grade Assignment!</a><br>

<h3>Create Assignments</h3>
<form action="create.php" method="POST">
    Assignment Name:<br>
  <input type="text" name="aname">
  <br>
  Due Date:<br>
  <input type="text" name="duedate">
  <br>
  Assignment Content:<br>
  <input type="text" name="atext">
  <br>
  Points:<br>
  <input type="text" name="points">
 <br>
      <p>  <input type="submit" value="Create Assignment"></p>
   </form>

        <?php
            // prints hello world
          $cnum = $_POST['cnum'];
          $semester = $_POST['semester']; 
          $year = $_POST['year'];
          $sid = $_SESSION['sid'];
$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
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
$_SESSION["cid"]= $cid;
mysqli_free_result($result);
$query1 = "select cid,s.sid,fname,lname,aid,ngrade from student s join grade g on s.sid=g.sid where cid = '$cid' order by aid;
";
if (!($result = mysqli_query($conn, $query1))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
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
