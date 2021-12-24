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
          $sid = $_SESSION['sid'];
	  $cid = $_SESSION['cid'];
$tags_ = [];
$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }

$query3 = "select distinct tag from tag where cid = '$cid';
";
if (!($result = mysqli_query($conn, $query3))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
?>

<form action="tag2.php" method="POST">
Select Tags:<br>
<?php
while($row = mysqli_fetch_array($result)){
echo $row['tag'];
$tags_[] = $row['tag'];
echo '<input type="checkbox" name="tags[]" value="'.$row['tag'].'"> ';
}
echo '<br>';
?>
<br>
  <button type="submit" value ='Filter Posts'>Select</button>
</form>

<?php
mysqli_free_result($result);


//echo '<input type="checkbox" name="tags[]" value="'.$row['tag'].'"/>';


$query = "select p.cid,pnum,ptitle,rnum,ptext,STR_TO_DATE(pdate,'%d/%m/%Y %H:%i') as pdate,psid,sid,time,rtext from post p LEFT join reply r on p.cid = r.cid and p.pnum = r.qnum where p.cid LIKE CONCAT('%','$cid','%') order by pdate;
";
if (!($result = mysqli_query($conn, $query))) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }

$row1 = mysqli_num_rows($result);
if ($row1 == 0) {
     echo "<br>No Q&A for this Course!";
}
?>

<h4>Create New Post</h4>
<form action="postc.php" method="POST">
Post Title:<br>
  <input type="text" name="ptitle">
<br>
Post Text:<br>
  <input type="text" name="ptext">
  <br><br>
Select Tags:<br>
<?php
for ($i = 0; $i < count($tags_); $i++ ) {
echo $tags_[$i];
echo '<input type="checkbox" name="tags[]" value="'.$tags_[$i].'"> ';
}
echo '<br>';
?>
<br>
<button type="submit" value="Post">Post</button>
</form>


<?php
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
print "<th>Reply<th>";
       foreach ($row as $key => $value) {
          print "<th>" . $key . "</th>";             // Print attr. name
       }
       print("</tr></thead>\n");
    }
    print("<tr>\n");     # Start row of HTML table
        print ("<td><a href='reply1.php?pnum=".$row['pnum']."'>Reply</a></td>");
print ("<td> </td>");
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
