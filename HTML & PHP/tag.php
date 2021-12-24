<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Posts with tags</title>
    </head>
    <body>
        <h3>Assignments</h3>
        <?php
            // prints hello world
          $tag = $_POST['tag'];
	  $cid = $_SESSION['cid'];
echo "Tag: ";
echo $tag;

$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }
$query2 = "select * from tag t join post p on p.cid = t.cid and qnum = pnum where p.cid = '$cid' and tag LIKE CONCAT('%','$tag','%');
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
