<?php
    function db(){
        $db = mysqli_connect("mine.guevin1.com","predprof","5sfQGA(()(p2.7T.","predprof");
        return $db;
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function head($title){
        echo '<meta charset="utf-8">
        <title>'.$title.' | Sea Battle</title>

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="css/nothing.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />';
    }

?>