<?php
include "includes/config.php";
session_start();
 if(!isset($_SESSION["user_email"])) {
   header("Location: index.php");
   die();
 }



 ?>

 <!doctype html>
 <html lang="en">
 <head>
    <?php getHead(); ?>
     <link rel="stylesheet" href="style.css" />
</head>

   <body>
    <?php getHeader(); ?>
    <div class="container">
      <h1 class="mb-4 text-center fw-bold">Your Todos</h1>
      <div class="row">
        <?php
        $sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0){
          $row = mysqli_fetch_assoc($res);
          $user_id = $row["id"];
        } else {
          $user_id = 0;
        }
            $sql1 = "SELECT * FROM todos WHERE user_id='{$user_id}' ORDER BY id DESC";
            $res1 = mysqli_query($conn,$sql1);
            if (mysqli_num_rows($res1)>0){
              foreach ($res1 as $todo){
                ?>
        <div class="col-lg-3 col-md-6 mb-4">
        <?php getTodo($todo); ?>
        </div>
      <?php } } else {echo "<h1 class='text-danger text-center fw-bold'>Todos are not available!</h1>";} ?>
      </div>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


   </body>
 </html>
