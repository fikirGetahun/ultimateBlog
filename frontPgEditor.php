<?php
include "includes/header.php";
include "includes/nav.php";
require_once "php/fetchApi.php";
 
if(!isset($_SESSION['id'])){
  // echo 'yes';
}
  include "php/connect.php";
  if(isset($_POST['vison'], $_POST['aboutUS'] )){
    // echo 'in';
    $title = $_POST['vison'];
    $content = $_POST['aboutUS'];
    $pid = $_SESSION['id'];
    // echo 'user d--'.$pid;
    


      $outs= $get->updateOn2Colomen('frontPage', 'aboutUs', $content, 'vision', $title, 200);
      $out = $mysql->query($outs);
      // echo $mysql->error;
      if($out){
        echo 'Saved Changes';
      }else{
        echo 'ERROR';
      }
    

  }




?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Form Elements</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item active">Elements</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <?php
    // data fetcher
    $fetchs = $get->allPostListerOnColumen('frontPage', 'id', 200);
    $aboutUs = $fetchs->fetch_assoc();
   

  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Change Front Page Information!</h5>

            <!-- General Form Elements -->
            <form action="frontPgEditor.php" method="POST"  >
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Change Your Vision</label>
                <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" name="vison" ><?php echo $aboutUs['aboutUs'] ?></textarea>
                </div>
              </div>  
            
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Change About us</label>
                <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" name="aboutUS" ><?php echo $aboutUs['vision'] ?> </textarea>
                </div>
              </div>  

              <input class="btn btn-lg btn-primary" type="submit" value="Save Changes">



            </form><!-- End General Form Elements -->

  <h4>Add Additional Photos To Gallary</h4>
            <form action="frontPgEditor.php" method="POST" enctype="multipart/form-data" >
            <div class="row mb-3">
                 <div class="col-sm-10">
                <input class="form-control" required type="file" name="photo[]" id="formFile"   >
                </div>
              </div>  
              <input class="btn btn-lg btn-primary" on type="submit" value="Add Photos">

            </form>
    <script>
        $(document).ready(function(){
            setTimeout(function() {
  $("#gall").remove();
}, 3000);
        })
    </script>
            <?php

            require_once "./php/adminCrude.php";
            if(isset(  $_FILES['photo'])){
            // echo 'in';
 
            $fileVar = $_FILES['photo'];

            $up = $admin->uploadPhotos('frontPage', $fileVar);
            if($up[4] == 'work'){
                $pho = $up[0];
                $out = "INSERT INTO `frontPage`( `aboutUs`, `vision`) VALUES ( 'file','$pho')";
                $ask = $mysql->query($out);
                if($ask ){
                echo '<span id="gall" class="text-success"  >Photo Added To Gallary</span>';
                }else{
                echo 'ERROR';
                }
            }

            }
            
            ?>
            <div id="pp" class="row">
            <?php
            if(isset($_GET['delete'])){
                $did = $_GET['delete'];
                $del= $get->postDeleter('frontPage', $did);
                if($del){
                    echo '<span id="gall" class="text-success" > Photo Deleted! </span>';
                }
            }


            $ff = $get->allPostListerOnColumenx('frontPage', 'aboutUs', 'file');

            while($row = $ff->fetch_assoc()){
            ?>
            <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
                <a href="<?php echo $row['vision'] ?>" class="galelry-lightbox">
                <img src="<?php echo $row['vision'] ?>" alt="" class="img-fluid">
                </a>
            </div>
            <a href="./frontPgEditor.php?delete=<?php echo $row['id'] ?>#pp"  class="btn btn-dark">Delete photo</a>
            </div>
            <?php
            }
            ?>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Changity</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://keneandigitaltechnology.com/">Kenean digital technology</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>