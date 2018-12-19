<?php if (!isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Авторизация</title>
    <link rel="stylesheet" href="../style/style_reg_log.css">
    <link rel="stylesheet" href="../style/style.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap.css" />
  </head>

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
      
      <ul class="dws_ul_reg">
          <li class="language">
            <select id="lang" onChange="window.location = '../'+this.value + '/login.php'";>
              <option value="Ru" selected="selected">Ru</option>
              <option value="En">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div>
          <li class="li_5">
            <a href="signup.php"></i>Регистрация</a>
          </li>
        </div>
      </ul>
      </nav>
    </div>

    <div class="wrap-page">
      <div class="login-page" id="result">
        <div class="form">
          <span>Вход</span>
          <input required  type="email" id="login" name="login" placeholder="Логин"><br/>
          <input required type="password" id="password" name="password" placeholder="Пароль"><br/>
          <button type="submit" onClick="checkUser(login.value, password.value)" id ="do_login" name="do_login">Войти</button>
          <p class="message">Не зарегестрированы? <a href="signup.php">Создать аккаунт</a></p>
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
		<a href="https://t.me/Yehozha" target="_blank"><i class="fab fa-telegram fa-lg" title="Телеграмм"></i></a>
	</span>
  </footer>

  <script src="js/req.js"></script>
  <script src="../js/preloader.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="../js/jquery.cookie.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>

</html>
<?php else : 
header('Location: home.php');
?>
<?php endif; ?>