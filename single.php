<?php
include "./db.php";
$workshopID = $_GET['workshopId'];
$workshops = $db->query("SELECT * FROM workshops WHERE id=$workshopID");
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
                <main>
                    <!-- Content -->
                    <section class="my-4">
                        <div class="row justify-content-center">
                            <!-- Post Section -->
                            <?php foreach($workshops as $workshop):?>
                            <div class="col">
                                <div class="card">
                                     <div class="card-body">
                                        <div class="">
                                            <h5 class="card-title fs-4 fw-bold"><?=$workshop['title']?></h5>
                                            <p class="card-text  fs-5 pt-1"><?=$workshop['body']?></p>
                                            <a href="./index.php?user_id=<?=$_GET['user_id']?>" class="btn btn-sm btn-dark">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach?>
                        </div>
                    </section>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>



   