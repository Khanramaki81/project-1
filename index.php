<?php
include "./db.php";
$workshops = $db->query("SELECT * FROM workshops");
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
        <div class="container-fluid  ">
            <div class="row ">
                <?php include "./include/header.php"?>
                <main>
                    <!-- Content Section -->
                    <section class="mt-4">
                        <div class="row">
                            <!-- Posts Content -->
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <!-- .......... -->
                                    <?php if($workshops->rowCount()>0):?>
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
                                                                <a href="./single.php?workshopId=<?=$workshop['id']?>&user_id=<?=$_GET["user_id"]?>" class="btn btn-sm btn-dark">مشاهده</a>
                                                                <button data-user="<?=$_GET["user_id"]?>" data-workshop="<?=$workshop['id']?>" class="btn btn-sm btn-dark btnSubscribe">ثبت نام</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif?>
                                        <?php endforeach?>
                                    <?php else:?>
                                        <div class="col">
                                            <div class="alert alert-danger">
                                                کارگاهی یافت نشد ...
                                            </div>
                                        </div>
                                    <?php endif?>
                                    <!-- .......... -->
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            <!-- Footer Section -->
            <?php include "./include/footer.php"?>
            </div>
        </div>
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
                        },
                        error: function(xhr, status,error){
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>
    </body>
</html>



   