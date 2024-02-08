<!DOCTYPE html>
<?php 

include_once 'scripts/blank.php';
$db = db();
?>
<html lang="">
  <head>
    <?php head("Auth") ?>
  </head>
  <body>
    <canvas id="sea-block" width="600" height="400">
      Извините, ваш браузер нет поддерживает&lt;canvas&gt; элемент.
    </canvas>
    <?php 

    ?>
    <div class="title abs">
      <h1 class="main">Sea Battle</h1>
      <h2 class="main">попади в корабль и получи приз!</h2>
    </div>
    <div class="auth" id="main">
      <div id="choice">
        <button class="auth" onclick="transwormt(2)">Вход</button>
        <button class="registation" onclick="transwormt(1)">Зарегистрироваться</button>
      </div>
      <div id="regD">
        <form id="reg" class="boauth">
          <input type="text" name="username" id="" placeholder="Никнейм" class="shipsLarge">
          <input type="email" name="email" id="" placeholder="Почта" class="shipsLarge">
          <input type="password" name="password" placeholder="Пароль" id="" class="shipsLarge">
          <input type="hidden" name="type" value="0">
          <input type="submit" value="Регистрация">
        </form>
        <button class="back" onclick="transwormt()"><span class="material-symbols-outlined">chevron_left</span>Назад</button>
        <p class="shipsError" id="error"></p>
      </div>
      <div id="authD">
        <form id="auth" class="boauth">
          <input type="email" name="email" id="" placeholder="Почта" class="shipsLarge">
          <input type="password" name="password" placeholder="Пароль" id="" class="shipsLarge">
          <input type="submit" value="Вход">
          <input type="hidden" name="type" value="1">
        </form>
        <button class="back" onclick="transwormt()"><span class="material-symbols-outlined">chevron_left</span>Назад</button>
        <p class="shipsError" id="error"></p>
      </div>
    </div>
  </body>
  <script>
    let choice = document.getElementById("choice")
    let reg = document.getElementById("regD")
    let auth = document.getElementById("authD")
    let main = document.getElementById("main")
    let urls = window.location.href
    $("#auth").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: 'scripts/registrationorauth.php',
        method: "post",
        dataType: "html",
        data: $(this).serialize(),
        success: function(data) {
          var textDD = "Неправильная почта или пароль"
          console.log(data)
          let e = false
          if(data){
            textDD = "Успешная Авторизация"
            e = true
          }
          console.log(textDD)
          $(".shipsError").text(textDD)
          if(e){
            location.href = 'index.php';
          }
        }
      })
    });
    $("#reg").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: 'scripts/registrationorauth.php',
        method: "post",
        dataType: "html",
        data: $(this).serialize(),
        success: function(data) {
          var textDD = "Ошибка уже есть аккаунт с такой почтой"
          let e = false
          if(data){
            textDD = "Успешная Регистрация"
            e = true
          }
          $(".shipsError").text(textDD)
          if(e){
            location.href = 'index.php';
          }
        }
      })
    });



    function transwormt(i = 0){
      console.log(i)
      main.style.transform = "translate(-"+i+"00vw)"
    }
  </script>
  <!-- sea script -->
  <script src="sea.js"></script>
</html>
