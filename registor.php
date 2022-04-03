<?php

include "./includes/nav.php";

?>

  <main id="main" class="main">

  <script src="assets/jquery.js" type="text/javascript"></script>
  <script>
      $(document).ready(function(){
        $('#registerBox').on('submit', function(e){
      e.preventDefault()
      $.ajax({
        url: 'registor.php',
        type: 'post',
        data:  new FormData( this ),
        success : function(data){
          $('#alertVacancy').text(data)
        },
        processData: false,
    contentType: false
      })
      return false;

    })
      })
  </script>
<div class="container">
  <form action="registor.php"  method="POST" enctype="multipart/form-data" >
    <div id="registerBox2">
    <label for="exampleInputEmail1">First Name</label>
          <input type="text" class="form-control" id="firstName" 
          aria-describedby="emailHelp" name="firstName" placeholder="First Name">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div id="registerBox">
    <label for="exampleInputEmail1">Last Name</label>
          <input type="text" class="form-control" id="lastName" 
          aria-describedby="emailHelp" name="lastName" placeholder="Last Name">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div id="registerBox">
    <label for="exampleInputEmail1">Phone Number</label>
          <input type="number" class="form-control" id="phoneNumber" 
          aria-describedby="emailHelp" name="phoneNumber" placeholder="phoneNumber">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div id="registerBox">
    <label for="exampleInputEmail1">UserName</label>
          <input type="email" class="form-control" id="username" 
          aria-describedby="emailHelp" name="username" placeholder="Username">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div id="registerBox">
    <label for="exampleInputEmail1">Password</label>
          <input type="text" class="form-control" id="password" 
          aria-describedby="emailHelp" name="password" placeholder="password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01"> AUTHERIZATION</label>
        </div>
        <select class="custom-select" name="auth" id="inputGroupSelect01">
          <option >Choose...</option>
          <option value="ADMIN">ADMIN</option>
          <option value="EDITOR">EDITOR</option>
        </select>
        </div>
        
        <div id="registerBox">
    <label for="exampleInputEmail1">Password Recovery Keyword</label>
          <input type="email" class="form-control" id="username" 
           name="recover" placeholder="Username">
          <small id="emailHelp" class="form-text text-muted">This here is a key word you have to remember your password when you forget it.</small>
    </div>

     

        <div id="registerBox">
    <label for="exampleInputEmail1">Upload Profile Photo</label>
          <input type="file" class="form-control" id="photo" 
           name="photoq" >
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div id="uploadStat"></div>


      <input class="btn btn-light" type="submit" value="Register">
 
  </form>
  <div id="alertVacancy">
    
  <?php
    include('includes/header.php');
    require_once "php/adminCrude.php";
    require_once "php/auth.php";

    if(isset($_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_POST['username'],
     $_POST['password'], $_POST['auth'], $_FILES['photoq'], $_POST['recover'])){

      // echo 'in';
         $firstName =$_POST['firstName'] ;
         $lastName =$_POST['lastName'] ;
         $phoneNumber =$_POST['phoneNumber'] ;
         $username =$_POST['username'] ;
         $password =$_POST['password'] ;
         $auth1 =$_POST['auth'] ;
        //  $password = password_hash($password, PASSWORD_DEFAULT);
        $recover = $_POST['recover'];
         $check = $auth->loginAuth($username);

         if($check->num_rows > 0){
           echo 'Username Taken';
         }



         //to add user data
        //  $out = $admin->userAdder($firstName, $lastName, $phoneNumber, $username, $password, $auth, '', $job, $about); 

        //to add user data and photo upload if user adds photo since its optional
         elseif(isset($_FILES['photoq']) && $_FILES['photoq'] == ' '){
          $tempName = $_FILES['photoq']['tmp_name'];
          $fileName = $_FILES['photoq']['name'];
                    //to upload photo
                    $up = $admin->uploadPhoto($fileName, $tempName);
                    $out = $admin->userAdder($recover, $firstName, $lastName, $phoneNumber, $username, $password, $auth1, $up ); 
                    if($out){
                      echo 'Register Succsesfull';
                    }else{
                      echo 'error';
                    }
        
                  }else{
          $out = $admin->userAdder($recover,$firstName, $lastName, $phoneNumber, $username, $password, $auth1, ' ' ); 
          if($out){
            echo 'Register Succsesfull';
          }else{
            echo 'error';
          }
         }
        


     }

     

?>
  </div>
    
  </div>

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