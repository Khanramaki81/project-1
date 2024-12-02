<?php
include "db.php";

function funcShow($id){
    $sql = "SELECT title,body FROM workshop WHERE id=$id ";
    $workshop =$GLOBALS['db']->query($sql);
    $workshop = $workshop->fetch();
    echo json_encode ($workshop, JSON_UNESCAPED_UNICODE);   
}
$id =$_GET['id'];
$func =$_GET['funcModal'];
$func($id);


// $sql = "SELECT * FROM workshop WHERE id=1";
// $workshops =$db->query($sql);
// $workshops = $workshops->fetch();
// print_r($workshops);


// function btnShow(){
//     $id=$_GET['id'];
//     $sql = "SELECT * FROM workshop WHERE id=$id"; 
//     $workshops = $db->query($sql);
//     $workshops = $workshops->fetchAll();
//     return json_encode ($workshops, JSON_UNESCAPED_UNICODE);
// }

// if(isset($_GET['funcName'])){
//     echo $_GET['funcName']();
// }

// function btnEdit(){

// }

// function btnCreate(){

// }

//************
// function funcShow($id){
//     $sql = "SELECT * FROM workshop WHERE id=$id";
//     $workshops =$db->query($sql);
//     $workshops = $workshops->fetchAll();
//     return $workshops;   
// }
// function funcShow(){
//     return "test";
// }
// $func =$_GET['funcModal'];
// $func();
//************
// if($func=="funcShow"){
//     $id = $_GET['id'];
//     echo "test";
//     echo $id;
// }

//     echo "test";
//     $id = $_GET['id'];
//     funcShow($id);
// }



// function b(){
//     $bt = "this is test.";
//     return $bt;
// }
// $btn = "b";
// echo b();
// $sql = "SELECT * FROM workshop WHERE id=$id";    
// $workshops =$db->query($sql);
// $workshops = $workshops->fetchAll();
// echo "<pre>";
// print_r($workshops);
// echo "</pre>";
// echo json_encode ($workshops, JSON_UNESCAPED_UNICODE);

// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//     $sql = "SELECT * FROM workshop WHERE id=$id";    
//     $workshops =$db->query($sql);
//     $workshops = $workshops->fetchAll();
//     echo json_encode ($workshops, JSON_UNESCAPED_UNICODE);
// }
// else{
//     $sql = "SELECT * FROM workshop";
// }

// $workshops =$db->query($sql);
// $workshops = $workshops->fetchAll();
// // echo '<>';
// // print_r($workshops);
// // echo '</

// // echo '<pre>';
// echo json_encode ($func(), JSON_UNESCAPED_UNICODE);
// // echo '</pre>';
// function show($id){
//     include "db.php";
   
//         $sql = "SELECT * FROM workshop WHERE id=$id";    
    
    
//     $workshops =$db->query($sql);
//     $workshops = $workshops->fetchAll();
//     // echo '<>';
//     // print_r($workshops);
//     // echo '</
    
//     // echo '<pre>';
//     return json_encode ($workshops, JSON_UNESCAPED_UNICODE);
// }

// function all(){
//     include "db.php";
   
// $sql = "SELECT * FROM workshop";     
// echo '<pre>';
// print_r($workshops);
// echo '</pre>';



