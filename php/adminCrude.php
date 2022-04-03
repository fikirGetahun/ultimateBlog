<?php
    

     

        //USER ADDER AS 'ADMIN' OR 'EDITOR'
        function userAdder($recover,$firstName, $lastName, $phone, $username, $password, $auth, $photoPath){
            include "connect.php";
            $date = date('Y-m-d');


            $q ="INSERT INTO `user`( `recover`, `username`, `password`, `firstName`, `lastName`, `phone`, `auth`,`photoPath1`,`lastLogedIn`, `registerdDate` )
             VALUES ('$recover', '$username', '$password', '$firstName', '$lastName', '$phone', '$auth', '$photoPath', '$date', '$date' )";

             $ask = $mysql->query($q);
echo $mysql->error;
             return $ask;

        }



        ///update password
        function password($passx, $id){
            include "connect.php";
            $x = $passx;

            $qz = "UPDATE `user` SET `password` = '$x'   WHERE `user`.`id` = '$id'";
    
            $ask = $mysql->query($qz);
            echo $mysql->error;
    
            return $ask;
        }



        //user auth identifier
        function userDataShower($uid){
            include "connect.php";
            $q = "SELECT * FROM `user` WHERE `id` = '$uid'";

            $ask = $mysql->query($q);
            return $ask;
        }

        //user number count
        function userNumber($auth){
            include "connect.php";
            $q = "SELECT * FROM `user` WHERE `auth` = '$auth'";

            $ask = $mysql->query($q);

            return $ask;
        }

        //to upload profile photo of user
        function uploadPhoto($fileName, $tempName){
            include "connect.php";
            //to count the files uloaded so that to attach the filename.numberofphoto
            $q = "SELECT * FROM `user` WHERE 1";
            $ask = $mysql->query($q);
            $num = md5(microtime());
            $location = "./uploads/adminPhoto/";
            $real = "./uploads/adminPhoto/";
            if(move_uploaded_file($tempName, $location.$num.$fileName)){
                // echo $location.$fileName.$num;
                $location = $real.$num.$fileName;
                return $location;
            }else{
                return 'FILE_NOT_UPLOADED';
            }
        }

        //update users data
        function updateUserData($uid, $password, $firstName, $lastName, $phone){
            include "connect.php";
            // $password = password_hash($password, PASSWORD_DEFAULT);
            $q = "UPDATE `user` SET `password`= '$password',`firstName`= '$firstName',
            `lastName`= '$lastName' ,`phone`= '$phone'   WHERE `user`.`id` = '$uid'";

            $ask = $mysql->query($q);
            echo $mysql->error;
            return $ask;
        }

        //update userphoto path and file
        function updateUserPhoto($fileName, $tempName, $uid){
            include "connect.php";
            $location = "../uploads/adminPhoto/";
            $x = rand(2, 20000);
            $path = $location.'a'.$x.$fileName;
            move_uploaded_file($tempName, $path);
            $real = "./uploads/adminPhoto/";
            $location = $real;
            $path = $location.'a'.$x.$fileName;
            
            $q = "UPDATE `user` SET `photoPath1`= '$path' WHERE `user`.`id` = '$uid'";
            $ask = $mysql->query($q);

            return $path;
        }

 


 


        //users post collecter
        function userPostCollecter($uid){
            include "connect.php";
            $q = "";
        }



        function uploadPhotos($path, $fileVar, $amount = 1 ){
            require_once "auth.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
            $count = count($fileVar['name']);
            // $amount = 3;
            // if($amount == 'blog'){
            //     $amount = 6;
            // }elseif($amount == 'webAd'){
            //     $amount = 1;
            // }elseif($amount == 'webAdx'){
            //     $amount = 3;
            // }else{
            //     $amount = 3;
            // }
            $uploadPathx = array();
            if($count <= $amount ){
                for($i=0;$i<=$count-1;$i++){
                    $fileName = explode('.',$fileVar['name'][$i]);
                    $fileExt = $fileName[1];
                    $mimeArr = explode('/', $fileVar['type'][$i]);
                    $mimeType = $mimeArr[0];
                    $mimeExt = $mimeArr[1];
                    $tmpLoc[] = $fileVar['tmp_name'][$i];
                    $fileSize[] = $fileVar['size'][$i];
                    $uploadName = md5(microtime()).'.'.$fileExt;

                    $uploadPathx[] = '../'.$path.$uploadName; 
                    if($i != 0){
                        $dbPath .= ',';
                    }
                    $dbPath .= './'.$path.$uploadName;

                    if(!in_array($fileExt, $allowedType)){
                        $error[] = 'File Extention must be png, jpg, jpeg';
                    }

                    if($mimeType != 'image'){
                        $error[] = 'File must be an Image';
                    }

                    if($mimeType != $fileExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                        $error[] = 'File extention does not match file';
                    }

                    if($fileSize[$i] > 15000000){
                        $error[] = 'File size exided the limited size.';
                    }
                }
                $total = array();

                if(!empty($error)){
                    $error[4] = 'error';
                    return $error;
                }else{
                    for($i=0;$i<=$count-1;$i++){
                        $up = compress($tmpLoc[$i], $uploadPathx[$i], 75 );
                    }
                    $total[0] = $dbPath;
                    $total[4] = 'work';
                    return $total;
                
            }

            }else{
                echo 'You can only post '.$amount.' images';
            }

        }

        //upload single photos
        function uploadSinglePhoto($tableName, $fileVar ){
            require_once "auth.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
                    $fileName = explode('.',$fileVar['name']);
                    $fileExt = pathinfo($fileVar['name'], PATHINFO_EXTENSION);
                    
                    $mimeArr = explode('/', $fileVar['type']);
                    $tmpLoc = $fileVar['tmp_name'];
                    $fileSize = $fileVar['size'];
                    $uploadName = md5(microtime()).'.'.$fileExt;

                    if($tableName == 'ad'){
                        $uploadPath = '../uploads/adPostsPhoto/'.$uploadName;
                        $dbPath .= './uploads/adPostsPhoto/'.$uploadName;
                    }
                    
                    if($tableName == 'electronics'){
                        $uploadPath = '../uploads/electronicsPhoto/'.$uploadName;
                        $dbPath .= './uploads/vacancyPhoto/'.$uploadName;
                    }
                    

                    if($tableName == 'car'){
                        $uploadPath = '../uploads/CarPostsPhoto/'.$uploadName;

                        $dbPath .= './uploads/CarPostsPhoto/'.$uploadName;
                    }

                    if($tableName == 'housesell'){
                        $uploadPath = '../uploads/houseOrLandPhotos/'.$uploadName;

                        $dbPath .= './uploads/houseOrLandPhotos/'.$uploadName;
                    }

                    if($tableName == 'tender'){
                        $uploadPath = '../uploads/tenderPhotos/'.$uploadName;

                        $dbPath .= './uploads/tenderPhotos/'.$uploadName;
                    }

                    if($tableName == 'charity'){
                        $uploadPath= '../uploads/charityPhoto/'.$uploadName;

                        $dbPath .= './uploads/charityPhoto/'.$uploadName;
                    }

                    if($tableName == 'hotelHouse'){
                        $uploadPath= '../uploads/homeWorker/'.$uploadName;

                        $dbPath .= './uploads/homeWorker/'.$uploadName;
                    }

                    
                    if($tableName == 'jobhometutor'){
                        $uploadPath= '../uploads/homeTutor/'.$uploadName;

                        $dbPath .= './uploads/homeTutor/'.$uploadName;
                    }

                    if($tableName == 'zebegna'){
                        $uploadPath= '../uploads/zebegnaPhoto/'.$uploadName;

                        $dbPath .= './uploads/zebegnaPhoto/'.$uploadName;
                    }




                    if(!in_array($fileExt, $allowedType)){
                        $error[] = 'File Extention must be png, jpg, jpeg';
                    }




                    if($fileSize > 15000000){
                        $error[] = 'File size exided the limited size.';
                    }
                
                $total = array();

                if(!empty($error)){
                    $error[4] = 'error';
                    return $error;
                }else{
                        $up = $auth->compress($tmpLoc, $uploadPath, 75 );
                    
                    $total[0] = $dbPath;
                    $total[4] = 'work';
                    return $total;
                
            }

    

        }
    

        //photo updater
        function photoUpdater($tableName, $pid, $fileVar){
            require_once "auth.php";
            include "connect.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
            $count = count($fileVar['name']);
            $amount = $count;
            if($tableName == 'blog'){
                $amount = 6;
            }
            if($count <= $amount ){
                for($i=0;$i<=$count-1;$i++){
                    $fileName = explode('.',$fileVar['name'][$i]);
                    $fileExt = $fileName[1];
                    $mimeArr = explode('/', $fileVar['type'][$i]);
                    $mimeType = $mimeArr[0];
                    $mimeExt = $mimeArr[1];
                    $tmpLoc[] = $fileVar['tmp_name'][$i];
                    $fileSize[] = $fileVar['size'][$i];
                    $uploadName = md5(microtime()).'.'.$fileExt;
                    if($tableName == 'ad'){
                        $uploadPath[] = '../uploads/adPostsPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/adPostsPhoto/'.$uploadName;
                    }
                    
                    if($tableName == 'electronics'){
                        $uploadPath[] = '../uploads/electronicsPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/vacancyPhoto/'.$uploadName;
                    }

                    if($tableName == 'car'){
                        $uploadPath[] = '../uploads/CarPostsPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/CarPostsPhoto/'.$uploadName;
                    }

                    if($tableName == 'housesell'){
                        $uploadPath[] = '../uploads/houseOrLandPhotos/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/houseOrLandPhotos/'.$uploadName;
                    }

                    if($tableName == 'tender'){
                        $uploadPath[] = '../uploads/tenderPhotos/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/tenderPhotos/'.$uploadName;
                    }

                    if($tableName == 'charity'){
                        $uploadPath[] = '../uploads/charityPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/charityPhoto/'.$uploadName;
                    }

                    if($tableName == 'jobhometutor'){
                        $uploadPath[]= '../uploads/homeTutor/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/homeTutor/'.$uploadName;
                    }

                    if($tableName == 'hotelhouse'){
                        $uploadPath[]= '../uploads/homeWorker/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/homeWorker/'.$uploadName;
                    }

                    if($tableName == 'zebegna'){
                        $uploadPath[]= '../uploads/zebegnaPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/zebegnaPhoto/'.$uploadName;
                    }

                    
                    if($tableName == 'blog'){
                        $uploadPath[]= '../uploads/blogPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/blogPhoto/'.$uploadName;
                    }

                    

                    if(!in_array($fileExt, $allowedType)){
                        $error[] = 'File Extention must be png, jpg, jpeg';
                    }

                    if($mimeType != 'image'){
                        $error[] = 'File must be an Image';
                    }

                    if($mimeType != $fileExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                        $error[] = 'File extention does not match file';
                    }

                    if($fileSize[$i] > 150000000){
                        $error[] = 'File size exided the limited size.';
                    }
                }
                $total = array();

                if(!empty($error)){
                    $total[0]= $error[0].''.$error[1].''.$error[2].''.$error[3];
                    $total[1] = 'error';
                    return $total;
                }else{
                    for($i=0;$i<=$count-1;$i++){
                        $up = $auth->compress($tmpLoc[$i], $uploadPath[$i], 75 );
                        $q = "UPDATE `$tableName` SET `photoPath1` = '$dbPath' WHERE  `$tableName`.`id` = '$pid'  ";
                        $ask = $mysql->query($q);
                        if($ask){
                            echo 'Photo Updated!';
                        }else{
                            echo 'Db Error';
                        }
                    }
                    $total[0] = $dbPath;
                    $total[1] = 'work';
                    return $total;
                }

            }else{
                echo 'You can only post '.$amount.' images';
            }
        }


        function singlePhotoUpdater($tableName, $pid, $fileVar){
            require_once "auth.php";
            include "connect.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
            $fileName = explode('.',$fileVar['name']);
            $fileExt = $fileName[1];
            $mimeArr = explode('/', $fileVar['type']);
            $mimeType = $mimeArr[0];
            $mimeExt = $mimeArr[1];
            $tmpLoc = $fileVar['tmp_name'];
            $fileSize = $fileVar['size'];
            $uploadName = md5(microtime()).'.'.$fileExt;
            if($tableName == 'ad'){
                $uploadPath = '../uploads/adPostsPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/adPostsPhoto/'.$uploadName;
            }
            
            if($tableName == 'electronics'){
                $uploadPath = '../uploads/electronicsPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/vacancyPhoto/'.$uploadName;
            }

            if($tableName == 'car'){
                $uploadPath = '../uploads/CarPostsPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/CarPostsPhoto/'.$uploadName;
            }

            if($tableName == 'housesell'){
                $uploadPath = '../uploads/houseOrLandPhotos/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/houseOrLandPhotos/'.$uploadName;
            }

            if($tableName == 'tender'){
                $uploadPath = '../uploads/tenderPhotos/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/tenderPhotos/'.$uploadName;
            }

            if($tableName == 'charity'){
                $uploadPath = '../uploads/charityPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/charityPhoto/'.$uploadName;
            }

            if($tableName == 'jobhometutor'){
                $uploadPath= '../uploads/homeTutor/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }

                $dbPath .= './uploads/homeTutor/'.$uploadName;
            }


            if($tableName == 'hotelhouse'){
                $uploadPath= '../uploads/homeTutor/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }

                $dbPath .= './uploads/homeTutor/'.$uploadName;
            }



            if(!in_array($fileExt, $allowedType)){
                $error[] = 'File Extention must be png, jpg, jpeg';
            }

            if($mimeType != 'image'){
                $error[] = 'File must be an Image';
            }

            if($mimeType != $fileExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                $error[] = 'File extention does not match file';
            }

            if($fileSize[$i] > 150000000){
                $error[] = 'File size exided the limited size.';
            }
        
        $total = array();

        if(!empty($error)){
            $total[0]= $error[0].''.$error[1].''.$error[2].''.$error[3];
            $total[1] = 'error';
            return $total;
        }else{
            for($i=0;$i<=$count-1;$i++){
            
                $up = $auth->compress($tmpLoc, $uploadPath, 75 );
                $q = "UPDATE `$tableName` SET `photoPath1` = '$dbPath' WHERE  `$tableName`.`id` = '$pid'  ";
                $ask = $mysql->query($q);
                if($ask){
                    echo 'Photo Updated!';
                }else{
                    echo 'Db Error';
                }
            }
            $total[0] = $dbPath;
            $total[1] = 'work';
            return $total;
        }
    }
        
    

        //to split all the photos from db photo path
        function photoSplit($dbPath){
            $path = explode(',', $dbPath);
            return $path;
        }




       ////blog uploader
       function blogAdder($title, $content, $posterId ){
           include "connect.php";
           $postedDate = date('Y-m-d H:i:s');
        //    $content = addslashes($content);
        //    $title = addslashes($title);
           $q = "INSERT INTO `blogPost` (`title`, `postedDate`, `content`, `posterId`, `photoPath1` )
            VALUES ('$title', '$postedDate', '$content', '$posterId', 'what'  )";

            $ask = $mysql->query($q);
        echo $mysql->error;
            return $ask;
       }


       ////blog update
       function blogUpdater($title, $frontLabel, $content, $pid){
        include "connect.php";
        $e = 'EDITED';
        $q = "UPDATE `blog` SET `title`= '$title', `frontLabel`= '$frontLabel', `content`= '$content',
         `edited` = '$e'  WHERE `blog`.`id` = '$pid' ";

         $ask = $mysql->query($q);

         return $ask;
    }
    
    


 

?>