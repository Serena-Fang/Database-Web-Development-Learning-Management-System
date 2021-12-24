<?php
    session_start();
?>
<!DOCTYPE html>
<html>
   <head>
   <title>Instructor/TA Homepage </title>
 </head>
 <body>
   <h3>Instructor/TA Homepage</h3>
   <div class="container">
   </div>
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
   $sid = $_SESSION["sid1"];
$query = "select i.cid, cnum, semester, year from instructor i join class c on i.cid = c.cid where instructorID like CONCAT('%','$sid','%');
";
if (!($result = mysqli_query($conn, $query))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
 # create a new paragraph
 print("<p>\n");
 print("<table>\n");
 print("Courses instructing:");
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

<form action="teach.php" method="POST">
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
