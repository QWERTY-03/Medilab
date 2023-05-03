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
    <tite>
        <style>
            table {
                width: 1000px;
                margin-left: -200px;
            }

            th,
            td {
                max-width: 300px;
                word-wrap: break-word;
                text-align: center;
                padding: 5px 20px 5px 20px;
                text-align: justify;
            }
        </style>
        </title>
        <?php
        require_once("../../setting.php");
        require_once("../../function.php");
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn, $dbname);
        if (isset($_POST['sname']) && isset($_GET['FAQID'])) {
            $sid = $_GET['FAQID'];
            $sn = $_POST['sname'];
            $sd = $_POST['sdes'];
            $sql1 = " UPDATE `tblfaq` SET  `FAQQuestion`='" . $sn . "',`FAQAnswer`='" . $sd . "'  WHERE (`FAQID`='" . $sid . "') ";
            if (mysqli_query($conn, $sql1)) {
                goto2("viewFAQ.php", "Data Updated!");
            } else {
                goto2("viewFAQ.php", "Fail to update data");
            }
        } else {
            if (isset($_GET['FAQID'])) {
                $sid = $_GET['FAQID'];

                $no = 1;
                $sql = "select * from tblfaq";
                $result = mysqli_query($conn, $sql);  //cammand allow sql cmd to be sent to mysql
                if (mysqli_num_rows($result) != 0) { ?>
                    <table>
                        <tr>
                            <th>FAQ ID</th>
                            <th>FAQ Question</th>
                            <th>FAQ Answer</th>>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {

                            if ($row["FAQID"] == $sid) { ?>
                                <form method="POST" action="updateFAQ.php?FAQID=<?php echo $row['FAQID']; ?>">
                                    <tr>
                                        <td><?php echo $row["FAQID"]; ?></td>
                                        <td><input type="text" name="sname" id="sname" value="<?php echo $row['FAQQuestion']; ?>"></td>
                                        <td><textarea name="sdes" id="sdec" rows="3" cols="30" value="<?php echo $row['FAQAnswer']; ?>"><?php echo $row['FAQAnswer']; ?></textarea></td>
                                        <td><input type='submit' value="save"></td>
                                </form>
                                <form action="viewFAQ.php">
                                    <td><input type='submit' value="Cancel"></td>
                                </form>
                                </tr>
                            <?php } else { ?>
                                <tr>

                                    <td><?php echo $row["FAQID"]; ?></td>
                                    <td><?php echo $row["FAQQuestion"]; ?></td>
                                    <td class="hello"><?php echo $row["FAQAnswer"]; ?></td>
                                </tr>
                        <?php $no++;
                            }
                        } ?>
                    </table>
                <?php
                } else {
                    // results not found 
                    echo "No Service in Database";
                ?>
                    <p style="font-size:30px; color:red; margin-top:20px;"><a href="viewService.php?Mode=<?php echo "insert"; ?>">Insert new service</a></p>
        <?php }
            } else {
                goto2("viewService.php", "Failed to retrieve serviceID");
            }
        } ?>
    <?php } ?>