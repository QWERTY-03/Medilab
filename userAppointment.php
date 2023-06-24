<?php
require_once('config/setting.php');
require_once('config/db.php');
require_once('config/function.php');
require_once("config/session.php");

  $email=$_SESSION['Name'];

  if (isset($_POST['change_date'])) {
    // echo $_POST['new-date-time'];
    // goto2("index.php", "Appointment date is successfully update");
    $newDate = $_POST['new-date-time'];
    $app_id = $_POST['app-id'];

    $sql = "UPDATE appointment SET appDate = '$newDate' WHERE appID = '$app_id'";
    mysqli_select_db($conn,"medilabdb");
    if (mysqli_query($conn, $sql)) {
      goto2("index.php", "Appointment date is successfully update");
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Medilab Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v4.3.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
  table, th, tr, td{
    border:1px solid white; 
    border-collapse:collapse;
    text-align:center;
    margin:auto;
    
  }
  table{
    border-radius:15px;
  }
  th{
      background-color:#1977cc;
      color:white;
  }
  tr:nth-child(odd){
    background-color:#E0FFFF;
  }
  tr:nth-child(even){
    background-color:#B0E0E6;
  }
  .view_content{
    text-align:center;
  }
  .ri-edit-2-line:hover{
    cursor: pointer;
  }

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
  }

  /* The Close Button */
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  </style>
</head>
<!-- ======= Appointment Section ======= -->
<section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Appointment List</h2>
          
        </div>
        <div class="view_content">
        <?php
        $query = "select * from `appointment` WHERE `Email`='".$email."'";
        mysqli_select_db($conn, "medilabdb");
        $result1=mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result1);
        
        if(!isset($row)) {
            echo "<p>No appointments available</p>";
        } else {
          echo "<p>These are the appointments that you have made.</p>";
        ?>
        <table >
            <tr>
                <th width="10%">No.</th>
                <th width="10%">Appointment ID</th>
                <th width="15%">Appointment Date Time</th>
                <th width="15%">Appointment Doctor</th>
                <th width="15%">Department</th>
                <th width="20%">Message</th>
                <th width="10%">Print</th>
            </tr>
            <?php 
            $sql="select * from `appointment` WHERE `Email`='".$email."'";
            mysqli_select_db($conn, "medilabdb");
            $result=mysqli_query($conn,$sql);  // command allow sql cmd to be sent to mysql
            $num=1;
            $count=0;
            while($rowcat=mysqli_fetch_assoc($result))
            {?>
            <tr>
                <td><?php echo $num++; ?></td>
                <td><?php echo $rowcat['appID']; ?></td>
                <td><?php echo $rowcat['appDate']?></td>
                <td><?php echo $rowcat['appDoc']?></td>
                <td><?php 
                $deptAPP=$rowcat['appDept'];
                $deptSQL="SELECT * FROM  `department` WHERE $deptAPP=`ID`";
                mysqli_select_db($conn, "medilabdb");
                $result2=mysqli_query($conn,$deptSQL);
                $row=mysqli_fetch_assoc($result2);
                echo $row['name'];
                ?></td>
                <td><?php echo $rowcat['message']?></td>
                <td>
                  <a href="generate_pdf.php?appID=<?php echo $rowcat['appID']; ?>">Print</a>
                </td>
            </tr>
            <?php 
            $data[$count]['appID'] = $rowcat['appID'];
            $data[$count]['currDate'] = $rowcat['appDate'];
            $count++;
            ?>
            <?php }} ?>
        </table>

        <div class="text-center mt-4"><button id="btn-edit" class="appointment-btn">Click here to change date</button></div>

        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <div class="d-flex justify-content-between border-bottom">
              <h4>Change Date Time</h4>
              <span class="close">&times;</span>
            </div>
            <form action="userAppointment.php" method="post">
              <div class="row mt-3">
                <div class="col-4">
                  <label for="" class="form-label">ID:</label>
                </div>
                <div class="col-8">
                  <select name="app-id" id="" class="form-select">
                    <option value="">-- Select Appointment ID --</option>
                    <?php foreach ($data as $val) {?>
                    <option value="<?php echo $val['appID'] ?>"><?php echo $val['appID'] ?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-4">
                  <label class="form-label">New Date Time:</label>
                </div>
                <div class="col-8">
                  <input type="datetime-local" class="form-control" name="new-date-time" value="">
                </div>
              </div>
              <div class="text-end mt-4">
                <button type="submit" name="change_date" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>

        </div>
        </div>
      </div>
      
    </section><!-- End Appointment Section -->

    <script>

      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("btn-edit");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>