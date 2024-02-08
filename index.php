<?php

include_once 'scripts/blank.php';
$db = db();
$cookie = $_COOKIE["SECRET"];
$sql = "SELECT * FROM `user` WHERE `secret` = '$cookie'";
$res = $db->query($sql);
$user = mysqli_fetch_assoc($res);
$user = $user;
if(empty($cookie) || is_null($user)) {
  $new_url = 'auth.php';
  header('Location: '.$new_url);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    head("Поля")
  ?>
</head>
<body>
  <canvas id="sea-block" width="600" height="400">
    Извините, ваш браузер нет поддерживает&lt;canvas&gt; элемент.
  </canvas>
  <div class="box">
    <div class="main">
      <header>
        <div class="name">
          <span class="material-symbols-outlined">sailing</span>
          Sea Battle
        </div>
        <nav>
          <a href="">Поля</a>
          <a href="">Призы</a>
        </nav>
        <div class="avatar">
          <p><?php echo $user['username']; ?></p>
          <a id="exit"><span class="material-symbols-outlined">logout</span></a>
        </div>
     </header>
    </div>  

  </div>

  <script>
    $("#exit").click(function(e) {
      console.log("sexz")
      $.ajax({
        url: 'scripts/registrationorauth.php',
        method: "post",
        dataType: "html",
        data: {"type":2},
        success: function (data) {
          console.log(data)
          location.reload();
        }
      })
    })

  </script>
  <!-- sea script -->
  <script src="sea.js"></script>
</body>
</html>