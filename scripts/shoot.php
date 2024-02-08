<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once "blank.php";
    $db = db();
    $cookie = $_COOKIE["SECRET"];
    $name = $_POST["name"];
    $coords = $_POST["coords"];
    $shipIs = false;
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
                $ships = json_decode($field["ships"],true);
                $coordinates = array_keys($ships);
                if(in_array($coords,$coordinates)){
                    $ship = $ships[$coords];
                    $sql = "SELECT * FROM `prizes` WHERE `id` = '$ship'";
                    $res = $db->query($sql);
                    $prize = mysqli_fetch_assoc($res);
                    $prize = $prize;
                    $shipIs = true;
                }
                $ship = array($coords,0);
                $shipId = 0;
                foreach ($coordinates as $cor){
                    if($cor == $coords){
                        $sql = "SELECT * FROM `prizes` WHERE `id` = '".$ships[$cor]."'";
                        $res = $db->query($sql);
                        $row = mysqli_fetch_assoc($res);
                        $row = $row;
                        $shipId = $row["id"];
                        $ship[1] = array(
                            "img"=>$row["img"],
                            "name"=>$row["name"],
                            "desc"=>$row["description"],
                            "cost"=>$row["cost"]
                        );
                    }
                }

                $sql = "SELECT * FROM `bullets` WHERE `owner` = ".$user["id"]." AND `uname` = '$name'";
                $res = $db->query($sql);
                if((mysqli_num_rows($res) < $field["bullet"])){
                    $sql = "INSERT INTO `bullets`(`uname`, `owner`, `coords`, `ship`) VALUES ('$name','".$user['id']."','$coords','$shipId')";
                    // $db->query($sql);
                    echo json_encode($ship,JSON_UNESCAPED_UNICODE);
                }
            }
        }
    }

?>