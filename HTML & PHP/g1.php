<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Grade1</title>
    </head>
    <body>
        <h3>Successfully Grade Assignments!</h3>
        <?php
            // prints hello world
          $grades = $_POST['grade'];
	  $sids = $_SESSION["sids"];
$aname = $_SESSION['aname'];
$cid = $_SESSION['cid'];
//print_r($sids);
//echo count($grades);
/*echo "<pre>";
print_r($grades);
foreach($grades as $sid=>$val){
echo $sid."--".$val."<br/>";
}
echo "</pre>";*/
//$num = count($grades);
//echo $num;

$conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");   
if (mysqli_connect_errno())
   {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit(1);
   }
foreach($grades as $sid=>$grade){
$query = "INSERT INTO grade (cid,sid,aid,ngrade) VALUES ('$cid','$sid','$aname','$grade') ON DUPLICATE KEY UPDATE ngrade = '$grade';
";
$result = mysqli_query($conn,$query);
mysqli_free_result($result);
}
/*for ($i = 0; $i <= $num; $i++ ) {
$sid = $sids[$i];
$grade = $grades[$i];
//printf($grade . '<br>');
$result = mysqli_query($conn,$query);
//echo 'Student ID: ',$sid, 'Assignment: ', $aname, 'Grade: ',$grade,'<br>';
        mysqli_free_result($result);
    }*/
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

?>

</body>
</html>
