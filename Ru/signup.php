<?php if (!isset ($_SESSION['logged_user']) ) : ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Регистрация</title>
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
            <select id="lang">
              <option value="Ru" selected="selected">Ru</option>
              <option value="En">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div>
          <li class="li_5">
            <a href="login.php"><i class="fas fa-door-open"></i>Войти</a>
          </li>
          </ul>
        </div>
      </ul>
      </nav>
    </div>

  <div class="wrap-page">

    <div class="login-page">
      <div class="form">
        <span>Регистрация</span>
        <form class="register-form" action="alert('') method="POST">
          <input required type="text" placeholder="Логин" name="login" value="<?php echo @$data['login']; ?>"><br/>

          <input required type="email" placeholder="Электронная почта" name="email" value="<?php echo @$data['email']; ?>"><br/>

          <input required type="password" placeholder="Пароль" name="password" value="<?php echo @$data['password']; ?>"><br/>

          <input required type="password" placeholder="Повторите пароль" name="password_2" value="<?php echo @$data['password_2']; ?>"><br/>

          <button type="submit" name="do_signup">Зарегистрироваться</button>
          <p class="message">Уже зарегистрированы? <a href="login.php">Войти</a></p>
        </form>
      </div>
    </div>
  </div>
    <!-- <div id="page_preloader" class="preloader">
      <div class="text-loader"><span id="load_perc">0%</span></div>
      <div class="loader"></div>
    </div> -->
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

  <script src="../js/preloader.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>

</html>
<?php else : 
header('Location: home.php'); exit;
?>
<?php endif; ?>