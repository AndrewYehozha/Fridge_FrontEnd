<?php if (isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Medicament</title>
    <link href="../style/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap.css" />
  </head>
  
  <script src="../js/preloader.js"></script>
  <script type="text/javascript" src="../js/jquery.cookie.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>
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
              <i class="fa fa-home fa-lg"></i>Home
            </a>
          </li>
        </ul>

      <?php if (isset($_COOKIE['Id'])) : ?>
      <ul class="dws_ul_my-cabinet">
          <li class="language">
            <select id="lang" onChange="locationr(this.value);">
              <option value="Ru">Ru</option>
              <option value="En"selected="selected">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div class="list_menu">
          <li class="li_4d"><a class="li_4d_a">My cabinet</a>
            <ul>
            <div class="list_menu_2">
              <div>
                <li>
                  <a href="user_cabinet.php"><i class="fas fa-user"></i>Personal information</a>
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

    <div class="medicaments-page" id="medicaments_page">
        <p><u>Введите информацию о препарате:</u></p>
    <div class="edit_medicaments" id="medicaments_wrap">
      <div class="mw_page">
        <div class="user_wrap" id="user_wrap">
            <div>Название препарата:<input id="nameMedicament" type="text" value=""></div>
            <div>Количество:<input id="amount" type="number" min="1" value=""></div>
            <div>Цена:<input id="price" type="number" min="1" value=""></div>
            <div>Дата изготовления:<input type="date" min="2015-01-01" max="2050-12-31" id="dataProduction" value=""></div>
            <div>Годен до:<input type="date" min="2015-01-01" max="2050-12-31" id="expirationDate" value=""></div>
            <div>Хранить от ( t C&deg):<input id="minTemperature" type="number" value=""></div>
            <div>Хранить до ( t C&deg):<input id="maxTemperature" type="number" value=""></div>
            <div>Состояние:  <select id="status"><option value="true">Пригоден</option><option value="false">Не пригоден</option></select> </div>
        </div> 
                    
            <div class="save_medicament"><li id="save_medicament" onClick="saveMedicaments()">Сохранить</li></div>
            <div class="s" id="Cancel"><a onClick="displayPass()">Отмена</a></div>
      </div>
            <a class="scrollup" href="" title="ВВЕРХ"><i class="fas fa-arrow-circle-up fa-5x"></i></a>
      </div>
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
      loadOneMedicaments(window.location.href.split("?")[1].split("=")[1]);
    });

    var params = window.location.href.split("?")[1].split("&");
    var id = params[0].split("=")[1];
    var idFridge = params[1].split("=")[1];

    function saveMedicaments(){
      if((document.getElementById('nameMedicament').value.trim() != "") && document.getElementById('amount').validity.valid && 
          document.getElementById('price').validity.valid && document.getElementById('dataProduction').validity.valid &&
          document.getElementById('expirationDate').validity.valid && (dataProduction.value != "") &&
          (expirationDate.value) && document.getElementById('minTemperature').validity.valid &&
          document.getElementById('maxTemperature').validity.valid){
        saveMedicament(id, idFridge, nameMedicament.value, amount.value, dataProduction.value,
                      expirationDate.value, price.value, minTemperature.value, maxTemperature.value, document.getElementById("status").value);
      }
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