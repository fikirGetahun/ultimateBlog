<?php 
ob_start();
if(!isset($_SESSION)){
  session_start();
}

// $_SESSION['title'] = array();
// $_SESSION['content'] = array();
// $_SESSION['photo'] = array();
// $_SESSION['sequence']= array();

$pid = $_SESSION['id'];
require_once "../php/adminCrude.php";

require_once "../php/fetchApi.php";
  // the data seqence handler api
  if(isset($_POST['sequence'])){
    echo 'inn sequence';  
    $seq=array();
    $seq = $_POST['sequence'];
    $final = array();
    $titleIndex = 0;
    $textIndex = 0;
    $photoIndex = 0;

    // var_dump($_SESSION['title']);

    foreach($seq as $selected){
      // if the selected array data is not null this means its not deleted
      if($selected != 'null'){
        if($selected == 'title'){
          $_SESSION['title'][$titleIndex] = addslashes($_SESSION['title'][$titleIndex]);
          $final+= array( 'title' => $_SESSION['title'][$titleIndex]); // this appends the title data on the first index w/c is 0. then it contiunous based on the titleindex
          $titleIndex++; // then it increament the tilteindex by 1 so that when next time its a title data, then it accesses the next data of the title array from the input form
        }elseif($selected == 'text'){
          $_SESSION['content'][$textIndex] = addslashes($_SESSION['content'][$textIndex]);
          $final+= array('text' => $_SESSION['content'][$textIndex]);
          $textIndex++;
        }elseif($selected == 'image'){
          $final+= array( 'image' => $_SESSION['image']['name'][$photoIndex]);
          $photoIndex++;
        }



      }



    }
    // after we push data respeactlly then implode it as associative array
// var_dump($_SESSION['image']);
    $final = implodeAssoc('%', $final);
    $upload = blogAdder($_SESSION['titleM'],$final, $pid );
    if($upload){
      echo "<span class='text-success'> Blog Uploaded! </span> ";
    }else{
      echo "<span class='text-danger'> Error </span> ";
    }



  }
            
        // blog data inserter api
       
           
              // echo 'in';
              if(isset($_POST['titleM'])){
                $titleM = $_POST['titleM'];
                $_SESSION['titleM'] = $titleM;
           
              if(isset($_POST['title'])){
                $title = $_POST['title'];
                $_SESSION['title'] = $title;
              }
              if(isset($_POST['content'])){
                $content = $_POST['content'];
                $_SESSION['content'] = $content;              
              }
              if(isset($_FILES['photo'])){
                $fileVar = $_FILES['photo'];
                $_SESSION['image'] = $fileVar;
              }

              echo 'true';
            }
              
             
              // echo 'user d--'.$pid;
             
                // var_dump($fileVar);
                // var_dump($_SESSION['title'][0]);
                
            //   $up = $admin->uploadPhotos('blog', $fileVar);
            //   if($up[4] == 'work'){
            //     $out = $admin->blogAdder($title, $content, $pid, $up[0]);
            //     if($out){
            //       echo 'Blog Posted';
            //     }else{
            //       echo 'ERROR';
            //     }
            //   }

        
          
          
          ?>