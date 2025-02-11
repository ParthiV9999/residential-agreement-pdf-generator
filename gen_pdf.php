<?php
include('dbconn.php');

require_once('tcpdf/tcpdf.php');

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM `residentialtbl` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$agreement = $result->fetch_assoc();

if (!$agreement) {
    die("Agreement not found");
}

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Rental Agreement Generator');
$pdf->SetTitle('Rental Agreement');
$pdf->SetSubject('Rental Agreement');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

$pdf->writeHTML('
<style>
.ta{
background-color:red;
text-align:center;
}
</style>
<h1 class="ta"><u>RESIDENTIAL RENTAL AGREEMENT</u></h1>
<p>' . $agreement["lessor_name"] . '</p>
');

// Output the PDF
$pdf->Output('rental_agreement.pdf', 'I');
