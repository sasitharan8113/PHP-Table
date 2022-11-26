<?php
$connect = mysqli_connect("localhost", "root", "", "student");
 $student_id = mysqli_real_escape_string($connect, $_POST["student_id"]);
 $mark_1 = mysqli_real_escape_string($connect, $_POST["mark_1"]);
  $mark_2 = mysqli_real_escape_string($connect, $_POST["mark_2"]);
 $mark_3 = mysqli_real_escape_string($connect, $_POST["mark_3"]);
 $total = mysqli_real_escape_string($connect, $_POST["total"]);
  $rank = mysqli_real_escape_string($connect, $_POST["rank"]);
 $query = "INSERT INTO tb_student_details (student_id) VALUES('$student_id')";
 if(mysqli_query($connect, $query))
 {
  $query1 = "INSERT INTO tb_student_mark (student_id,mark_1,mark_2,mark_3,total,rank) VALUES('$student_id',$mark_1,$mark_2,$mark_3,$total,$rank)";
  if(mysqli_query($connect, $query1))
  {
    echo 'Data inserted';
  }
}
?>
