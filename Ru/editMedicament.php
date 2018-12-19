<?php if (isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Медикамент</title>
    <link href="../style/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap.css" />
  </head>
  
  <script src="../js/preloader.js"></script>
  <script type="text/javascript" src="../js/jquery.cookie.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>
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
        <p><u>Введите информацию о медикаменте:</u></p>
    <div class="edit_medicaments" id="medicaments_wrap">
      <div class="mw_page">
        <div class="user_wrap" id="user_wrap">
            <div>Название медикамента:<input id="nameMedicament" type="text" value=""></div>
            <div>Количество:<input id="amount" type="number" min="1" value=""></div>
            <div>Цена:<input id="price" type="number" step="0.01" min="1" value=""></div>
            <div>Дата изготовления:<input type="date" min="2015-01-01" max="2050-12-31" id="dataProduction" value=""></div>
            <div>Годен до:<input type="date" min="2015-01-01" max="2050-12-31" id="expirationDate" value=""></div>
            <div>Хранить от ( t C&deg):<input id="minTemperature" type="number" step="0.01" min="-99" max="99" value=""></div>
            <div>Хранить до ( t C&deg):<input id="maxTemperature" type="number" step="0.01" min="-99" max="99" value=""></div>
            <div>Состояние:  <select id="status"><option value="true">Пригоден</option><option value="false">Не пригоден</option></select> </div>
        </div> 
                    
            <div class="save_medicament" id="save_med"><li id="save_medicament" onClick="saveMedicaments()">Сохранить</li></div>
            <div class="add_medicament" id="add_med"><li id="add_medicament" onClick="addMedicaments()">Добавить</li></div>
      </div>
      </div>
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
    try {
      var params = window.location.href.split("?")[1].split("&");
      var idFridge = params[0].split("=")[1];
      var idMedicament = params[1].split("=")[1];
    } catch (err) {
      console.log(err);
    }

    $(document).ready(function() {
      if(idMedicament){
        document.getElementById('add_med').style = "display: none";
        loadOneMedicaments(idMedicament);
      }
      else{
        document.getElementById('save_med').style = "display: none";
      }
    });

    function locationr(lang){
      var loc = window.location.href.split("/")[4];
      window.location = "../" + lang + "/"+loc;
    }

  </script>
</html>
<?php else : 
  header('Location: login.php');
?>
<?php endif; ?>