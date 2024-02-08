<?php

    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);
    include_once 'blank.php';
    $db = db();
    $type = empty($_POST['type']) ? 0 : $_POST['type']; # reg / auth type
    $isRes = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    switch ($type) {
        case 1:
            $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
            $res = $db->query($sql);
            $row = mysqli_fetch_assoc($res);
            $row = $row;
            $password_hash = $row["password"];
            if(password_verify($password,$password_hash)){
                $secret = $row["secret"];
                $isRes = true;
                setcookie("SECRET",$secret,time()+60*60*24*365,"/");
            }
            break;
        case 2:
            setcookie("SECRET","NONE",time()-3600,"/");
            echo 'sex';
            break;
        default:
            $password = password_hash($password,PASSWORD_DEFAULT);
            $secret = generateRandomString();
            $sql = "INSERT INTO `user`(`email`, `username`, `password`, `admin`, `secret`) VALUES ('$email','$username','$password','0','$secret')";
            try {
                $f = mysqli_query($db,$sql);
                $isRes = true;
                setcookie("SECRET",$secret,time()+60*60*24*365,"/");
            }catch(Exception $e) {        
                
            }
            break;
    }
    echo $isRes;



?>
