<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
        // show modal
            $(document).ready(function(){
                $("#btnShow").click(function(){
                    $.get("ajaxAdminPanel.php", function(data, status){
                        const workshops= JSON.parse(data);
                        // $("demo").text(workshops);
                        alert("data: "+workshops+"\nstatus:"+status);
                        // $("#modalShow").innerHTML(
                        //     <h5 class="card-title fw-bold">title</h5></div>
                        //     <p class="card-text text-secondary text-justify pt-3">لورم ایپسوم یک متن ساختگی است</p>
                        //     <div>
                        //         <span class="badge text-bg-secondary">وضعیت</span>
                        //     </div>
                        // );
                    });
                });
            });
        //end show modal
        </script>
    </head>
    <body>
            <p id="demo">this</p>
            <div class="container-fluid">
            <div class="row">
                <main class="col-12 ms-sm-auto  ">
                    <div class="d-flex shadow-sm justify-content-between flex-wrap flex-md-nowrap  align-items-center pt-4 pb-3 px-3 mb-3 border-bottom">
                        <h1 class="fs-3">کارگاه ها</h1>
                        <div class="btn-toolbar mb-md-2 mb-0 ">
                            <a href="#" class="btn btn-sm border border-secondary-subtle btn-dark fs-5 fw-medium" data-bs-toggle="modal" data-bs-target="#edit&createModal">
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
                                    <tr>
                                        <th>1</th>
                                        <td>لورم</td>
                                        <td>لورم ایپسوم یک متن ساختگی است.</td>
                                        <td>published</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-dark">حذف</a>
                                            <a href="#" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#edit&createModal">
                                                ویرایش
                                            </a>
                                            <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#viewModal" id="btnShow">
                                                مشاهده
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- ....... -->
                                    <tr>
                                        <th>1</th>
                                        <td>لورم</td>
                                        <td>لورم ایپسوم یک متن ساختگی است.</td>
                                        <td>published</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-dark">حذف</a>
                                            <a href="#" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#edit&createModal">
                                                ویرایش
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#viewModal">
                                                مشاهده
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- ....... -->
                                    <tr>
                                        <th>1</th>
                                        <td>لورم</td>
                                        <td>لورم ایپسوم یک متن ساختگی است.</td>
                                        <td>published</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-dark">حذف</a>
                                            <a href="#" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#edit&createModal">
                                                ویرایش
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#viewModal">
                                                مشاهده
                                            </a>
                                        </td>
                                    </tr>
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
                                    <form class="row g-4" method="POST" enctype="multipart/form-data">
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <label for="exampleFormControlTitle"class="form-label">عنوان کارگاه</label>
                                            <input type="text" class="form-control" name="title" id="exampleFormControlTitle"/>
                                        </div>
                                        <div class="col-12">
                                            <label for="exampleFormControlDescription"class="form-label">توضیحات</label>
                                            <textarea class="form-control" rows="6" name="body" id="exampleFormControlDescription"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark" name="submit">
                                                ایجاد|ویرایش
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
                    <!-- viewModal -->
                    <div class="modal fade" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <div class="card-body" id="modalView">
                                                        <div class="d-flex justify-content-between" id="modalShow">
                                                            <!-- add to script-->
                                                            <button type="submit" class="btn btn-dark" name="submit">مشاهده ثبت نامی ها</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <!-- Modal show ended -->
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <button>Send an HTTP GET request to a page and get the result back</button>
    </body>
</html>

