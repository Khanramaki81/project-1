<?php
include "db.php";

function funcShow($id){
    $sql = "SELECT title,body FROM workshops WHERE id=$id ";
    $workshop =$GLOBALS['db']->query($sql);
    $workshop = $workshop->fetch();
    echo json_encode ($workshop, JSON_UNESCAPED_UNICODE);   
}

// function funcListShow($id){
//     $sql = "SELECT * FROM subscribers WHERE workShop_id=$id";
//     $subscribers =$GLOBALS['db']->query($sql);
//     $subscribers = $subscribers->fetch(); 
//     echo json_encode ($subscribers, JSON_UNESCAPED_UNICODE);   
// }

function funcBeforeShow($id){
    $sql = "SELECT * FROM workshops WHERE id=$id ";
    $workshop =$GLOBALS['db']->query($sql);
    $workshop = $workshop->fetch();
    echo json_encode ($workshop, JSON_UNESCAPED_UNICODE);   
}

function funcEdit($id){
    $title = $_POST['title'];
    $body = $_POST['body'];
    $status = $_POST['status'];
    $sql = "UPDATE workshops SET title=:title,body=:body,status=:status WHERE id=$id";
    $workshop =$GLOBALS['db']->prepare($sql); 
    $workshop->execute(['title'=>$title, 'body'=>$body, 'status'=>$status]);
    echo json_encode("کارگاه با عنوان ".$title."  با موفقیت ویرایش شد.");
}

function funcCreate(){
    $title = $_POST['title'];
    $body = $_POST['body'];
    $status = $_POST['status'];
    $sql = "INSERT INTO workshops (title,body,status) VALUES (:title,:body,:status)";
    $workshop =$GLOBALS['db']->prepare($sql); 
    $workshop->execute(['title'=>$title, 'body'=>$body, 'status'=>$status]);
    echo json_encode("کارگاه با عنوان ".$title."  با موفقیت ایجاد شد.");
}

function funcDelete(){
    $id = $_POST['id'];
    $sql = "DELETE FROM workshops WHERE id = :id";
    $workshop =$GLOBALS['db']->prepare($sql); 
    $workshop->execute(['id'=>$id]);
    echo json_encode("کارگاه با موفقیت حذف شد.");
}

function funcRegister(){
    $workshopId = $_POST['workshopId'];
    $userId = $_POST['userId'];
    $sql = "INSERT INTO subscribers (user_id,workshop_id) VALUES (:user_id,:workshop_id)";
    $workshop =$GLOBALS['db']->prepare($sql); 
    $workshop->execute(['user_id'=>$userId, 'workshop_id'=>$workshopId]);
    echo json_encode("با موفقیت ثبت نام شدید.");
}
// $id =$_GET['id'];
// $func =$_GET['funcModal'];
// $func();

$func =$_GET['funcAction'];
if($func=="funcDelete"){
    $func();
}elseif($func=="funcCreate"){
    $func();
}elseif($func=="funcRegister"){
    $func();
}else{
    $id =$_GET['id'];
    $func($id);
}


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



