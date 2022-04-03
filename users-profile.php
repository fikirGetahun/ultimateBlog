<?php

include "./includes/nav.php";
ob_start();
session_start();
$u = $_SESSION['id'];
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <?php  
          require_once "./php/fetchApi.php";
          $user = $get->allPostListerOnColumen('user', 'id', $u );
          $row = $user->fetch_assoc();
        
        ?>
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php echo $_SESSION['photo'] ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['name'] ?></h2>
              <h3><?php echo $_SESSION['auth'] ?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

            

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>
<?php 
  $us = $get->allPostListerOnColumen('user', 'id', $_SESSION['id']);
  $u = $us->fetch_assoc();

?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $u['firstName'].' '.$u['lastName'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">Atrons Consulting </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['auth'] ?> Manager</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">Ethiopia</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">Addis Abeba</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $u['phone'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $u['username'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Registered Date</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['reg'] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
<script src="assets/jquery.js" ></script>
                <script>
                  $(document).ready(function(){
                    $('form').on('submit', function(e){
          e.preventDefault()
          $.ajax({
            url: 'php/deleteApi.php',
            type: 'post',
            data:  new FormData( this ),
            success : function(data){
              $( 'form' ).each(function(){
                    this.reset();
              });
              $('#alertVacancy').text(data)
              alert(data)
              location.reload()
              // $('#alertVacancy').delay(3200).fadeOut(300);
            },
            processData: false,
        contentType: false
          })
          
          return false;

    })
                  })
                </script>


                  <!-- Profile Edit Form -->
                  <form>
                  <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?php echo $u['photoPath1'] ?>"pt-2">
                        <input type="file" name="photo">                   
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    <!-- </div> -->
                    
                  <form>

<div class="row mb-3">
  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
  <div class="col-md-8 col-lg-9">
    <input name="firstName" type="text" class="form-control" id="firstName" value="<?php echo $u['firstName'] ?>">
  </div>
</div>

<div class="row mb-3">
  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
  <div class="col-md-8 col-lg-9">
    <input name="lastName" type="text" class="form-control" id="firstName" value="<?php echo $u['lastName'] ?>">
  </div>
</div>

<div class="row mb-3">
  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
  <div class="col-md-8 col-lg-9">
    <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $u['phone'] ?>">
  </div>
</div>

<div class="row mb-3">
  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Change Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="password" type="text" class="form-control" id="Phone" value="<?php echo $u['password'] ?>">
  </div>
</div>


<div class="text-center">
  <button type="submit" class="btn btn-primary">Save Changes</button>
</div>
</form><!-- End Profile Edit Form -->
                    <!-- <input type="submit" value="Save Changes"> -->
                </form>
                </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
               <!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
               
                </div>

              </div><!-- End Bordered Tabs -->

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