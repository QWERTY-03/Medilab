<?php
require_once('tcpdf/tcpdf.php');
require_once('config/setting.php');
require_once('config/db.php');
require_once('config/function.php');
require_once("config/session.php");

// Retrieve the appID value from the query parameter
$appID = $_GET['appID'];

// Create a new PDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Set the document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Appointment Details');

// Set default header and footer data
$pdf->SetHeaderData('', 0, '', '');
$pdf->setFooterData('', 0, '', '');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Get data from the database
$sql = "SELECT * FROM `appointment` WHERE `appID`='" . $appID . "'";
mysqli_select_db($conn, "medilabdb");
$result = mysqli_query($conn, $sql);
$num = 1;

// Loop through the rows and generate the appointment letters
while ($rowcat = mysqli_fetch_assoc($result)) {
    $pdf->Cell(0, 10, 'Medilab', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Doctor Appointment Letter', 0, 1, 'C');

    $pdf->MultiCell(0, 10, 'Dear Patient,', 0, 'L');
    $pdf->Ln();

    $pdf->MultiCell(0, 10, 'We are pleased to inform you that your appointment has been scheduled as follows:', 0, 'L');
    $pdf->Ln();

    $pdf->MultiCell(0, 10, 'Appointment ID: ' . $rowcat['appID'], 0, 'L');
    $pdf->MultiCell(0, 10, 'Appointment Date: ' . $rowcat['appDate'], 0, 'L');
    $pdf->MultiCell(0, 10, 'Appointment Doctor: ' . $rowcat['appDoc'], 0, 'L');

    // Fetch department data
    $deptAPP = $rowcat['appDept'];
    $deptSQL = "SELECT * FROM  `department` WHERE `ID` = '$deptAPP'";
    mysqli_select_db($conn, "medilabdb");
    $result2 = mysqli_query($conn, $deptSQL);
    $row = mysqli_fetch_assoc($result2);

    $pdf->MultiCell(0, 10, 'Department: ' . $row['name'], 0, 'L');
    $pdf->Ln();

    $pdf->MultiCell(0, 10, 'Message: ' . $rowcat['message'], 0, 'L');
    $pdf->Ln();

    $pdf->MultiCell(0, 10, 'Thank you for choosing our services. If you have any questions or need further assistance, please feel free to contact us.', 0, 'L');
    $pdf->Ln();

    $pdf->MultiCell(0, 10, 'Sincerely,', 0, 'L');
    $pdf->MultiCell(0, 10, 'Medilab', 0, 'L');

    // Add a new page for the next appointment letter
    if ($num < mysqli_num_rows($result)) {
        $pdf->AddPage();
    }

    $num++;
}

// Output the PDF
ob_end_clean();
$pdf->Output('appointment.pdf', 'I');
?>
