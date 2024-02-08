<!DOCTYPE html>
<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
  include_once 'scripts/blank.php';
  $db = db();
  if(empty($_COOKIE["SECRET"])) {

    $new_url = 'auth.php';
    header('Location: '.$new_url);
  }
  if(empty($_GET["name"])) {
    header("Location: index.php");
  }
  $name = $_GET["name"];
  $sql = "SELECT * FROM `field` WHERE `uname` = '$name'";
  $res = $db->query($sql);
  $row = mysqli_fetch_assoc($res);
  $row = $row;
  if(is_null($row)){

    header("Location: index.php");
  }
?>

<html lang="">
  <head>
    <?php head($name) ?>
      
  </head>
  <body>
    <?php
      echo "<input type=\"hidden\" id='num_columns' value=\"".$row['numbers']."\">";
      echo "<input type=\"hidden\" id='uname' value=\"".$row['uname']."\">";
    
    ?>
    <canvas id="sea-block" width="600" height="400">
      Извините, ваш браузер нет поддерживает&lt;canvas&gt; элемент.
    </canvas>
    <div class="title">
      <h1 class="main">Sea Battle</h1>
      <h2 class="main">попади в корабль и получи приз!</h2>
    </div>
    <form id="fsea" class="sea">
      <?php 
          echo "<input type=\"hidden\" name='name' value=\"".$row['uname']."\">";
      ?>
      <table id="sea"></table>
      <input type="submit" value="Стрелять">
    </form>
  </body>

  <script>
    let v = document.getElementById("num_columns")
    var prev = null
    
    function changes(event) {
      radio = event.target;
      console.log(radio)
      t = document.getElementById("cell"+radio.value)
      console.log(t)
      t.classList.add("active")
      if (prev != null && prev.classList.contains("active")){
        prev.classList.remove("active")
      }
      prev = t
    }
    function generate(id,nums){
      var prev = null;
      let table = document.getElementById(id)
      for(let i = 0; i < nums;i++){
        let row = document.createElement("tr")
        for(let j = 0; j < nums;j++){
          let cell = document.createElement("td")
          
          cell.innerHTML = "<input type=\"radio\" class=\"sea\" id=\"radio" + (i*nums+j) + "\" value=\"" + (i*nums+j) + "\" name=\"coords\"><label class=\"sea\" for=\"radio" + (i*nums+j) + 
          "\"></label>"
          cell.addEventListener('change',changes)
          cell.id = "cell" + (i*nums+j);
          row.appendChild(cell)
        }
        table.appendChild(row)
      }
    }


    generate("sea",v.value)
  </script>
<script>
    $("#fsea").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: 'scripts/re.php',
        method: "post",
        dataType: "html",
        data: $(this).serialize(),
        success: function(data) {
          console.log(data)
          var ship = JSON.parse(data);
          console.log(ship)
          
          document.getElementById("radio"+ship[0]).checked = 0;
          var cell = document.getElementById("cell"+ship[0])
          
          console.log(cell)
          if(ship[1] != 0){
            
          }else{
            cell.classList.add("bullet")
          }
          if (cell != null && cell.classList.contains("active")){
            cell.classList.remove("active")
          }
        }
      })
    });
</script>
<script>
    var uname = document.getElementById("uname").value;
    $.ajax({
      url: 'scripts/check.php',
      method: "get",
      dataType: "html",
      data: {name: uname},
      success: function(data) {
        console.log(data)
        var text = JSON.parse(data);
        text.forEach(ship => {
          var cell = document.getElementById("cell"+ship[0])
          console.log(cell)
          if(ship[1] != 0){
            
          }else {
            cell.style.background = "url('images/bullet.svg')";
            cell.style.backgroundSize = "cover";
            cell.style.pointerEvents = "none"
          }
        
        });
      }
    })
  </script>
  <!-- sea script -->
  <script src="sea.js"></script>
</html>
