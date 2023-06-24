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
        ?>

        <?php

        if (isset($_POST['sname'])) {

            $n = $_POST['sname'];
            $d = $_POST['sdes'];
            $sql = "INSERT INTO `tblfaq` (`FAQQuestion`,`FAQAnswer`) VALUES ('" . $n . "','" . $d .  "')";
            if ((mysqli_query($conn, $sql))) {
                goto2("viewFAQ.php", "FAQ Inserted");
            } else {
                goto2("viewFAQ.php", "Failure in insert FAQ '" . $n . "'");
            }
        } else {
            $no = 1;
            $sql = "select * from tblfaq";
            $result = mysqli_query($conn, $sql);  //cammand allow sql cmd to be sent to mysql
        ?>
            <table>
                <tr>
                    <th>FAQ ID</th>
                    <th>FAQ Question</th>
                    <th>FAQ Answer</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>

                        <td><?php echo $row["FAQID"]; ?></td>
                        <td><?php echo $row["FAQQuestion"]; ?></td>
                        <td><?php echo $row["FAQAnswer"]; ?></td>
                        <td><a href="viewService.php?serviceID=<?php echo $row["FAQID"]; ?>&Mode=<?php echo "update"; ?>">Edit service</a></p>
                        </td>
                        <td>
                            <a href="deleteService.php?serviceID=<?php echo $row["FAQID"]; ?>">Delete service</a></p>
                        </td>
                    </tr>
                <?php $no++;
                }
                ?>
                <tr>
                    <form method="POST" action="insertFAQ.php">

                        <td></td>
                        <td><input type="text" name="sname" id="sname"></td>
                        <td><textarea name="sdes" id="sdes" placeholder="Enter description "></textarea></td>
                        <td><input type="submit" value="Add"></td>
                    </form>

                    <form action="viewFAQ.php">
                        <td><input type="submit" value="cancel"></td>
                    </form>
                    <td>
                    </td>
                </tr>

            </table>
        <?php } ?>
    <?php } ?>