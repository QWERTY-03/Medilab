<?php
require_once("../../setting.php");
require_once("../../function.php");
require_once('../../session.php');
if (!(isset($_SESSION['Type']))) {
    goto2("../../../login.php", "Please login first");
}
//if user type not found then go login page.
elseif (strcmp($_SESSION['Type'], "A")) { //if user type not equal A then return false

    goto2("../../../index.php", "Only admin is allowed to enter the page.");
} else {
?>
<?php

    $conn = new mysqli($servername, $username, $password);
    mysqli_select_db($conn, $dbname);
    if (isset($_GET['FAQID'])) {
        $sID = $_GET['FAQID'];

        $sql = "DELETE FROM `tblFAQ` WHERE (`FAQID`='" . $sID . "')";
        if ((mysqli_query($conn, $sql))) {
            goto2("viewFAQ.php", "Service ID='$sID' delected");
        } else {
            goto2("viewFAQ.php", "Fail to delete service !");
        }
    }
?>
<?php } ?>
