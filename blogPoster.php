<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset=UTF-8>
    <title>This page is running in standards mode!</title>

  </head>
  <body>
<?php
include "includes/header.php";
include "includes/nav.php";

?>


<main id="main" class="main">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- <script src="jsApi/textEditor.js"></script> -->
<script src='https://cdn.tiny.cloud/1/jq0dwhthpxi4rg6ditkyjozjes6f6hgm8jc0yi2m9d7vyat5/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<!-- <script>
    tinymce.init({
      selector: '#xxzx',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script> -->

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

  <script>
    var i = 0
    var sequence = []
    // function to handle adding input title 
    function addTitle(){
      
      sequence[i+1] = 'title'
      i = i +1
      $.ajax({
        url: 'jsApi/need.php',
        type: 'POST',
        data: {
          appendName:'title',
          id: i 
        },
        success: function(data){
          // alert('in')
          
          
          $('#blogHolder').append(data)
        },
        
      })
    }

    // function to handle photo inputimg
    function addText(){
     
      sequence[i+1] = 'text'
      i = i+1
      $.ajax({
        url: 'jsApi/need.php',
        type: 'POST',
        data: {
          appendName:'text',
          id: i 
        },
        success: function(data){
          // alert('in')
          
         
          $('#blogHolder').append(data)
        },
        
      })

      // alert(sequence)
      // alert(len)
    }

    // function to handle text input
    function  addPhoto(){
      
      sequence[i+1] = 'image'
      i=i+1
      $.ajax({
        url: 'jsApi/need.php',
        type: 'POST',
        data: {
          appendName:'image',
          id: i 
        },
        success: function(data){
          // alert('in')
          
         
          $('#blogHolder').append(data)
        },
        
      })
  
    }

    // function uploadBlog(){
      $(document).ready(function(){

      $('form').on('submit', function(e){
        // alert('in')
        e.preventDefault()
        
     // this ajax is  submit handller. it handles the inputed data and sends it to dbAPi.php 
        $.ajax({  
          url: 'jsApi/dbApi.php',
          type: 'post',
          data: new FormData(this),
          success: function(data){  
            // after the success of the data submition then we have to send the sequence array w/c holds the sequence of data types
            // alert('out')
            $.ajax({
            url: 'jsApi/dbApi.php',
            type: 'post',
            data:{
              sequence: sequence
            },
            success: function(data){
              // alert(new FormData(this))
              alert(data)
                
            }
          })
              // $('#inform').append(data)
          },
          processData: false,
          contentType: false
        })
     
        })  })
    // }



  </script>
  
  <div id="floatPanel" class="card p-3" style="width: 400px; position:fixed; top:70px; left:930px; z-index:5;"  >

    <h5>Select What To Add Next</h5>
      <div class="row">
        <div class="col">
          <h5>Add Title</h5><br>
          <button class="btn btn-dark" onclick="addTitle()"  >Add Title</button>
        </div>
        <div class="col">
          <h5>Add Photo</h5><br>
          <button class="btn btn-dark" onclick="addPhoto()" >Add Photo</button>
        </div>
        <div class="col">
          <h5>Add Text</h5><br>
          <button class="btn btn-dark" onclick="addText()" >Add Text</button>
        </div>
      </div>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg2">

        <div  class="card">
          <div   class="card-body">
            <h5 class="card-title">Write A blog</h5>
            <script>
              $(document).ready(function(){

              })
            </script>

            <!-- General Form Elements -->
            <form    method="POST" enctype="multipart/form-data" >
              <div id="title<?php echo $div ?>" class="row mb-3">
                <div class="col-sm-10">
                    <input type="text" name="titleM" multiple class="form-control" placeholder="Title">
                </div>
            
              </div> 
                <div >
                  <h5>Content</h5>  
                  <hr>
                  <p id="blogHolder" class="border border-success p-4 " style="min-height: 400px;">

                  </p>

             
          
                </div>        



              <input class="btn btn-lg btn-primary" type="submit" value="Post Blog">


            </form><!-- End General Form Elements -->
              <div id="inform">

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
  <!-- <script src="assets/vendor/tinymce/tinymce.min.js"></script> -->
  <script src="assets/vendor/php-email-form/validate.js"></script> 

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>