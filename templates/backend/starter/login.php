<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login Admin</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css'); ?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css'); ?>/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css'); ?>/font-awesome.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css'); ?>/style.css" rel="stylesheet" type="text/css">
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css'); ?>/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>

  <div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

      <div class="container">

        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <a class="brand" href="index.html">
          CI Basic CMS
        </a>

        <div class="nav-collapse">
          <ul class="nav pull-right">


            <li class="">
              <a href="index.html" class="">
                <i class="icon-chevron-left"></i>
                Kembali ke Beranda
              </a>

            </li>
          </ul>

        </div>
        <!--/.nav-collapse -->

      </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

  </div> <!-- /navbar -->



  <div class="account-container">

    <div class="content clearfix">

      <form action="<?php echo set_url('login'); ?>" method="post">

        <h1>Selamat Datang!</h1>

        <div class="login-fields">

          <p>Silahkan isikan info login anda </p>

          <div class="field">
            <label for="username">Username: </label><?php //echo form_error('username'); 
                                                    ?>
            <input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
          </div> <!-- /field -->

          <div class="field">
            <label for="password">Password: </label><?php //echo form_error('password'); 
                                                    ?>
            <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field" />
          </div> <!-- /password -->

        </div> <!-- /login-fields -->

        <div class="login-actions">

          <span class="login-checkbox">
            <input id="remember" name="remember" type="checkbox" class="field login-checkbox" value="yes" tabindex="4" />
            <label class="choice" for="remember">Biarkan saya tetap login!</label>
          </span>

          <button class="button btn btn-primary btn-large">Log In</button>

        </div> <!-- .actions -->



      </form>

    </div> <!-- /content -->

  </div> <!-- /account-container -->



  <div class="login-extra">
    <a href="<?= set_url('login/lupa_password'); ?>"><i class="icon-key"></i> Lupa Password</a>
  </div> <!-- /login-extra -->


  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js'); ?>/jquery-1.7.2.min.js"></script>
  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js'); ?>/bootstrap.js"></script>

  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js'); ?>/signin.js"></script>

</body>

</html>