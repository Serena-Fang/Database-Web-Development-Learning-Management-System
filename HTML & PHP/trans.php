<?php
    session_start();
?>
<!DOCTYPE html>
<html>
   <head>
   <title> Transcript </title>
 </head>
 <body>
   <h3>Transcript</h3>
<a href="homepage.php">Go back to homepage</a>
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
   $query = "select c.cnum, year, semester, cname, lgrade from takes t join class c join course d on c.cid = t.cid AND c.cnum = d.cnum where sid = '$sid' order by year, semester desc;
";
if (!($result = mysqli_query($conn, $query))) {
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
