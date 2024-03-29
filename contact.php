<!-- ======= Footer ======= -->
<?php
require_once('config/db.php');
$sql = "select * from tblfaq";
mysqli_select_db($conn, $dbname);
$result = mysqli_query($conn, $sql);
?>
<footer id="footer">

  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="section-title">
          <h2>Frequently Asked Question</h2>
        </div>

        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3><?php echo $row['FAQQuestion']; ?></h3>
            <p>
              <?php echo $row['FAQAnswer']; ?> <br>
            </p>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>

  <div class="container d-md-flex py-4">

    <div class="me-md-auto text-center text-md-start">
      <div class="copyright">
        &copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved
      </div>
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
      <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
      <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
      <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
      <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
      <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
    </div>
  </div>
</footer><!-- End Footer -->