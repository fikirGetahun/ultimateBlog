<?php
include "./includes/nav.php";
require_once "php/adminCrude.php";
require_once "php/fetchApi.php";


$pidd = $_SESSION['id'];
$name = $_SESSION['name'];
$_SESSION['adminMoreView'] = 0;
?>
<script src="assets/jquery.js" ></script>
<script>
    function del(id){
        if(confirm("Are You Sure You Want To Delete This Post?") == true){
        $.ajax({
            url: 'php/deleteApi.php',
            type: 'POST',
            data:{ bid: id},
            success: function(data){
                alert(data)
                location.reload()
            }
        })
    }
    }

    function delUser(id){
        if(confirm("Are You Sure You Want To Remove This User?") == true){
        $.ajax({
            url: 'php/deleteApi.php',
            type: 'POST',
            data:{ eid: id},
            success: function(data){
                alert(data)
                location.reload()
            }
        })
    }
    }


    function viewMore(){
      $.ajax({
        url: 'jsApi/need.php',
        type: 'post',
        data: {
          adminMoreView: 'true'
        },
        success: function(){
          $.ajax({
            url: 'scrollBlogManager.php',
            type: 'get',
            success:function(data){
              $('#fu').append(data)
            }
          })
          
        }
      })
    }
</script>


  <div id="main"  class="main">
    
      <?php

if(isset($_GET['yourPost'])){

      $blogList = $get->allPostListerOnColumenD('blogPost', 'posterId', $pidd, 0, 8);
      if($blogList[0]->num_rows == 0){
        echo 'NO POST TO SEE';
      }else{
        ?>
        <div id="fu">
        <?php
      while($row = $blogList[0]->fetch_assoc()){
          ?>
<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['title'] ?></h5>
    <p class="card-text" style="
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 13ch;"> ><?php echo $row['content'] ?></p>
    <?php 
        $time = $get->time_elapsed_string($row['postedDate'])
    ?>
    <p class="card-text"><small class="text-muted"><?php echo $time ?></small></p>
    <p class="card-text"><small class="text-muted">Posted By; <?php echo $name ?></small></p>
    <button onclick="del('<?php echo $row['id'] ?>')" >Delete</button>
  </div>
</div>
          
          <?php
      }
      ?>
</div>
      <button id="more" onclick="viewMore()">View More</button>
      <?php
    }
    }




    if(isset( $_GET['eid'], $_GET['show'])){
      $eid = $_GET['eid'];

      $blogList = $get->allPostListerOnColumen('blogPost', 'posterId', $eid);
      $userData = $get->allPostListerOnColumen('user','id', $eid);
      $urow2 = $userData->fetch_assoc();
      if($blogList->num_rows == 0){
        echo 'NO POST TO SEE';
      }

      while($row = $blogList->fetch_assoc()){
          ?>
<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['title'] ?></h5>
    <p class="card-text"><?php echo $row['content'] ?></p>
    <?php 
        $time = $get->time_elapsed_string($row['postedDate'])
    ?>
    <p class="card-text"><small class="text-muted"><?php echo $time ?></small></p>
    <p class="card-text"><small class="text-muted">Posted By; <?php echo $urow2['firstName'].' '.$urow2['lastName'] ?></small></p>
    <button onclick="del('<?php echo $row['id'] ?>')" >Delete</button>
  </div>
</div>
          
          <?php
      }
    }



    if(isset($_GET['personal'])){
      $bloger = $get->allPostListerOnColumen('user','auth','EDITOR');

      while($row2 = $bloger->fetch_assoc()){
        
        ?>
        <div class="card mb-3">
        <img src="<?php echo $row2['photoPath1'] ?>" class="rounded mx-auto d-block w-25 float-left" alt="...">
  <div class="card-body">

  <h5 class="card-title"><?php echo $row2['firstName'].' '.$row2['lastName'] ?></h5>
    <?php 
        // $time = $get->time_elapsed_string($row['postedDate'])
    ?>
    <p class="card-text"><small class="text-muted"><a href="blogManager.php?show=true&eid=<?php echo $row2['id'] ?>" ><button  >View Editors Posts</button></a></small></p>
    <button onclick="delUser('<?php echo $row2['id'] ?>')" >Remove User</button>
  </div>
</div>
         
        
        <?php
      }


    }
      ?>




  </div><!-- End #main -->
  <div class="main">
  <!-- <button id="more" onclick="viewMore()">View More</button> -->
  </div>

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