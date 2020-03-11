<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo $page_title ?></title>
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/static/css/style_medcard.css">
    <link rel="stylesheet" type="text/css" href="/static/css/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/flaticon.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/style_login.css">
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">
    <link href="/static/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/fontawesome-free-5.9.0-web/css/all.css"rel="stylesheet" />
    <link href='/static/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='/static/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='/static/fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
    <link href='/static/css/tempusdominus-bootstrap-4.min.css' rel='stylesheet' />
    <link href="/static/css/font-awesome.css" rel="stylesheet" />

    <script src='/static/fullcalendar/packages/core/main.js'></script>
    <script src='/static/fullcalendar/packages/core/locales/ru.js'></script>
    <script src='/static/fullcalendar/packages/daygrid/main.js'></script>
    <script src='/static/fullcalendar/packages/interaction/main.js'></script>
    <script src='/static/fullcalendar/packages/bootstrap/main.js'></script>
    <script src='/static/js/jquery-3.4.1.min.js'></script>
    <script src='/static/bootstrap-4.3.1-dist/js/bootstrap.min.js'></script>
    <script src='/static/js/moment.min.js'></script>
    <script src='/static/js/ru.js'></script>
    <script src='/static/js/tempusdominus-bootstrap-4.min.js'></script>

    <script>
      var events = [<?php echo $visits ?>];
      let servJSON = <?php echo json_encode($services) ?>
    </script>
</head>
<body>
    <!-- <div class = "header">
      <h1>Ronda</h1>
    </div> -->
  <header class="header-section">
    <div class="container">
			<!-- Site Logo -->
			<a href="index.html" class="site-logo">
				<img src="/static/images/logo.png" alt="">
			</a>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- Main Menu -->
			<ul class="main-menu">
				<li><a href="/">Главная</a></li>
				<li><a href="/about">О нас</a></li>
        <li><a href="/services">Услуги</a></li>
        <? if (isset($_SESSION['login'])): ?>
          <li><a href="/logout">Выйти</a></li>
        <? else: ?>
          <li><a href="/login">Вход</a></li>
        <? endif ?>
        <? if ($_SESSION['login'] === 'qwe'): ?>
          <li><a href="/registration">Зарегистрировать</a></li>
        <? endif ?>
			</ul>
		</div>
    <? include_once $content; ?>

    <!-- Footer top section -->
    <section class="footer-top-section set-bg" data-setbg="/static/images/footer-bg.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="footer-widget">
              <div class="fw-about">
                <img src="/static/images/logo-light.png" alt="">
                <p>Phasellus vehicula tempus orci vel consequat. Nullam lorem sem, viverra a rutrum sed, gravida mattis magna. Suspendisse vitae commodo quam. Quisque a enim et ante vulputate finibus nec laoreet ipsum.</p>
                <div class="fw-social">
                  <a href=""><i class="fa fa-pinterest"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-dribbble"></i></a>
                  <a href=""><i class="fa fa-behance"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-5">
            <div class="footer-widget">
              <div class="fw-links">
                <h5 class="fw-title">Наши услуги</h5>
                <ul>
                  <li><a href="">Зубные коронки и мосты</a></li>
                  <li><a href="">Зубные Имплантаты</a></li>
                  <li><a href="">Отбеливание зубов</a></li>
                  <li><a href="">Лечение зубов</a></li>
                  <li><a href="">Удаление зубов</a></li>
                  <li><a href="">Брекеты</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-7">
            <div class="footer-widget">
              <div class="fw-timetable">
                <div class="fw-title">Часы работы</div>
                <div class="timetable-content">
                  <table>
                    <tr>
                      <td>Понедельник</td>
                      <td>9:00am - 20:00</td>
                    </tr>
                    <tr>
                      <td>Вторник</td>
                      <td>9:00am - 20:00</td>
                    </tr>
                    <tr>
                      <td>Среда</td>
                      <td>9:00am - 20:00</td>
                    </tr>
                    <tr>
                      <td>Четверг</td>
                      <td>9:00am - 20:00</td>
                    </tr>
                    <tr>
                      <td>Пятница</td>
                      <td>9:00am - 20:00</td>
                    </tr>
                    <tr>
                      <td>Суббота</td>
                      <td>9:00am - 16:00</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer top section end -->


    <!-- Footer section -->
    <footer class="footer-section">
      <div class="container">
        <ul class="footer-menu">
          <li><a href="">Главная</a></li>
          <li><a href="">О нас</a></li>
          <li><a href="">Услуги</a></li>
          <li><a href="">Контакты</a></li>
          <li><a href="">Вход</a></li>
        </ul>
    </footer>
    <!-- Footer top section end -->

    <script src="/static/js/owl.carousel.min.js"></script>
    <script src="/static/js/login.js"></script>
    <script src="/static/js/main.js"></script>
</body>
</html>