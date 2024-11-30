<?php
include "db.php";
$sql = "SELECT * FROM workshop";
$workshops =$db->query($sql);
$workshops = $workshops->fetchAll();
// print_r($workshops);
echo json_encode ($workshops);
?>