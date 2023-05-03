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

    <head>
        <style>
            table {
                width: 1000px;
                margin-left: -200px;
            }

            th,
            td {
                max-width: 300px;
                word-wrap: break-word;
                text-align: left;
                padding: 5px 20px 5px 20px;

            }
        </style>
    </head>
    <?php
    require_once("../../setting.php");
    $conn = new mysqli($servername, $username, $password);
    mysqli_select_db($conn, $dbname);



    ?>


    <?php
    $no = 1;
    $sql = "select * from tblfaq";
    $result = mysqli_query($conn, $sql);  //cammand allow sql cmd to be sent to mysql
    if (mysqli_num_rows($result) != 0) { ?>
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
                    <td><a href="viewFAQ.php?FAQID=<?php echo $row["FAQID"]; ?>&Mode=<?php echo "update"; ?>">Edit FAQ</a></p>
                    </td>
                    <td>
                        <a href="deleteFAQ.php?FAQID=<?php echo $row["FAQID"]; ?>">Delete FAQ</a></p>
                    </td>
                </tr>
            <?php $no++;
            }
            ?>
            <tr>
                <td colspan="3"><a href="viewFAQ.php?Mode=<?php echo "insert"; ?> ">Insert new FAQ</a></td>
            </tr>
        </table>
    <?php
    } else {
        // results not found 
        echo "No Service in Database";
    ?>
        <p style="font-size:30px; color:red; margin-top:20px;"><a href="viewService.php?Mode=<?php echo "insert"; ?>">Insert new service</a></p>
    <?php }

    ?>
<?php } ?>