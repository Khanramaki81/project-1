<?php
session_start();
include "../db.php";
$invalidInputEmail = '';
$invalidInputPassword = '';
$invalidStructureInputEmail='';
$err_msg='';
$Mail = "/[a-z0-9]+\@+[a-z]+\.+[a-z]/";
if(isset($_POST['submit'])){
    if(empty(trim($_POST['email']))){
        $invalidInputEmail = 'فیلد ایمیل الزامی است.';
    }elseif(preg_match($Mail,$_POST['email'])==false){
        $invalidStructureInputEmail = 'ایمیل را درست وارد کنید.';
    }elseif(empty(trim($_POST['password']))){
        $invalidInputPassword = 'فیلد رمز عبور الزامی است.';
    }
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){
        $email = $_POST['email'];
        // echo $email;
        $password = $_POST['password'];
        $encrypted= base64_encode($password);
        // $user = $db->query("SELECT * FROM  users WHERE email=$email AND password=:password ");
        // $user->execute(['email' => $email, 'password'=>$password]);
        $sql = "SELECT * FROM users";
        $users =$db->query($sql) ;
        // $users = $users->fetchALL();
        if($users->rowCount()>0){
            foreach($users as $user){
                if(($user['email']==$email)&&($user['password']==$encrypted)){
                    // echo $_SESSION['email'];
                    if($user['role']=="admin"){
                        $_SESSION['email'] = $email;
                        header("LOCATION:../admin_panel.php");
                    }else{
                        $_SESSION['id'] = $user['id'];
                        header("LOCATION:../index.php?user_id=".$user['id']);
                    }
                }else{
                    $err_msg="کاربری با این مشخصات یافت نشد.";
                }
            }
        }else{
            $err_msg="کاربری با این مشخصات یافت نشد.";
        }
    }
        
    }

?>
<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css" />
    </head>
    <body>
        <div class="container-fluid  ">
            <div class="row d-flex justify-content-center align-items">
                <main class="col-sm-8 col-lg-5 m-5   border rounded shadow" >
                    <div class="pt-5 mb-5 mt-4 text-center">
                        <h2 class="fw-bold fs-3  secondary-emphasis">ورود به حساب کاربری</h2>
                    </div>
                    <div>
                        <div class="form-text text-danger fw-bold fs-5 text-center"><?=$err_msg?></div>
                        <form method = "POST">
                            <div class="mx-5 my-3">
                                <label class="form-label">ایمیل</label>
                                <input  class="p-2 form-control form-control-lg" type="text" name="email">
                                <div class="form-text text-danger"><?=$invalidInputEmail?></div>
                                <div class="form-text text-danger"><?=$invalidStructureInputEmail?></div>
                            </div>
                            <div class="mx-5 my-3">
                                <label class="form-label">رمز عبور</label>
                                <input class="p-2 form-control form-control-lg" type="password" name="password">
                                <div class="form-text text-danger"><?=$invalidInputPassword?></div>
                            </div>
                            <div class="m-5 ">
                                <button type="submit" class="col-12 btn btn-primary p-3 mt-4" name="submit">ورود</button>
                            </div>
                        </form>
                        <div class="text-center mt-4 mb-5">
                            <p class="">حساب کاربری ندارید؟ <a href="register.php" class="text-decoration-none"> ثبت نام</a></a></p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>



   