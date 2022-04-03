

<?php
ob_start();
if(!isset($_SESSION)){
    session_start();
}
// blog listing scrolling in admin page
if(isset($_POST['adminMoreView'],$_POST['id'] )){
    $_SESSION['adminMoreView'] += 8; //this is to load the next 8 pages starting after loaded 8 posts
}



// TITLE or TEXT or IMAGE APPENDER API
if(isset($_POST['appendName'], $_POST['id'])){
    $div = $_POST['id'];
    if($_POST['appendName'] == 'title'){
        ?>
        
        <script>


    //function to close title block on close button
    function closeTitle(div, id){
      
      
      $('#'+div).empty()
      sequence[id]='null'
      
      
    }
    // first stage is done now it only remains code cleaning and clear mannaging system.. and as well as bootstrap tepletes to choose and mangeing how to swap from one template to another one




        </script>

        <div id="title<?php echo $div ?>" class="row mb-3">
            <div class="col-sm-10">
                <input type="text" name="title[]" multiple class="form-control" placeholder="Title">
            </div>
            <button class="btn btn-danger" style="width: 90px; height: 35px;" type="button" onclick="closeTitle('title<?php echo $div ?>', '<?php echo $div ?>')" >close</button>
        </div> 
        <?php
    }elseif($_POST['appendName'] == 'image'){
        ?>

        <script>

        //function to close image block on close button
        function closeImage(div, id){
       
      $('#'+div).empty()
      sequence[id]='null'
      
     }
        </script>
              <div id="image<?php echo $div ?>" class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label><br>
                <div class="col-sm-10">
                  <input class="form-control" required type="file" name="photo[]" id="formFile"  multiple  >
                  <small>You can add multiple photos.</small>
                </div>
                <button class="btn btn-danger" type="button" style="width: 90px; height: 35px;" onclick="closeImage('image<?php echo $div ?>', '<?php echo $div ?>')" >close</button>
              </div>
        <?php
    }elseif($_POST['appendName'] == 'text'  ){
      
        ?>
 
         <script>
                             //function to close title block on close button
    function closeText(div, id){
      
      
      $('#'+div).empty()
      sequence[id]='null'
      
      
    }

    tinymce.init({
      selector: '#xxz<?php echo $div ?>',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
         </script>
 

               <div id="text<?php echo $div ?>" class="row mb-3">
                 <div class="col-sm-10">
                  <textarea id="xxz<?php echo $div ?>" class="form-control" style="height: 100px" name="content[]" placeholder="Type text here!." ></textarea>
                </div>
                <button class="btn btn-danger" type="button" style="width: 90px; height: 35px;" onclick="closeText('text<?php echo $div ?>', '<?php echo $div ?>')" >close</button>
              </div>
        <?php
    }
}
 

?>