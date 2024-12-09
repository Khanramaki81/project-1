<?php
session_start();
include "./db.php";
if(!isset($_SESSION['email'])){
    header("location:./pages/login.php");
    exit();
}
$limit = 5;
$page = isset($_GET['page'])?$_GET['page']:1;
$start = ($page - 1) * $limit;
$workshops = $db->query("SELECT * FROM workshops LIMIT $start, $limit");

$workshops_1 = $db->query("SELECT count(id) AS id FROM workshops");
$workshops_1= $workshops_1->fetchAll();
$total = $workshops_1[0]['id'];
$pages = ceil($total / $limit);
$previous = $page - 1;
$Next = $page + 1;
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
        <!-- <div id="demo"></div> -->
        <div class="container-fluid">
            <div class="row">
                <header>
                    <div class="d-flex shadow-sm justify-content-between flex-wrap flex-md-nowrap  align-items-center pt-4 pb-3 px-3 mb-3 border-bottom">
                        <h1 class="fs-3">کارگاه ها</h1>
                        <div class="d-flex btn-toolbar mb-md-2 mb-0 ">
                            <a href="./pages/logout.php" class="btn btn-sm border border-secondary-subtle btn-dark fs-5 fw-medium">خروج<a>
                            <a href="" class="btn btn-sm border border-secondary-subtle btn-dark fs-5 fw-medium btnCreate" data-bs-toggle="modal" data-bs-target="#edit&createModal">ایجاد کارگاه</a>
                        </div>
                    </div>
                </header>
                <main class="col-12 ms-sm-auto  ">
                    <div class="mt-t">
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>عنوان</th>
                                        <th>توضیحات</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ....... -->
                                     <?php if($workshops->rowCount()>0):?>
                                        <?php foreach($workshops as $workshop):?>
                                        <tr>
                                            <th><?=$workshop['id']?></th>
                                            <td><?=$workshop['title']?></td>
                                            <td><?=substr($workshop['body'],0,100)?></td>
                                            <td class="<?=($workshop['status']=="draft")?'text-warning':'text-success'?>"><?=$workshop['status']?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-dark btnDelete" data-id="<?=$workshop['id']?>">حذف</button>
                                                <button href="#" class="btn btn-sm btn-outline-dark btnEdit" data-id="<?=$workshop['id']?>" data-bs-toggle="modal" data-bs-target="#edit&createModal">
                                                    ویرایش
                                                </button>
                                                <button class="btn btn-sm btn-outline-dark btnShow" data-id="<?=$workshop['id']?>" data-bs-toggle="modal" data-bs-target="#viewModal">
                                                    مشاهده
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach?>
                                    <?php else: ?>
                                        <div class="col">
                                            <div class="alert alert-danger">کارگاهی یافت نشد ...</div>
                                        </div>
                                    <?php endif?>
                                
                                    <!-- ....... -->
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination d-flex align-items-center justify-content-center">
                                        <li class="page-item">
                                          <a class="page-link" href="admin_panel.php?page=<?=($previous==0)? 1 : $previous?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                          </a>
                                        </li>
                                        <?php for($i = 1; $i<= $pages; $i++):?>
                                        <li class="page-item"><a class="page-link" href="admin_panel?page=<?= $i; ?>" ><?= $i ?></a></li>
                                        <?php endfor?>
                                        <li class="page-item">
                                          <a class="page-link" href="admin_panel.php?page=<?=$Next ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                     
                    <!-- Modal edit and create -->
                    <div class="modal fade" id="edit&createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="ModalCreateEdit" class="row g-4" method="POST" enctype="multipart/form-data">
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <label for="exampleFormControlTitle"class="form-label">عنوان کارگاه</label>
                                            <input id="titleInput" type="text" class="form-control" name="title" />
                                        </div>
                                        <div class="col-12">
                                            <label for="exampleFormControlDescription"class="form-label">توضیحات</label>
                                            <textarea id="bodyInput" class="form-control" rows="6" name="body"></textarea>
                                        </div>
                                        <div class="my-5 ">
                                            <select class="form-select form-select-lg "  aria-label=".form-select-lg example " id="status">
                                                <option  value="draft">draft</option>
                                                <option  value="published">published</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button id="formValidate" type="submit" class="btn btn-dark" name="submit">
                                                 تایید
                                            </button>
                                        </div>
                                    </form>
                                    <div id="err_box" class="d-none">
                                        <span id="err_close">x</span>
                                        <p id="err_msg"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit and create ended -->
                    <!-- Modal show-->     
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button  type="button" class="btn btn-primary btnListShow">مشاهده ثبت نامی ها</button>
                                </div>
                                <div id="workshopIdList" class="d-none"></div>
                                <div id="listShow" class="border p-3 ">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal show ended -->
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                //start btnShow 
                //Display the list of workshops
                $(".btnShow").on('click',function(){
                    let workshopId = $(this).data('id');
                    $("#workshopIdList").empty();
                    $("#workshopIdList").text(workshopId);
                    $.get("ajaxAdminPanel.php?funcAction=funcShow&id="+workshopId, function(data, status){
                        $("#MShow").empty();
                        const workshop= JSON.parse(data);
                        $("#MShow").append(workshop[0]+"<br>"+workshop[1]);
                    });
                });
                
                // // start users list
                $(".btnListShow").on('click',function(){
                    $("#listShow").empty();
                    let workshopsId = $("#workshopIdList").html();
                    console.log(workshopsId);
                    $.get("ajaxAdminPanel.php?funcAction=funcListShow&id="+workshopsId, function(data, status){
                        var userLists = JSON.parse(data);
                        userLists.forEach((userList)=>{
                           let sentence = userList;
                           $("#listShow").append(sentence['email']+"<br>"); 
                        });
                    });
                });
                $('#viewModal').on('hidden.bs.modal', function () {
                    $("#listShow").empty();
                });


                //Workshop creating
                $(".btnCreate").on('click',function(){
                    $("#titleInput").val('');
                    $("#bodyInput").val('');
                    $("#status").val('draft');
                    $("#ModalCreateEdit").submit(function(event){
                        event.preventDefault();
                        var titleInput = $("#titleInput").val();
                        var bodyInput = $("#bodyInput").val();
                        if(titleInput==""){
                            alert("فیلد عنوان الزامی است.");
                        }else if(bodyInput==""){
                            alert("فیلد توضیحات الزامی است.");
                        }else{
                            $.ajax({
                                url:"ajaxAdminPanel.php?funcAction=funcCreate",
                                type:"POST",
                                data:{
                                title: $("#titleInput").val(),
                                body: $("#bodyInput").val(),
                                status: $("#status").val()
                                },
                                dataType: "JSON",
                                cache: false,
                                success: function(data){
                                    const json =JSON.stringify(data);
                                    alert(json);
                                    setTimeout(() => {
			                	        var redirectUrl = "http://localhost/project-1/admin_panel.php";
			                	        window.location.href = redirectUrl;
			                        }, 1000);
                                },
                                error: function(xhr, status,error){
                                    console.error(xhr);
                                }
                            });
                        }
                    });
                });
            
                //Workshop editing
                $(".btnEdit").on('click',function(){
                    var workshopId = $(this).data('id');
                    $.get("ajaxAdminPanel.php?funcAction=funcBeforeShow&id="+workshopId, function(data, status){
                        const workshop= JSON.parse(data);
                        $("#titleInput").val(workshop[1]);
                        $("#bodyInput").val(workshop[2]);
                        $("#status").val(workshop[3]);
                    });

                    $("#ModalCreateEdit").submit(function(event){
                        event.preventDefault();
                        var titleInput = $("#titleInput").val();
                        var bodyInput = $("#bodyInput").val();
                        if(titleInput==""){
                            alert("فیلد عنوان الزامی است.");
                        }else if(bodyInput==""){
                            alert("فیلد توضیحات الزامی است.");
                        }else{
                            $.ajax({
                                url:"ajaxAdminPanel.php?funcAction=funcEdit&id="+workshopId,
                                type:"POST",
                                data:{
                                title: $("#titleInput").val(),
                                body: $("#bodyInput").val(),
                                status: $("#status").val()
                                },
                                dataType: "JSON",
                                cache: false,
                                success: function(data){
                                    const json =JSON.stringify(data);
                                    alert(json);
                                    setTimeout(() => {
			                	        var redirectUrl = "http://localhost/project-1/admin_panel.php";
			                	        window.location.href = redirectUrl;
			                        }, 1000);
                                },
                                error: function(xhr, status,error){
                                    console.error(xhr);
                                }
                            });
                        }
                    });
                });
                


                //Workshop delete
                $(".btnDelete").on('click',function(){
                    var workshopId = $(this).data('id');
                    $.ajax({
                        url:"ajaxAdminPanel.php?funcAction=funcDelete",
                        type:"POST",
                        data:{
                        id:workshopId
                        },
                        dataType: "JSON",
                        cache: false,
                        success: function(data){
                            const json =JSON.stringify(data);
                            alert(json);
			                setTimeout(() => {
			                	var redirectUrl = "http://localhost/project-1/admin_panel.php";
			                	window.location.href = redirectUrl;
			                }, 1000);
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

