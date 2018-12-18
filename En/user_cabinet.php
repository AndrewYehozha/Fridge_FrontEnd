<?php if (isset ($_COOKIE['Login'])) : ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Account</title>
    <link rel="stylesheet" href="../style/style.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/bootstrap.css" />
    <link rel="stylesheet" href="style/style.css"/>
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
            <a href="home.php" title="Go to Home">
              <i class="fa fa-home fa-lg"></i>Home
            </a>
          </li>
        </ul>

      <?php if (isset($_COOKIE['Login'])) : ?>
      <ul class="dws_ul_my-cabinet">
          <li class="language">
            <select id="lang" onChange="window.location = '../'+this.value + '/user_cabinet.php'";>
              <option value="Ru">Ru</option>
              <option value="En" selected="selected">En</option>
              <option value="Ua">Ua</option>
            </select>
          </li>
        <div class="list_menu">
          <li class="li_4d"><a class="li_4d_a">My cabinet</a>
            <ul>
            <div class="list_menu_2">
              <div>
                <li>
                  <a href=""><i class="fas fa-user"></i>Edit your account</a>
                </li>
              </div>
              <div>
                <li>
                  <a href="fridge.php"><i class="fas fa-warehouse"></i>Storage chambers</a>
                </li>
              </div>
              <div>
                <li>
                  <a href="php/authorization/logout.php"><i class="fas fa-chart-bar"></i>State charts</a>
                </li>
              </div>
              <div>
                <li>
                  <a onClick="logout()" href="login.php"><i class="fas fa-sign-out-alt"></i>Log out</a>
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
            <a href="login.php"><i class="fas fa-door-open"></i>Log in</a>
          </li>
          </ul>
        </div>
      </ul>
      <?php endif;?>
      </nav>
    </div>

    <div class="user_page">
        <p><b><u>Your account:</u></b></p>
        
        <div class="user_wraps" id="user_wraps">
        <div class="user_wrap" id="user_wrap">
          <div>Country:<input id="country" type="text" value=""></div>
          <div>City:<input id="city" type="text" value=""></div>
          <div>Address:<input id="address" type="text" value=""></div>
          <div>Phone:<input id="phone" type="text" value=""></div>
          <div>Organization name:<input id="nameOrganiz" type="text" value=""></div>
          <div>Email:<input id="login" type="email" value=""></div></div>
                                                  
          <div class="save_user"><li id="save_user" onClick="saveUserC()">Save</li></div>
          <div class="s" id="changePass"><a onClick="showPass()">Change password</a></div>
          <div class="s" id="Cancel"><a onClick="document.location.reload()">Cancel</a></div>
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

  <script>
    $(document).ready(function() {
      loadUser($.cookie("Id"));
    });

    function saveUserC(event){
      var pass;
      var check = false;
      if(document.getElementById('login').validity.valid)
        if(document.getElementById("password")){
          if(password.value.trim() != ""){
            if(password.value.trim() == $.cookie("Password")){
              if((newPass.value.trim() != "") || (repeatNewPass.value.trim() != "")){
                if(newPass.value.trim() == repeatNewPass.value.trim()){
                  pass = newPass.value.trim();
                  check = true;
                }
                else{
                  alert("New passwords do not match!");
                }
              }
              else{
                alert("Please enter new password!");
              }
            }
            else{
              alert("Old password entered is not true!");
            }
          }
          else{
            alert("Please enter your old password!");
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
    document.getElementById('user_wrap').innerHTML += '<div id="b">Old password:<input id="password" type="password"></div>'+
                                                      '<div id="b">New password:<input id="newPass" type="password"></div>' +
                                                      '<div id="b">Confirm the password:<input id="repeatNewPass" type="password"></div>';
    document.getElementById('changePass').style = 'display:none';
    document.getElementById('Cancel').style = 'display:inline-block; padding:25px 0 0 70px;';
    loadUser($.cookie("Id"));
    }
  </script>

  <script>$(".scrollup").fadeOut();</script>

</html>
<?php else : 
header('Location: login.php');
?>
<?php endif; ?>