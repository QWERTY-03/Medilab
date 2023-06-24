<?php
require_once('../../../config/db.php');
require_once('../../function.php');

?>
<?php 
require_once("../../setting.php");
require_once("../../function.php");
require_once('../../session.php');
if (!(isset($_SESSION['Type']))) {
  goto2("../../../login.php","Please login first");
}
//if user type not found then go login page.
elseif (strcmp($_SESSION['Type'],"A")){//if user type not equal A then return false
  goto2("../../../index.php","Only admin is allowed to enter the page.");}
else{

    $sql ="select * from patient_info where email='".$_GET['email']."'";  // sql command
    mysqli_select_db($conn,$dbname); //select database as default
    $result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
    $patientInfo = mysqli_fetch_assoc($result);
?>

<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Web Programming
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../../../assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
  <!-- <link href="../../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../../assets/css/style.css" rel="stylesheet"> -->
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../../../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="profile-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="../admin.php">
          Admin site </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">apps</i> Components
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="../../../index.html" class="dropdown-item">
                <i class="material-icons">layers</i> All Components
              </a>
              <a href="https://demos.creative-tim.com/material-kit/docs/2.0/getting-started/introduction.html" class="dropdown-item">
                <i class="material-icons">content_paste</i> Documentation
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.creative-tim.com/product/material-kit-pro" target="_blank">
              <i class="material-icons">unarchive</i> Upgrade to PRO
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Follow us on Twitter" rel="nofollow">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank" data-original-title="Like us on Facebook" rel="nofollow">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank" data-original-title="Follow us on Instagram" rel="nofollow">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('../assets/img/city-profile.jpg');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
              </div>
            </div>
          </div>
        </div>

        <!-- Put Code here -->
        <section id="patientForm">
            <div class="container">
                <div class="section-title">
                    <h2>Patient Information</h2>
                </div>
                <div class="card">
                    <div class="card-header"><h4>General Information</h4></div>
                    <div class="card-body border-bottom">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="" class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" name="fname" value="<?php echo ($patientInfo['fname']!='' ? $patientInfo['fname'] : '') ?>" disabled>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="<?php echo ($patientInfo['lname']!='' ? $patientInfo['lname'] : '') ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo ($patientInfo['email']!='' ? $patientInfo['email'] : '') ?>" disabled>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Telephone Number</label>
                                <input type="tel" class="form-control" name="telno" value="<?php echo ($patientInfo['telno']!='' ? $patientInfo['telno'] : '') ?>" disabled>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">I/C</label>
                                <input type="text" class="form-control" name="ic" value="<?php echo ($patientInfo['ic']!='' ? $patientInfo['ic'] : '') ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="" class="form-label fw-bold">Address</label>
                                <textarea type="text" class="form-control" name="address" disabled><?php echo ($patientInfo['address']!='' ? $patientInfo['address'] : '') ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Date of Birth</label>
                                <input type="text" class="form-control" id="datepicker" name="dob" value="<?php echo ($patientInfo['DOB']!='' ? $patientInfo['DOB'] : '') ?>" disabled/>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Gender</label>
                                <input type="text" class="form-control" name="gender" value="<?php echo ($patientInfo['gender']!='' ? $patientInfo['gender'] : '') ?>" disabled>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Nationality</label>
                                <select name="nationality" id="" class="form-control selectpicker" disabled>
                                    <option value="malaysian" <?php echo ($patientInfo['nationality']=='malaysian' ? 'selected' : '') ?>>Malaysian</option>
                                    <option value="non-malaysian" <?php echo ($patientInfo['nationality']=='non-malaysian' ? 'selected' : '') ?>>Non-Malaysian</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-header"><h4>Medical Tracking</h4></div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Do you smoke?</label>
                                <input type="text" class="form-control" name="smoke" value="<?php echo ($patientInfo['is_smoke']!='' ? $patientInfo['is_smoke'] : '') ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Do you consume alcohol?</label>
                                <input type="text" class="form-control" name="alcohol" value="<?php echo ($patientInfo['is_alcohol']!='' ? $patientInfo['is_alcohol'] : '') ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">Do you exercise regularly?</label>
                                <input type="text" class="form-control" name="is_exercise" value="<?php echo ($patientInfo['is_exercise']!='' ? $patientInfo['is_exercise'] : '') ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <label for="" class="form-label fw-bold">State your allergy (if any)</label>
                                <input type="text" class="form-control" name="allergy" value="<?php echo ($patientInfo['allergy']!='' ? $patientInfo['allergy'] : '') ?>" disabled>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile-tabs">
              <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                    <i class="material-icons">camera</i> Studio
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                    <i class="material-icons">palette</i> Work
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#favorite" role="tab" data-toggle="tab">
                    <i class="material-icons">favorite</i> Favorite
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
       </div>
      </div>
    </div>
  </div>
  <footer class="footer footer-default">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com/">
              Creative Tim
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/presentation">
              About Us
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/blog">
              Blog
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/license">
              Licenses
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a> for a better web.
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="../../../assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../../../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../../../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="../../../assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="../../../assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../../../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="../../../assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
</body>

</html>
<?php } ?>