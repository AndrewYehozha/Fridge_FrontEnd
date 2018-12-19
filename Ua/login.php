<?php if (!isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="ua">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Авторизація</title>
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
            <a href="home.php" title="Перейти на головну">
              <i class="fa fa-home fa-lg"></i>Головна
            </a>
          </li>
        </ul>
      
      <ul class="dws_ul_reg">
          <li class="language">
            <select id="lang" onChange="window.location = '../'+this.value + '/login.php'";>
              <option value="Ru">Ru</option>
              <option value="En">En</option>
              <option value="Ua" selected="selected">Ua</option>
            </select>
          </li>
        <div>
          <li class="li_5">
            <a href="signup.php"></i>Реєстрація</a>
          </li>
        </div>
      </ul>
      </nav>
    </div>

    <div class="wrap-page">
      <div class="login-page" id="result">
        <div class="form">
          <span>Вхід</span>
          <input required  type="email" id="login" name="login" placeholder="Логин"><br/>
          <input required type="password" id="password" name="password" placeholder="Пароль"><br/>
          <button type="submit" onClick="checkUser(login.value, password.value)" id ="do_login" name="do_login">Увійти</button>
          <p class="message">Не зареєстровані? <a href="signup.php">Створити аккаунт</a></p>
        </div>
      </div>
    </div>
    
  </body>

  <footer class="footer">
	<span class="span_name"><i> &copy; Всі права захищені. </i></span>
	<span class="soc_footer"> 
		<i>Соц. мережі:</i>
		<a href="https://www.instagram.com/andrew.yehozha/?hl=ru" target="_blank" title="Інстаграм"><i class="fab fa-instagram fa-lg"></i></a>
		<a href="https://vk.com/www" target="_blank" title="ВКонтакті"><i class="fab fa-vk fa-lg"></i></a>
		<a href="https://t.me/Yehozha" target="_blank"><i class="fab fa-telegram fa-lg" title="Телеграм"></i></a>
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