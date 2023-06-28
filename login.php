<?php
require_once('config/function.php');
include('config/checksession.php');

if (!empty(isset($_GET['email']))) {
  $status = logincheck(trim($_GET['email']), trim($_GET['password']));
  $name = checkUType(trim($_GET['email']), 3);
  $usertype = checkUType(trim($_GET['email']), 1);
  $interface = checkUType(trim($_GET['email']), 2);

  if ($status == 1) {

    $_SESSION['Name'] = $_GET['email'];
    $_SESSION['Type'] = $usertype;
    $_SESSION['Interface'] = $interface;
    //echo "Welcome to the Portal , ".$name;
    goto2($interface, "Welcome to the Portal , " . $name);
  } else {
    goto2("login.php", "Login Fail");
  }
} else {
  if (isset($_COOKIE['loginuser']) && (isset($_COOKIE['loginpass']))) {
    $cu = $_COOKIE['loginuser'];
    $cp = $_COOKIE['loginpass'];
  }

?>

  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="assets/image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      Login to Medilab
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/login.css" rel="stylesheet" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
  </head>


  <body class="login-page sidebar-collapse">
    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
      <div class="container">
        <div class="navbar-translate">
          <a class="navbar-brand" href="https://demos.creative-tim.com/material-kit/index.html">
            Medilab </a>
        </div>
      </div>
    </nav>
    <div class="page-header header-filter" style="background-image: url('assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <div class="card card-login">
              <form class="form" method="" action="">
                <div class="card-header card-header-primary text-center">
                  <div class="social-line">
                    <button type="button" class="btn btn-primary btn-wd btn-lg" onclick="document.location='register.php'">Click here to Sign Up Now!</button>
                  </div>
                  <p>or</p>
                  <!-- <h4 class="card-title">Login</h4> -->
                  <div style="display:flex; align-items:center;justify-content:center">
                    <div data-text="signin_with" data-callback="handleToken" id="g_id_onload" data-client_id="1068824209617-1h1ni873e70h7dukj3kue8j6t8bf7oq9.apps.googleusercontent.com" data-auto_prompt="false">
                    </div>
                    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left">
                    </div>
                  </div>
                </div>

                <p class="description text-center">Welcome to Medilab</p>
                <div class="card-body">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">mail</i>
                      </span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email..." id="email" name="email" value="<?php if (isset($cu)) {
                                                                                                                      echo  $cu;
                                                                                                                    } ?> " required>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <input type="password" class="form-control" placeholder="Password..." name="password" value="<?php if (isset($cp)) {
                                                                                                                    echo  $cp;
                                                                                                                  } ?>" required>
                  </div>
                </div>
                <div class="footer text-center" style="bottom:-15px;">
                  <button type="button" class="btn btn-primary btn-link" onclick="document.location='forgetpw.php'">Forget Password</button>
                  <br>
                  <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Get Started</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by Subarashi Sensei <img src="assets/img/Subarashi.png" alt="Subarashi" width="20px" height="20px"> for perfect fantasy.
          </div>
        </div>
      </footer>
    </div>
  <?php } ?>

  <script>
    function handleToken(response) {
      const responsePayload = decodeJwtResponse(response.credential);
      document.cookie = "IsGoogleLogin = " + "true";
      document.cookie = "googleEmail = " + responsePayload.email;
      document.cookie = "googleName = " + responsePayload.name;
      document.cookie = "googleID=" + responsePayload.sub;
      document.location = 'index.php'
      console.log("ID: " + responsePayload.sub);
      console.log('Full Name: ' + responsePayload.name);
      console.log('Given Name: ' + responsePayload.given_name);
      console.log('Family Name: ' + responsePayload.family_name);
      console.log("Image URL: " + responsePayload.picture);
      console.log("Email: " + responsePayload.email);
    }

    function decodeJwtResponse(token) {
      var base64Url = token.split('.')[1];
      var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
      }).join(''));

      return JSON.parse(jsonPayload);
    }
  </script>
  </body>