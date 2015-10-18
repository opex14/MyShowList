<?php if(!defined('MAINDIR')) die('USE MAIN SCRIPT!'); ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
	<title><?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
<meta name="mobile-web-app-capable" content="yes">
<link rel="shortcut icon" href="favicon.png">
<link rel="apple-touch-icon" href="favicon.png"/>
 
 
<link rel="stylesheet" href="frameworks/css/bootstrap.min.css">

<script src="frameworks/js/jquery-1.11.3.min.js"></script>
<script src="frameworks/js/jquery-migrate-1.2.1.min.js"></script>

<script src="frameworks/js/bootstrap.min.js"></script>

<div class="loading-ov"></div>
</head>
<!-- Modal -->
<script>
function SendCred() {
    $('#loginFail').hide();
    var slogin = $('#InputLogin1').val();
    var spassword = $('#InputPassword1').val();
    $.ajax({
	url: '?mode=login',
	type: 'POST',
	data: {login: slogin, password: spassword},
	success: CredSuccess,
	error: CredFail,
	});
    slogin = spassword = null;
}
function CredFail() {
    $('#loginFail').show();
}
function CredSuccess() {
    location.reload();
}
</script>
<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Вход / Регистрация</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" id="loginFail" style="display:none;" role="alert">
  <strong>Неправильный логин или пароль!</strong>
    </div>
        <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Логин</label>
    <input type="text" class="form-control" id="InputLogin1" placeholder="Логин">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="password" class="form-control" id="InputPassword1" placeholder="Пароль">
  </div>
  <button onclick="SendCred(); return false;" class="btn btn-default">Войти</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<body>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">MyShowList</a>
		  
        </div>
				<ul class="nav navbar-nav navbar-right">
		  <?php if ($user_id > 0) { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
		  <b><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $user_name; ?></b>
		  <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="?mode=list&user=<?php echo $user_name; ?>">Мой список</a></li>
            <li><a href="?mode=logout">Выход</a></li>
          </ul>
        </li>
          <?php } else { ?>
            <li><a role="button" data-toggle="modal" data-target="#loginForm"><b><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Войти</b></a></li>
          <?php } ?>
      </ul>
				
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		  <?php 
		  foreach ($config['menu'] as $me_id => $me_data) {
			  $me_active = ($me_id == $mode) ? ' class="active"' : '' ;
			  echo '<li'.$me_active.'><a href="'.$me_data['url'].'">'.$me_data['title'].'</a></li>';
		  }
		  
		  ?>
			 </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>