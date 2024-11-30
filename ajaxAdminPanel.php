<?php
include "db.php";
$sql = "SELECT * FROM workshop";
$workshops =$db->query($sql);
$workshops = $workshops->fetchAll();
// echo '<>';
// print_r($workshops);
// echo '</

// echo '<pre>';
echo json_encode ($workshops, JSON_UNESCAPED_UNICODE);
// echo '</pre>';

?>