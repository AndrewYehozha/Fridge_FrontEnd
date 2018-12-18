<?php if (!isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Log in</title>
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
            <a href="home.php" title="Go to Home">
              <i class="fa fa-home fa-lg"></i>Home
            </a>
          </li>
        </ul>
      
      <ul class="dws_ul_reg">
          <li class="language">
            <select id="lang" onChange="window.location = '../'+this.value + '/login.php'";>
              <option value="Ru">Ru</option>
              <option value="En" selected="selected">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div>
          <li class="li_5">
            <a href="signup.php"></i>Register</a>
          </li>
        </div>
      </ul>
      </nav>
    </div>

    <div class="wrap-page">
      <div class="login-page" id="result">
        <div class="form">
          <span>Log in</span>
          <input required  type="email" id="login" name="login" placeholder="Email"><br/>
          <input required type="password" id="password" name="password" placeholder="Password"><br/>
          <button type="submit" onClick="checkUser(login.value, password.value)" id ="do_login" name="do_login">Log in</button>
          <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
        </div>
      </div>
    </div>
  </body>
  <footer class="footer">
	<span class="span_name"><i> &copy; All rights reserved. </i></span>
	<span class="soc_footer"> 
		<i>Social network:</i>
		<a href="https://www.instagram.com/andrew.yehozha/?hl=ru" target="_blank" title="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
		<a href="https://vk.com/www" target="_blank" title="VKontakte"><i class="fab fa-vk fa-lg"></i></a>
		<a href="https://t.me/Yehozha" target="_blank"><i class="fab fa-telegram fa-lg" title="Telegram"></i></a>
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