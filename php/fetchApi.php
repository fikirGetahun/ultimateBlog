<?php 

 


    ///// to fetch data from a 'table and condition(columen) with the argument
    function allPostListerOnColumen($table, $columen, $args){
        include "connect.php";
        $q = "SELECT * FROM `$table` WHERE `$columen` LIKE '$args' ORDER BY RAND() LIMIT 4 ";

        $ask = $mysql->query($q);

        return $ask;
    }

    function allPostListerOnColumenD($table, $columen, $args, $limitStart, $limitEnd){
        include "connect.php";
        $q2 = "SELECT * FROM `$table` WHERE `$columen` LIKE '$args' ORDER BY `postedDate` DESC";
        $q = "SELECT * FROM `$table` WHERE `$columen` LIKE '$args' ORDER BY `postedDate` DESC LIMIT $limitStart,$limitEnd";
        

        $ask2 = $mysql->query($q2);
        $ask = $mysql->query($q);
        echo $mysql->error;

        return array($ask, $ask2);
    }

    /// order by accending
        ///// to fetch data from a 'table and condition(columen) with the argument
        function allPostListerOnColumenORDER($table, $columen, $args){
            include "connect.php";
            $q = "SELECT * FROM `$table` WHERE `$columen` LIKE '$args' ORDER BY `$columen` DESC ";
    
            $ask = $mysql->query($q);
    
            return $ask;
        }


    ///// to fetch data for a table with out any condition
    function allPostListerOnTable($table){
        include "connect.php";
        $q = "SELECT * FROM `$table` WHERE 1 ";

        $ask = $mysql->query($q);

        return $ask;
    }

    function allPostListerOnTableRan($table){
        include "connect.php";
        $q = "SELECT * FROM `$table` ORDER BY RAND() LIMIT 7";

        $ask = $mysql->query($q);

        return $ask;
    }

    ////to fetch data from a tabel and 2 coloumen condition
    function allPostListerOn2Columen($table, $columen, $args, $columen2, $args2){

        include "connect.php";
        $q = "SELECT * FROM `$table` WHERE `$columen` = '$args' AND `$columen2` = '$args2' ORDER BY RAND() LIMIT 12 ";

        $ask = $mysql->query($q);

        return $ask;

    }

    //// to fetch data from a tabel and 3 colomen condition
    function allPostListerOn3Columen($table, $columen, $args, $columen2, $args2, $columen3, $args3){
        include "connect.php";
        $q = "SELECT * FROM `$table` WHERE `$columen` = '$args' AND `$columen2` = '$args2' AND `$columen3` = '$args3' ORDER BY RAND() LIMIT 12 ";

        $ask = $mysql->query($q);

        return $ask;
    }


    //// time ago string outputer
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    ///// view adder of a post
    function viewAdder($table, $pid){
        include "connect.php";
        $q = "SELECT `view` FROM `$table` WHERE `id` = '$pid'";
        $ask = $mysql->query($q);
        $count = $ask->fetch_assoc();
        $count = $count['view'] + 1;
        $q2 = "UPDATE `$table` SET `view` = '$count' WHERE `$table`.`id` = '$pid'";

        $ask2 = $mysql->query($q2);

        return $ask2;
    }


    //all posts single post viewing api dynamicaly
    function aSinglePostView($pid, $tableName){
        include "connect.php";
        $q = "SELECT * FROM `$tableName` WHERE `id` = '$pid'";

        $ask = $mysql->query($q);

        return $ask;
    }


    //select category from tabels
    function categorySelecter($table, $columen){
        include "connect.php";
        $q = "SELECT DISTINCT `$columen` FROM `$table` WHERE 1";

        $ask = $mysql->query($q);

        return $ask;        
    }


    /// favourites adder
    function favouritesAdder($postId, $uid, $table){
        include "connect.php";
        $fav = $uid.',';
        $q2 ="SELECT `fav`
        FROM `$table`
        WHERE `id` = '$postId'  ";
        $ask2 = $mysql->query($q2);
        $row = $ask2->fetch_assoc();
        $pre = $row['fav'];
        $new = $pre.','.$uid;

        $q = "UPDATE `$table` SET `fav` = '$new'  WHERE `$table`.`id` = '$postId'";
        $ask = $mysql->query($q);

        return $ask; 
        
    }


    //// favouites selecter for a user
    function favouritesSelector($table, $uid, $pid){
        include "connect.php";
        $sl = ','.$uid;
        $q = "SELECT `fav` FROM `$table` WHERE `fav` LIKE  '%$sl%' AND `id` = '$pid' ";

        $ask = $mysql->query($q);

        // if($ask){
        //     return true;
        // }else{
        //     return false;
        // }
        return $ask;
    }

    /// select faverite post list for a user
    function selectFavLister($table, $uid){
        include "connect.php";
        $sl = ','.$uid;
        $q = "SELECT * FROM `$table` WHERE `fav` LIKE  '%$sl%' ";

        $ask = $mysql->query($q);

        return $ask; 
    }



    ////// user ban
    function userBan($id){
        include "connect.php";
        $q = "UPDATE `user` SET `userStatus` = 'BAN' WHERE `user`.`id` = '$id'";
        $ask = $mysql->query($q);

        return $ask; 
    }


    ///// unban user
    function unBanuser($id){
        include "connect.php";
        $q = "UPDATE `user` SET `userStatus` = ' ' WHERE `user`.`id` = '$id'";
        $ask = $mysql->query($q);

        return $ask; 
    }



    function implodeAssoc($glue,$arr)
        {
        $keys=array_keys($arr);
        $values=array_values($arr);

        return implode($glue,$keys).$glue.implode($glue,$values) ;
        };

/**
 * @name explodeAssoc($glue,$arr)
 * @description makes an assiciative array from a string
 * @parameter glue: the string to glue the parts of the array with
 * @parameter arr: array to explode
 */
                function explodeAssoc($glue,$str)
                {
                $arr=explode($glue,$str);

                $size=count($arr);

                for ($i=0; $i < $size/2; $i++)
                    $out[$arr[$i]]=$arr[$i+($size/2)];

                return($out);
                };



    ////// search from
    // function 
 

?>