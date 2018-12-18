
$(document).ready(function() {
  // появление/затухание кнопки #back-top
  $(window).scroll(function() {
    if ($(this).scrollTop() > 200) {
      $(".scrollup").fadeIn();
    } else {
      $(".scrollup").fadeOut();
    }
  });
  // при клике на ссылку плавно поднимаемся вверх
  $(".scrollup").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
});
