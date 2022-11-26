<?php
$connect = mysqli_connect("localhost", "root", "", "student");
$value = mysqli_real_escape_string($connect, $_POST["value"]);
$query = "UPDATE tb_student_mark SET ".$_POST["column_name"]."='".$value."' WHERE student_id = '".$_POST["id"]."'";
if(mysqli_query($connect, $query))
{
        echo 'Data Updated';
}
 
?>
