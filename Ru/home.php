<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Личные данные</title>
    <link rel="stylesheet" href="../style/style.css"/>
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
          <li class="language_n">
            <select id="lang">
              <option value="Ru" selected="selected">Ru</option>
              <option value="En">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div class="log_">
          <li class="li_5">
            <a href="login.php"><i class="fas fa-door-open"></i>Войти</a>
          </li>
        </div>
        <div class="reg_">
          <li class="li_6">
            <a href="signup.php"></i>Регистрация</a>
          </li>
        </div>
      </ul>
      <?php endif;?>
      </nav>
    </div>

    <div class="wrap-page">
      <div class="wrapper">
        <div>Loren70wd efeow fowehfoi whfoihw efoih eoiwf</div>
        <div class="light">wdhhd ihwdio whdo hwdh whdh wodhw hfeyg yg</div>
        <div></div>
        <div></div>
      </div>
      <div class="wrapper">
        <div>Loren70wd efeow fowehfoi whfoihw efoih eoiwf</div>
        <div class="light">wdhhd ihwdio whdo hwdh whdh wodhw hfeyg yg</div>
        <div><a href="test.php">Регестрация</a></div>
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
      loadUser($.cookie("Id"));
    });

    function saveUserC(event){
      var pass;
      var check = false;
      if(document.getElementById("password")){
        if(password.value.trim() != ""){
          if(password.value.trim() == $.cookie("Password")){
            if((newPass.value.trim() != "") || (repeatNewPass.value.trim() != "")){
              if(newPass.value.trim() == repeatNewPass.value.trim()){
                pass = newPass.value.trim();
                check = true;
              }
              else{
                alert("Новые пароли не совпадают");
              }
            }
            else{
              alert("Пожалуйста, введите новый пароль!");
            }
          }
          else{
            alert("Старый пароль введен не верено!");
          }
        }
        else{
          alert("Пожалуйста, введите старый пароль!");
        }
      }
      else{
        pass = $.cookie("Password");
        check = true;
      }
      if(check){
        saveUser($.cookie("Id"), login.value.trim(), pass, nameOrganiz.value.trim(), $.cookie("Role"), country.value.trim(), city.value.trim(), address.value.trim(), phone.value.trim());
      }
    }

    function showPass(){
    document.getElementById('user_wrap').innerHTML += '<div id="b">Старый пароль:<input id="password" type="text"></div>'+
                                                      '<div id="b">Новый пароль:<input id="newPass" type="text"></div>' +
                                                      '<div id="b">Подтвердите пароль:<input id="repeatNewPass" type="text"></div>';
    document.getElementById('changePass').style = 'display:none';
    document.getElementById('Cancel').style = 'display:inline-block; padding:25px 0 0 70px;';
    loadUser($.cookie("Id"));
    }

    function displayPass(){
      document.getElementById("b").remove();
      document.getElementById("b").remove();
      document.getElementById("b").remove();
      document.getElementById('changePass').style = 'display:inherit';
      document.getElementById('Cancel').style = 'display:none';
    }

  </script>

  <script>$(".scrollup").fadeOut();</script>

</html>