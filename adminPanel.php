<!DOCTYPE html>
<html lang="en">

<?php
  include "./includes/header.php";
?>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="admin.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
  

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Manage Posts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="./blogPoster.php">
              <i class="bi bi-circle"></i><span>Blog</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>About</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Manage Account</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <?php
            if($_SESSION['auth'] == 'ADMIN'){
                ?>
                
                <li>
            <a href="registor.php">
              <i class="bi bi-circle"></i><span>Add Admin/Editor</span>
            </a>
          </li> 
          <li>
            <a href="blogManager.php?personal=true">
              <i class="bi bi-circle"></i><span>Manage Editor</span>
            </a>
          </li> 
                <?php
            }
            
            ?>

          <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="blogManager.php?yourPost=true">
          <i class="bi bi-person"></i>
          <span>Your Posts</span>
        </a>
      </li>
         
        </ul>
      </li><!-- End Forms Nav -->



<!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Blogs <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-image"></i>
                    </div>
                    <div class="ps-3">
                        <?php
                        require_once "./php/fetchApi.php";
                        $blogg = allPostListerOnTable('blogPost');
                        $num = $blogg->num_rows;
                        ?>
                      <h6><?php echo $num ?></h6>
                      <span class="text-success small pt-1 fw-bold">Number of Blogs</span> 

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">



                <div class="card-body">
                  <h5 class="card-title">Admin <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                        require_once "./php/fetchApi.php";
                        $blogg3 = allPostListerOnColumen('user','auth','ADMIN');
                        $num3 = $blogg3->num_rows;
                        ?>
                      <h6><?php echo $num3 ?></h6>                      <span class="text-success small pt-1 fw-bold">This Are Your admins</span> 

                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->

            <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
            <div class="card-body">
                  <h5 class="card-title">Editors <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                        require_once "./php/fetchApi.php";
                        $blogg2 = allPostListerOnColumen('user','auth','EDITOR');
                        $num2 = $blogg2->num_rows;
                        ?>
                      <h6><?php echo $num2 ?></h6>                      <span class="text-success small pt-1 fw-bold">This Are Your admins</span> 

                    </div>
                  </div>
                </div>
            </div>
            </div>


            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Welcome <span>| <?php echo $_SESSION['name'] ?></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6></h6>
                      <span class="text-Info small pt-1 fw-bold">Hope You Are Having A Good Time</span> 

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
                  <!-- <section class="section">
      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Write A blog</h5>

              General Form Elements
              <form>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>                
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                 <div class="row mb-3">
              <h5 class="card-title">Description</h5>

              Quill Editor Default
              <div class="quill-editor-default">
               
              </div>
              End Quill Editor Default

          </div>
          <a href="pages-error-404.html" type="button" class="btn btn-lg btn-primary">Blog</a>
              </form>End General Form Elements

            </div>
          </div>

        </div>

      </div>
    </section> -->

          </div>

        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">


        </div><!-- End Right side columns -->

      </div>
    </section>


  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
<?php
include "./includes/adminFooter.php";
?>
</body>
</html>