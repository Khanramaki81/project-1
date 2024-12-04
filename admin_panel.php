<?php
include "./db.php";
$workshops = $db->query("SELECT * FROM workshops");
// echo '<pre>';
// print_r($workshops->fetchAll());
// echo '</pre>';
?>
<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
            <!-- <div id="demo"></div> -->
        <div class="container-fluid">
            <div class="row">
                <main class="col-12 ms-sm-auto  ">
                    <div class="d-flex shadow-sm justify-content-between flex-wrap flex-md-nowrap  align-items-center pt-4 pb-3 px-3 mb-3 border-bottom">
                        <h1 class="fs-3">کارگاه ها</h1>
                        <div class="btn-toolbar mb-md-2 mb-0 ">
                            <a href="#" class="btn btn-sm border border-secondary-subtle btn-dark fs-5 fw-medium btnCreate" data-bs-toggle="modal" data-bs-target="#edit&createModal">
                                ایجاد کارگاه
                            </a>
                        </div>
                    </div>

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
                                            <button type="submit" class="btn btn-dark" name="submit">
                                                 تایید
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--<div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>-->
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
                                    <button  type="button" class="btn btn-primary btnListShow">مشاهده ثبت نامی ها</button>
                                </div>
                                <div id="listShow">

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

                //Display the list of workshops
                $(".btnShow").on('click',function(){
                    var workshopId = $(this).data('id');
                    $.get("ajaxAdminPanel.php?funcAction=funcShow&id="+workshopId, function(data, status){
                        const workshop= JSON.parse(data);
                        // console.log(workshop[0]);
                        $("#MShow").append(workshop[0]+"<br>"+workshop[1]);
                    });
                    // start user list
                    $(".btnListShow").on('click',function(){
                        console.log(workshopId);
                        // $.get("ajaxAdminPanel.php?funcAction=funcListShow&id="+workshopId, function(data, status){
                        //     const subscribers= JSON.parse(data);
                        //     console.log(subscribers);
                        //     // $("#listShow").append(workshop[0]+"<br>"+workshop[1]);
                        // });
                    });
                });
                
                // var bodyInp = $("#bodyInput");
                // var titleInp = $("#titleInput");
                // $(".btnCreateEdit").on('click',function(){
                //     var workshopId = $(this).data('id');
                //     console.log(workshopId);
                //     $("#ModalCreateEdit").submit(function(event){
                //         event.preventDefault();
                //         var inputValueTitle = titleInp.val();
                //         var inputValueBody = bodyInp.val();
                //         var obj={"title":inputValueTitle,"body":inputValueBody};
                //         console.log(obj);
                //         var form_d =  JSON.stringify(obj);
                //         console.log(form_d);
                //         $.post("ajaxFormData.php",form_d,
                //             function(data,status){
                //                 alert("Data: " + form_d+ "\nStatus: " + status);
                //             });
                //     });
                // });

                //Workshop creating
                $(".btnCreate").on('click',function(){
                    $("#titleInput").val('');
                    $("#bodyInput").val('');
                    $("#status").val('draft');
                    $("#ModalCreateEdit").submit(function(event){
                        event.preventDefault();
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
                            },
                            error: function(xhr, status,error){
                                console.error(xhr);
                            }
                        });
                    });
                });
            
                //Workshop editing
                $(".btnEdit").on('click',function(){
                    var workshopId = $(this).data('id');
                    $.get("ajaxAdminPanel.php?funcAction=funcBeforeShow&id="+workshopId, function(data, status){
                        const workshop= JSON.parse(data);
                        // console.log(workshop[0]);
                        $("#titleInput").val(workshop[1]);
                        $("#bodyInput").val(workshop[2]);
                        $("#status").val(workshop[3]);
                        // console.log(workshop[]);
                    });

                    $("#ModalCreateEdit").submit(function(event){
                        event.preventDefault();
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
                                $(location).attr('href', 'https://.tutsplus.com');
                            },
                            error: function(xhr, status,error){
                                console.error(xhr);
                            }
                        });
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
                        },
                        error: function(xhr, status,error){
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>
        <!-- <button>Send an HTTP GET request to a page and get the result back</button> -->
    </body>
</html>

