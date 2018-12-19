<?php if (isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Медикаменты</title>
    <link rel="stylesheet" href="../style/style.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap.css" />
  </head>
  
  <script src="../js/preloader.js"></script>
  <script src="../js/jquery.cookie.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/scroll_up.js"></script>
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="../js/jquery.cookie.js"></script>
  <script src="js/req.js"></script>

  <body>

    <div class="header-menu">

      <nav class="dws_menu">
        <ul class="dws_ul">
          <li class="li_1">
            <a href="home.php" title="Перейти на главную">
              <i class="fas fa-home fa-5x"></i>Главная
            </a>
          </li>
          
          <!-- <li class="li_2">
            <a href=""><i class="fa fa-wrench"></i>Оборудование</a>
          </li>
          <li class="li_3">
            <a href=""><i class="fa fa-address-book"></i>О проекте</a>
          </li> -->
        </ul>

      <?php if (isset($_COOKIE['Id'])) : ?>
      <ul class="dws_ul_my-cabinet">
          <li class="language">
            <select id="lang" onChange="locationr(this.value);">
              <option value="Ru" selected="selected">Ru</option>
              <option value="En">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div class="list_menu">
          <li class="li_4d"><a class="li_4d_a">Мой кабинет</a>
            <ul>
            <div class="list_menu_2">
              <div>
                <li>
                  <a href="user_cabinet.php"><i class="fas fa-user"></i>Личные данные</a>
                </li>
              </div>
              <div>
                <li>
                  <a href="fridge.php"><i class="fas fa-warehouse"></i>Камеры хранения</a>
                </li>
              </div>
              <div>
                <li>
                  <a href=""><i class="fas fa-chart-bar"></i>Графики состояния</a>
                </li>
              </div>
              <div>
                <li>
                  <a onClick="logout()" href="login.php"><i class="fas fa-sign-out-alt"></i>Выйти</a>
                </li>
              </div>
            </div>
            </ul>
          </li>
        </div>
      </ul>
      <?php else : ?>
      
      <ul class="dws_ul_reg">
        <div>
          <li class="li_5">
            <a href="login.php"><i class="fas fa-door-open"></i>Войти</a>
          </li>
          </ul>
        </div>
      </ul>
      <?php endif;?>
      </nav>
    </div>

    <div class="medicaments-page" id="medicaments_page">
        <div class="header_fridge_med">
          <div class="nameFridge_Med"><p id="d"></p></div>
          <div class="addBut_Fridge_Med"><h6><a id="addMedicament" onClick="openAddMedicament()">Добавить препарат</a></h6></div>
        </div>

        <div class="medicaments_wrap" id="medicaments_wrap">
          

          <div id="messageError"><h3>Препараты в данной камере отсутствуют!</h3></div>
        </div>
      <a class="scrollup" href="" title="ВВЕРХ"><i class="fas fa-arrow-circle-up fa-5x"></i></a>
    </div>
  </body>

  <footer class="footer">
    <span class="span_name"><i> &copy; Все права защищены. </i></span>
    <span class="soc_footer"> 
      <i>Соц. сети:</i>
      <a href="https://www.instagram.com/andrew.yehozha/?hl=ru" target="_blank" title="Инстаграм"><i class="fab fa-instagram fa-lg"></i></a>
      <a href="https://vk.com/www" target="_blank" title="Вконтакте"><i class="fab fa-vk fa-lg"></i></a>
      <a href="https://t.me/Yehozha" target="_blank"><i class="fab fa-telegram fa-lg" title="Телеграм"></i></a>
    </span>
  </footer>

  <script>
    var idFridge = window.location.href.split("?")[1].split("=")[1];

    $(document).ready(function() {
      document.getElementById('d').innerHTML = "<b><u>Камера № "+ idFridge +"</u></b>";
      loadMedicaments(idFridge);
    });
    
    function openAddMedicament(){
      document.location.href = "editMedicament.php?idFridge=" + idFridge;
    }

    function locationr(lang){
      var loc = window.location.href.split("/")[4];
      window.location = "../" + lang + "/"+loc;
    }

  </script>

  <script>$(".scrollup").fadeOut();</script>

</html>
<?php else : 
  header('Location: login.php');
?>
<?php endif; ?>