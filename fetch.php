<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT s.student_id,t.mark_1,t.mark_2,t.mark_3,t.total,t.rank FROM tb_student_details as s left join tb_student_mark t on s.student_id=t.student_id";
$result = $conn->query($sql);

$data = array();

if(!$result){
	die(mysqli_error($conn));
}

$data = array();

if (mysqli_num_rows($result) > 0) 
{
  while($row = mysqli_fetch_array($result))
  {
     array_push($data, $row);
  }
}
header('Content-type: application/json');
echo json_encode($data);

$conn->close();
?>
