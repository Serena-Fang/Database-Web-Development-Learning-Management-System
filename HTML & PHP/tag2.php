<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Q&A Page</title>
    </head>
    <body>
        <h3>Q&A Page</h3>
        <?php
            // prints hello world
	  $tags = $_POST['tags'];
echo 'Tags selected: <br>';
for ($i = 0; $i <= count($tags); $i++ ) {
        print($tags[$i] . "\n");
    }
$tags1 = join("','",$tags);
//echo $tags1;
          $sid = $_SESSION['sid'];
          $cid = $_SESSION['cid'];
$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }
$query = "select distinct p.cid,pnum,ptitle,rnum,ptext,STR_TO_DATE(pdate,'%d/%m/%Y %H:%i') as pdate,psid,sid,time,rtext from post p join reply r join tag t on p.cid = r.cid and p.pnum = r.qnum where p.cid LIKE CONCAT('%','$cid','%') AND tag IN ('$tags1') order by pdate;
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
