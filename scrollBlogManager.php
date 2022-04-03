<?php
ob_start();
if(!isset($_SESSION)){
    session_start();
}
require_once "php/fetchApi.php";
$pidd = $_SESSION['id'];

$blogList = $get->allPostListerOnColumenD('blogPost', 'posterId', $pidd, $_SESSION['adminMoreView'], 8);
if($blogList[0]->num_rows == 0){
//   echo 'NO POST TO SEE';
}else{

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
<?php
}
?>