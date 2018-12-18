<?php if (isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Камеры хранения</title>
    <link href="../style/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap.css" />
  </head>
  
  <script src="../js/preloader.js"></script>
  <script type="text/javascript" src="../js/jquery.cookie.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="Media/js/bootstrap.js"></script>
  <script src="../js/scroll_up.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="../js/jquery.cookie.js"></script>
  <script src="js/req.js"></script>

  <body>

    <div class="header-menu">

      <nav class="dws_menu">
        <ul class="dws_ul">
          <li class="li_1">
            <a href="home.php" title="Перейти на главную">
              <i class="fa fa-home fa-lg"></i>Главная
            </a>
          </li>
        </ul>

      <?php if (isset($_COOKIE['Id'])) : ?>
      <ul class="dws_ul_my-cabinet">
          <li class="language">
            <select id="lang">
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
                  <a href="php/authorization/logout.php"><i class="fas fa-chart-bar"></i>Графики состояния</a>
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

    <div class="fridge-page">
        <div class="header_fridge_med">
          <div class="nameFridge_Med"><p><b><u>Камеры хранения:</u></b></p></div>
          <div class="addBut_Fridge_Med"><h6><a id="addFridge" onClick="addFridge($.cookie('Id'))">Добавить камеру</a></h6></div>
        </div>

      <div class="fridge_wrap" id="fridge_wrap">
        <!-- <div class="fridge" id="fridge">
          <p id="box1"><u>№ Камеры:</u> 1000</p>
          <p id="box2">Влажность: 1000 %</p>
          <p id="box2">Температура: 1000 C&deg</p>
          <p id="box3"><a href=""><u>Посмотреть содержимое</u></a></p>
          <p id="box4"><a href=""><u>Удалить камеру</u></a></p>
        </div> -->
      <div id="messageError"><h3>Похоже, что у Вас еще нету камер для хранения!</h3></div>
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
      <a href="https://t.me/Yehozha" target="_blank"><i class="fab fa-telegram fa-lg" title="Телеграмм"></i></a>
    </span>
  </footer>

  <script>
    $(document).ready(function() {
      loadFridge($.cookie("Id"));
    });
  </script>

  <script>$(".scrollup").fadeOut();</script>

</html>
<?php else : 
  header('Location: login.php');
?>
<?php endif; ?>