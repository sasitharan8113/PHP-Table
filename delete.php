<?php
$connect = mysqli_connect("localhost", "root", "", "student");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM tb_student_mark WHERE student_id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
   $query1 = "DELETE FROM tb_student_details WHERE student_id = '".$_POST["id"]."'";
   if(mysqli_query($connect, $query1))
   {
     echo 'Data Deleted';
    }
 }
}
?>
