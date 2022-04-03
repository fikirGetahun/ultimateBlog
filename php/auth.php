<?php
 

    //registering a normal user
    function registerUser($username, $password, $firstName, $lastName, $phone  ){
        include('connect.php');
        $q = "INSERT INTO `user`( `username`, `password`, `firstName`, `lastName`, `phone`, `auth`)
         VALUES ( '$username', '$password', '$firstName', '$lastName', '$phone', 'USER' )";

        $ask = $mysql->query($q);
         
    }

    //USER AUTHERIZATION CHECKER
    function checkAuth($uid){
        include('connect.php');
        $q = "SELECT `auth` FROM `user` WHERE `auth` = '$uid' ";

        $ask = $mysql->query($q);
        if($ask->fetch_assoc() == 'ADMIN'){
            return 'ADMIN';
        }else if($ask->fetch_assoc() == 'USER' ){
            return 'USER';
        }
    }

    //FOR CHECKING A USER IS IN DATABASE OR NOT
    function loginAuth($username){
        include('connect.php');
        $q = "SELECT  * FROM `user` WHERE `username` = '$username' ";

        $ask = $mysql->query($q);

        return $ask;
    }

            //last loged in date
            function lastLoged($uid){
                include "connect.php";
                $date = date('Y-m-d H:i:s');
                $q = "UPDATE `user` SET `lastLogedIn`= '$date' WHERE `user`.`id` = $uid";
    
                $ask = $mysql->query($q);
            }

    //users post collection lister
    function userPostsLister($uid, $tableName){
        include "connect.php";
        $item = array('zebegna', 'jobhometutor', 'hotelhouse' );
        if(!in_array($tableName, $item)){
        //    echo 'ty';
        $q = "SELECT * FROM `$tableName` WHERE `posterId` = '$uid'";
        }
        elseif($tableName == 'hotelhouse'){
            
        $q = "SELECT *  FROM `$tableName` WHERE `posterId` = '$uid'";
        }
        else{
            
        $q = "SELECT * FROM `$tableName` WHERE `posterId` = '$uid'";
        }


        $ask = $mysql->query($q);

        return $ask;

    }


    //compress image
    function compress($tmpLocation, $uploadPath, $qulity){
        $imageInfo = getimagesize($tmpLocation);
        $mime = $imageInfo['mime'];

        switch($mime){
            case 'image/jpeg':
                $image = imagecreatefromjpeg($tmpLocation);
                break;
            case 'image/png':
                $image = imagecreatefrompng($tmpLocation);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($tmpLocation);
            default:
                $image = imagecreatefromjpeg($tmpLocation);
        }

        imagejpeg($image, $uploadPath, $qulity);


        return $uploadPath;

    }


    //////////post deleter
    function postDeleter($table, $postId){
        include "connect.php";

        if($table != 'vacancy'){
            $q1 = "SELECT * FROM `$table` WHERE `id` = '$postId'";
            $ask1 = $mysql->query($q1);
            $row = $ask1->fetch_assoc();
            $file = $row['photoPath1'];
            $singl = explode(',',$file);
            foreach($singl as $s){
                if(isset($s)){
                    unlink('.'.$s);
                }
                
            }
            
        }

        $q = "DELETE FROM `$table` WHERE `$table`.`id` = '$postId'";
        $ask = $mysql->query($q);

        return $ask;

    }

            // echo $pass;



 
?>