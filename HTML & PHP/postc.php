<?php
    session_start();
?>

<!DOCTYPE html>
<html>
   <head>
   <title> Create Post </title>
   </head>
   <body>
<h3>Successfully Created Post!</h3>
   <?php
   # establish connection to cs377 database
   $conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
   # make sure no error in connection
   if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }
   # get the query that was posted
$sid = $_SESSION['sid'];
$cid = $_SESSION['cid'];
$ptitle = $_POST['ptitle'];
$ptext = $_POST['ptext'];
$pdate = date("Y-m-d h:i:s");
$tags = $_POST['tags'];
echo 'Post Title: ',$ptitle,' Post Text: ', $ptext,' Post Time: ',$posted_date;

$query2 = "select max(pnum) as n from post where cid = '$cid';
";
$result = mysqli_query($conn,$query2);
$row = mysqli_num_rows($result);
while($data = mysqli_fetch_array($result))
{ $pnum = $data['n']+1;}
$_SESSION["pnum"]=$pnum;
mysqli_free_result($result);

$query = "INSERT INTO post(cid,pnum,ptitle,ptext,pdate,psid) VALUES ('$cid','$pnum','$ptitle','$ptext','$pdate','$sid');
 ";
   $result = mysqli_query($conn,$query);
//      header("Location: homepage.php");
mysqli_free_result($result);

$query1 = "select p.cid,pnum,ptitle,rnum,ptext,STR_TO_DATE(pdate,'%d/%m/%Y %H:%i') as pdate,psid,sid,time,rtext from post p LEFT join reply r on p.cid = r.cid and p.pnum = r.qnum where p.cid LIKE CONCAT('%','$cid','%') order by pdate;
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
