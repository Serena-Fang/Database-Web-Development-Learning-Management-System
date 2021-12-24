<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Q&A Page</title>
    </head>
    <body>
        <h3>Grade</h3>
        <?php
          $cid = $_POST['$cid'];
          $sid = $_SESSION['sid'];
echo $cid, $sid;
$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }
$query = "select * from grade where cid = '$cid' and sid = '$sid';
";
if (!($result = mysqli_query($conn, $query3))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }# create a new paragraph
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
//         print ("<td>Reply</td>");
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
