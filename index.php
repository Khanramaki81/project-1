<?php
include "./db.php";
session_start();
$workshops = $db->query("SELECT * FROM workshops");
$err_msg="تاکنون در کارگاهی ثبت نام نکرده اید."
?>
<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid ">
            <div class="row">
                <header class="d-flex  justify-content-between align-items-center py-3 text-bg-secondary">
                    <div class="btn-toolbar ">
                        <a href="index.php" class="fs-3 ms-3 fw-medium text-decoration-none text-white">my project</a>  
                    </div>
                    <?php if((isset($_GET['user_id']))):?>
                        <?php if(isset($_SESSION['id'])):?>
                            <?php if(($_SESSION['id']==$_GET['user_id'])): ?>
                                <div>
                                    <a href="pages/logout.php" class="text-decoration-none  text-white fs-5 p-2 border rounded">خروج</a>
                                </div>
                            <?php else: ?>
                                <?php 
                                    header("location:./pages/login.php");
                                    exit();
                                ?>
                            <?php endif?>
                        <?php else: ?>
                            <?php 
                                header("location:./pages/login.php");
                                exit();
                            ?>
                        <?php endif?>
                    <?php else: ?>
                        <div>
                            <a href="pages/login.php" class="text-decoration-none  text-white fs-5 p-2 border rounded">ثبت نام | ورود</a>
                        </div>
                    <?php endif ?>
                </header>
                <main>
                    <!-- Content Section -->
                    <section class="mt-4 mb-4">
                        <div class="row m-4 shadow">
                            <div class="col-lg-12  d-flex align-items-center text-bg-primary p-3">
                                <p class="fs-5 fw-bold mt-2">برای ثبت نام در کارگاه ها وارد حساب خود شوید.</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Posts Content -->
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <?php if($workshops->rowCount()>0):?>
                                        <?php if(isset($_GET['user_id'])):?>
                                            <?php $userId = $_GET['user_id'] ?>
                                            <?php $subscribers = $db->query("SELECT * FROM subscribers WHERE user_id=$userId ");?>
                                            <?php if($subscribers->rowCount()>0):?>
                                                <?php $subscribers = $subscribers->fetchAll();?>
                                                <?php $arrayWorkshop_Id = array(); ?>
                                                <?php foreach($subscribers as $subscriber){
                                                    array_push($arrayWorkshop_Id,$subscriber['workshop_id']);
                                                }?>
                                                <?php foreach($workshops as $workshop):?>
                                                    <?php if($workshop['status']=="published"):?>
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="mb-5">
                                                                        <h5 class="card-title fw-bold"><?=$workshop['title']?></h5>
                                                                        <p class="card-text text-secondary pt-3"><?= substr($workshop['body'],0,1000)?></p>
                                                                    </div>
                                                                    <div class="float-end">
                                                                        <button class="btn btn-sm btn-outline-dark btnShow" data-id="<?=$workshop['id']?>" data-bs-toggle="modal" data-bs-target="#viewModal">مشاهده</button>
                                                                        <?php if(in_array($workshop['id'],$arrayWorkshop_Id)):?>
                                                                            <p class="fw-bold text-success mt-2">ثبت نام شده اید.</p>
                                                                        <?php else:?>
                                                                            <button data-user="<?=$_GET["user_id"]?>" data-workshop="<?=$workshop['id']?>" class="btn btn-sm btn-dark btnSubscribe">ثبت نام</button>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    <?php endif?>
                                                <?php endforeach?>
                                            <?php else: ?>
                                                <?php foreach($workshops as $workshop):?>
                                                    <?php if($workshop['status']=="published"):?>
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="mb-5">
                                                                    <h5 class="card-title fw-bold"><?=$workshop['title']?></h5>
                                                                    <p class="card-text text-secondary pt-3"><?= substr($workshop['body'],0,1000)?></p>
                                                                </div>
                                                                <div class="float-end">
                                                                    <button class="btn btn-sm btn-outline-dark btnShow" data-id="<?=$workshop['id']?>" data-bs-toggle="modal" data-bs-target="#viewModal">مشاهده</button> 
                                                                    <button data-user="<?=$_GET["user_id"]?>" data-workshop="<?=$workshop['id']?>" class="btn btn-sm btn-dark btnSubscribe">ثبت نام</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <?php endif?>
                                                <?php endforeach?>
                                            <?php endif?>
                                        <?php else: ?>
                                            <?php foreach($workshops as $workshop):?>
                                                <?php if($workshop['status']=="published"):?>
                                                    <div class="col-sm-4 mb-5">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <h5 class="card-title fw-bold"><?=$workshop['title']?></h5>
                                                                </div>
                                                                <p class="card-text text-secondary pt-3"><?= substr($workshop['body'],0,1000)?></p>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <button class="btn btn-sm btn-outline-dark btnShow" data-id="<?=$workshop['id']?>" data-bs-toggle="modal" data-bs-target="#viewModal">مشاهده</button> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif?>
                                    <?php else: ?>
                                        <div class="col">
                                            <div class="alert alert-danger">
                                                کارگاهی یافت نشد ...
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <!-- .......... -->
                                </div>
                            </div>
                        </div>
                        <!-- modal show -->
                        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body" id="MShow">
                                                            <!-- added to script -->
                                                            <!-- <button type="submit" class="btn btn-dark" name="submit">
                                                                مشاهده ثبت نامی ها
                                                            </button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
        <footer class="position-fixed-bottom text-center text-white text-bg-secondary pt-4 mt-md-5 pt-md-5 ">
            <div class="row flex-column">
                <div>
                    <p class="fs-4">کلیه حقوق محتوا این سایت  محفوظ میباشد</p>
                </div>
                <div>
                    <p class="fs-4">شماره تماس: ۰۹۱۱ ۰۰۰ ۰۰۰۰</p>
                </div>
                <div>
                    <p class="fs-4">آدرس: -- --- --- --</p>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $(".btnSubscribe").on('click',function(){
                    var workshop_Id = $(this).data('workshop');
                    var user_Id = $(this).data('user');
                    console.log(workshop_Id);
                    console.log(user_Id);
                    $.ajax({
                        url:"ajaxAdminPanel.php?funcAction=funcRegister",
                        type:"POST",
                        data:{
                        workshopId: workshop_Id,
                        userId: user_Id
                        },
                        dataType: "JSON",
                        cache: false,
                        success: function(data){
                            const json =JSON.stringify(data);
                            alert(json);
                            setTimeout(() => {
			                	// Use a publicly accessible URL for testing
			                	var redirectUrl = "http://localhost/project-1/index.php?user_id="+user_Id;
			                	window.location.href = redirectUrl;
			                	// redirect after 1 seconds
			                    }, 1000);
                        },
                        error: function(xhr, status,error){
                            console.error(xhr);
                        }
                    });
                });

                $(".btnShow").on('click',function(){
                    var workshopId = $(this).data('id');
                    $.get("ajaxAdminPanel.php?funcAction=funcShow&id="+workshopId, function(data, status){
                        $("#MShow").empty();
                        const workshop= JSON.parse(data);
                        // console.log(workshop[0]);
                        $("#MShow").append(workshop[0]+"<br>"+workshop[1]);
                    });
                });
            });
        </script>
    </body>
</html>



   