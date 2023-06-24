<!DOCTYPE html>
<html lang="en">
<?php 
include('config/db.php');
include("config/function.php"); 
require_once("config/session.php");

if(!isset($_SESSION['Name'])){ //if login in session is not set
  header("Location: login.php");
}

$sql ="select * from patient_info where userID='".$_GET['userID']."'";  // sql command
mysqli_select_db($conn,$dbname); //select database as default
$result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
$patientInfo = mysqli_fetch_assoc($result);
// exit(json_encode($patientInfo));

if (isset($_POST['submit_patient_info'])) {
    $userID = $_GET['userID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telno = $_POST['telno'];
    $ic = $_POST['ic'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $smoke = $_POST['smoke'];
    $alcohol = $_POST['alcohol'];
    $exercise = $_POST['exercise'];
    $allergy = $_POST['allergy'];

    $sql ="UPDATE patient_info SET fname='".$fname."',lname='".$lname."',email='".$email."',telno='".$telno."',ic='".$ic."',
        address='".$address."',DOB='".$dob."',gender='".$gender."',nationality='".$nationality."',is_smoke='".$smoke."',
        is_alcohol='".$alcohol."',is_exercise='".$exercise."',allergy='".$allergy."',status='complete'
        WHERE userID='".$userID."' ";  // sql command
    mysqli_select_db($conn,$dbname); //select database as default
    mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
    goto2("patientInfo.php?userID=".$_GET['userID'],"Successfully update patient information");

    // echo $smoke; exit;
}
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Medilab</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- jQuery -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
  .container d-flex align-items-center{
    display:flex;
    justify-content:space-between;
    align-content:center;
  }
  #navii{
    margin-top:-20px;
  }
  #app{
    margin-top:-20px;
  
  }
  #logout{
    margin-top:-20px; 
    margin-left:30px;

  }
  #up{
    margin-top:-3px;
  }

  .card-header {
      background-color: #3291e6;
  }

  .card-body {
      background-color: #aed1f1;
  }

  
  
  
  @media (max-width: 767px){
    #search{
      width:100px;
    }
    ::placeholder{
      font-size:small;
    }
    .appointment-btn{
      font-size:small;
      width:80px;
    }
    #app{
      width:105px;
      margin-left:-12px;
    }
    #logout{
      width:20px;
      margin-left:-10px;
    }
  }
  </style>

  <!-- =======================================================
  * Template Name: Medilab - v4.3.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        Contact us at &nbsp;
        <i class="bi bi-envelope"></i> <a href="mailto:medilab@gmail.com">medilab@gmail.com</a>
        <i class="bi bi-phone"></i> +603-3245646
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Medilab</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0" >
        <!-- <a href="patientInfo.php" class="appointment-btn px-2" id="app" style="color:white; padding:5px; "><span class="d-none d-md-inline">Patient Information</a> -->
        <!-- <h2>Patient Information</h2> -->
        <a href="logout.php"><img src="assets/img/logout.png" id="logout" width="30px" ></a>
      </nav><!-- .navbar -->
    </div>
    
  </header><!-- End Header -->

  <!-- ======= Services Section ======= -->
  <section id="Form" class="services">
        <section id="patientForm">
            <div class="container">
                <div class="section-title">
                    <h2>Patient Information</h2>
                </div>
                <form action="" method="post">
                    <div class="text-end mb-3">
                        <button type="submit" name="submit_patient_info" class="btn btn-primary">Update</button>
                    </div>
                    <div class="card">
                        <div class="card-header text-white"><h4>General Information</h4></div>
                        <div class="card-body border-bottom">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label for="" class="form-label fw-bold">First Name</label>
                                    <input type="text" class="form-control" name="fname" value="<?php echo ($patientInfo['fname']!='' ? $patientInfo['fname'] : '') ?>">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label fw-bold">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="<?php echo ($patientInfo['lname']!='' ? $patientInfo['lname'] : '') ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo ($patientInfo['email']!='' ? $patientInfo['email'] : '') ?>">
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Telephone Number</label>
                                    <input type="tel" class="form-control" name="telno" value="<?php echo ($patientInfo['telno']!='' ? $patientInfo['telno'] : '') ?>">
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">I/C</label>
                                    <input type="text" class="form-control" name="ic" value="<?php echo ($patientInfo['ic']!='' ? $patientInfo['ic'] : '') ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="" class="form-label fw-bold">Address</label>
                                    <textarea type="text" class="form-control" name="address"><?php echo ($patientInfo['address']!='' ? $patientInfo['address'] : '') ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Date of Birth</label>
                                    <input type="text" class="form-control" id="datepicker" name="dob" placeholder="dd/mm/yyyy" value="<?php echo ($patientInfo['DOB']!='' ? $patientInfo['DOB'] : '') ?>"/>
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Gender</label>
                                    <div class="d-flex flex-row">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo ($patientInfo['gender']=='male' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo ($patientInfo['gender']=='female' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Nationality</label>
                                    <select name="nationality" id="" class="form-select">
                                        <option value="malaysian" <?php echo ($patientInfo['nationality']=='malaysian' ? 'selected' : '') ?>>Malaysian</option>
                                        <option value="non-malaysian" <?php echo ($patientInfo['nationality']=='non-malaysian' ? 'selected' : '') ?>>Non-Malaysian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-white"><h4>Medical Tracking</h4></div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Do you smoke?</label>
                                    <div class="d-flex flex-row">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="smoke" id="smoke1" value="yes" <?php echo ($patientInfo['is_smoke']=='yes' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="smoke1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="smoke" id="smoke2" value="no" <?php echo ($patientInfo['is_smoke']=='no' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="smoke2">
                                                No
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Do you consume alcohol?</label>
                                    <div class="d-flex flex-row">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="alcohol" id="alcohol1" value="yes" <?php echo ($patientInfo['is_alcohol']=='yes' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="alcohol1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="alcohol" id="alcohol2" value="no" <?php echo ($patientInfo['is_alcohol']=='no' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="alcohol2">
                                                No
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">Do you exercise regularly?</label>
                                    <div class="d-flex flex-row">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="exercise" id="exercise1" value="yes" <?php echo ($patientInfo['is_exercise']=='yes' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="exercise1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exercise" id="exercise2" value="no" <?php echo ($patientInfo['is_exercise']=='no' ? 'checked' : '') ?>>
                                            <label class="form-check-label" for="exercise2">
                                                No
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <label for="" class="form-label fw-bold">State your allergy (if any)</label>
                                    <input type="text" class="form-control" name="allergy" value="<?php echo ($patientInfo['allergy']!='' ? $patientInfo['allergy'] : '') ?>">  
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </section><!-- End Services Section -->

    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker();

            // alert('yes');
        });
    </script>
</body>
</html>