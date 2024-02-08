<?php
    include_once "blank.php";
    $db = db();
    $cookie = $_COOKIE["SECRET"];
    $name = $_GET["name"];
    $coords = array();
    if(!empty($cookie)){
        $sql = "SELECT * FROM `user` WHERE `secret` = '$cookie'";
        $res = $db->query($sql);
        $user = mysqli_fetch_assoc($res);
        $user = $user;
        if(!is_null($user)){
            $sql = "SELECT * FROM `field` WHERE `uname` = '$name'";
            $res = $db->query($sql);
            $row = mysqli_fetch_assoc($res);
            $field = $row;
            if(!is_null($field)){
                $sql = "SELECT * FROM `bullets` WHERE `owner` = ".$user["id"]." AND `uname` = '$name'";
                $res = $db->query($sql);
                foreach ($res as $bullet){
                    // var_dump($bullet);
                    $prize = 0;
                    if ($bullet["ship"] != 0) {
                        $ship = $bullet["ship"];
                        $sql = "SELECT * FROM `prizes` WHERE `id` = ".$bullet["ship"];
                        $res = $db->query($sql);
                        $row = mysqli_fetch_assoc($res);
                        $row = $row;
                        $prize = array($row["img"],$row["name"],$row["description"],$row["cost"]);
                        # code...
                    }
                    $coords[] = array($bullet["coords"],$prize);
                }
            }
        }
    }
    echo(json_encode($coords,JSON_UNESCAPED_UNICODE));

?>