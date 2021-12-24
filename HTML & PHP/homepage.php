<?php
    session_start();
?>

<!DOCTYPE html>
<html>
   <head>
   <title> Homepage </title>
   <title>Homepage</title>
 </head>
 <body>
   <h3>Homepage</h3>
<a href="trans.php">View Transcript</a>

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
   $sid = $_SESSION["sid"];

   $query = "select distinct t.cid, cnum, semester, year,lgrade as 'Final Grade' from takes t join class c on t.cid = c.cid where sid = '$sid';
";
if (!($result = mysqli_query($conn, $query))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
 # create a new paragraph
 print("<p>\n");
 print("<table>\n");
 print("Courses taken or taking:");
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
            print("<th> View Details </th>");
            print("</tr></thead>\n");
         }
         print("<tr>\n");     # Start row of HTML table
         foreach ($row as $key => $value) {
		 print ("<td>" . $value . "</td>"); # One item in row
	}
print("<td><a href='grade.php?cid=".$row['cid']."'>View Details</a></td>");

	?>

<?php
print ("<td>".$cidt."</td>");
 print ("</tr>\n");   # End row of HTML table
      }

      print("</table>\n");
      print("<p>\n");
      mysqli_free_result($result);
?>

<form action="grade.php" method="POST">
    Course Number:<br>
  <input type="text" name="cnum">
  <br>
  Year:<br>
  <input type="text" name="year">
  <br>
  Semester:<br>
  <select name="semester">
    <option value="Fall">Fall</option>
    <option value="Spring">Spring</option>
  </select>
  <br>
  <br>
      <p>  <input type="submit" value="View Course Details"></p>
   </form>

<?php
      mysqli_close($conn);
?>
