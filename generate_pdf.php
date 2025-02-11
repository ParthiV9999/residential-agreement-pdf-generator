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

// Set default header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add content (you'll need to format this according to your agreement template)
// $html = '';

$html = '<style>
*{
font-family: "Times New Roman", Times, serif;
}
h1{  
font-size:20px;
}
td{
  text-align:left;
}
.capitalize,b{
text-transform: capitalize;
}
</style>
<h1 style="text-align:center;"><u>RESIDENTIAL RENTAL AGREEMENT</u></h1>';

$html .= '<p style="text-align:justify;">This  agreement  made  at <b>' . $agreement["lrcity"] . ', ' . $agreement["lrstate"] . '</b>   on  this  <b>' . $agreement["rent_start_date"] . '</b>  between  <b>' . $agreement["lessor_name"] . '</b>,  residing  at  <b>' . $agreement["lessor_address"] . ', ' . $agreement["lradd2"] . ', ' . $agreement["lrcity"] . ', ' . $agreement["lrstate"] . ', ' . $agreement["lrpincode"] . '</b> hereinafter referred to as the `LESSOR` of the  One Part AND <b>' . $agreement["lessee_name"] . '</b>, residing at  <b>' . $agreement["leadd2"] . ', ' . $agreement["leadd2"] . ', ' . $agreement["lecity"] . ', ' . $agreement["lestate"] . ', ' . $agreement["lepincode"] . '</b> hereinafter referred to as the `LESSEE` of the other Part.</p>';

$html .= '<p style="text-align:justify;">WHEREAS the  Lessor  is  the  lawful  owner  of,  and  otherwise  well  sufficiently entitled  to 
<b>' . $agreement['lessor_address'] . ',' . $agreement["lradd2"] . ',' . $agreement["lrcity"] . ', ' . $agreement["lrstate"] . ', ' . $agreement["lrpincode"] . '</b>  falling  in  the 
category,  <b>' . $agreement["hcategory"] . '</b>  and 
comprising  of  <b>' . $agreement["bedroom"] . '  Bedrooms,  ' . $agreement["bathroom"] . '  Bathrooms,  ' . $agreement["carparks"] . '  Carparks</b>  with  an  extent  of  <b>' . $agreement["sqrfeet"] . ' 
Square Feet</b> hereinafter referred to as the `said premises`.</p>';

$html .= '<p style="text-align:justify;">AND  WHEREAS  at  the  request  of  the  Lessee,  the  Lessor  has  agreed  to  let  the  said 
premises to the tenant for a term of  <b>' . $agreement["leaseterm"] . ' 
months</b> commencing from  <b>' . $agreement["rent_start_date"] . '</b> 
in the manner hereinafter appearing.</p>';

$html .= '<p></p>';
$html .= '<p></p>';

$html .= '<p style="text-align:justify;">NOW THIS AGREEMENT WITNESSETH AND IT IS HEREBY AGREED BY AND BETWEEN 
THE PARTIES AS UNDER: </p>';

$html .= '<ol>';


$html .= '<li><p style="text-align:justify;">That  the  Lessor  hereby  grant  to  the  Lessee,  the  right  to  enter  into  and  use  and 
remain  in  the  said  premises  along  with  the  existing  fixtures  and  fittings  listed  in 
Annexure  1  to  this  Agreement  and  that  the  Lessee  shall  be  entitled  to  peacefully 
possess, and enjoy possession of the said premises, and the other rights herein.</p></li>';

$html .= '<li><p style="text-align:justify;">That  the  lease  hereby  granted  shall,  unless  cancelled  earlier  under  any  provision  of 
this Agreement, remain in force for a period of <b>' . $agreement["leaseterm"] . ' 
months</b>.</p></li>';

$html .= '<li><p style="text-align:justify;">That  the  Lessee  will  have  the  option  to  terminate  this  lease  by  giving  <b>' . $agreement["notice"] . ' 
  month`s notice</b> in writing to the Lessor.</p></li>';

$html .= '<li><p style="text-align:justify;">That  the  Lessee  shall  have  no  right  to  create  any  sub-lease  or  assign  or  transfer  in 
any  manner  the  lease  or  give  to  any  one  the  possession  of  the  said premises  or  any 
part thereof.</p></li>';

$html .= '<li><p style="text-align:justify;">That the Lessee shall use the said premises only for residential purposes.</p></li>';

$html .= '<li><p style="text-align:justify;">That the Lessor shall, before handing over the said premises, ensure  the working of 
sanitary, electrical and water supply connections and other fittings pertaining to the 
said  premises.  It  is  agreed  that  it  shall  be  the  responsibility  of  the  Lessor  for  their 
return  in  the  working  condition  at  the  time  of  re-possession  of  the  said  premises 
(reasonable wear and tear and loss or damage by fire, flood, rains, accident, 
irresistible force or act of God excepted).</p></li>';

$html .= '<li><p style="text-align:justify;">That  the  Lessee  is  not  authorized  to  make  any  alteration  in  the  construction  of  the 
said  premises.  The  Lessee  may  however  install  and  remove  his  own  fittings  and 
fixtures,  provided  this  is  done  without  causing  any  excessive  damage  or  loss  to  the 
said premises.</p></li>';

$html .= '<li><p style="text-align:justify;">That the day to day repair jobs such as fuse blow out, replacement of light 
bulbs/tubes, leakage of water taps, maintenance of the water pump and other minor 
repairs,  etc.,  shall  be  effected  by  the  Lessee  at  its  own  cost,  and  any  major  repairs, 
either  structural  or  to  the  electrical  or  water  connection,  plumbing  leaks,  water 
seepage shall be attended to by the Lessor. In the event of the Lessor failing to carry 
out  the  repairs  on  receiving  notice  from  the  Lessee,  the  Lessee  shall  undertake  the 
necessary  repairs  and  the  Lessor  will  be  liable  to  immediately  reimburse  costs 
incurred by the Lessee.</p></li>';

$html .= '<li><p style="text-align:justify;">That the Lessor or its duly authorized agent shall have the right to enter into or upon 
the said premises or any part thereof at a mutually arranged convenient time for the 
purpose of inspection.</p></li>';

$html .= '<li><p style="text-align:justify;">That  the  Lessee  shall  use  the  said  premises  along  with  its  fixtures  and  fitting  in 
careful  and  responsible  manner  and  shall  handover  the  premises  to  the  Lessor  in 
working  condition  (reasonable  wear  and  tear  and  loss  or  damage  by  fire,  flood, 
rains, accidents, irresistible force or act of God excepted). </p></li>';

$html .= '<li><p style="text-align:justify;">That in consideration of use of the said premises the Lessee agrees that he shall pay 
to  the  Lessor  during  the  period  of  this  agreement,  a  monthly  rent  at  the  rate  of 
<b>Rs.' . $agreement["monthly_rentel"] . '</b>.  The  amount  will  be  paid  in  advance  on  or 

before the date of <b>' . $agreement["advance_date"] . '<span style="text-transform: lowercase;">st</span> day</b> of every English calendar month.</p></li>';

$html .= '<li><p style="text-align:justify;">It is hereby agreed that if default is  made by the lessee in payment of the rent for a 
period  of  three  months,  or  in  observance  and  performance  of  any  of  the  covenants 
and stipulations hereby contained and on the part to be observed and performed by 
the  lessee,  then  on  such  default,  the  lessor  shall  be  entitled  in  addition  to  or  in  the 
alternative  to  any  other  remedy  that  may  be  available  to  him  at  this  discretion,  to 
terminate the lease and eject the lessee from the said premises; and to take 
possession  thereof  as  full  and  absolute  owner  thereof,  provided  that  a  notice  in 
writing  shall  be  given  by  the  lessor  to  the  lessee  of  his  intention  to  terminate  the 
lease  and  to  take  possession  of  the  said  premises.  If  the  arrears  of  rent  are  paid  or 
the  lessee  comply  with  or  carry  out  the  covenants  and  conditions  or  stipulations, 
within  fifteen  days  from  the  service  of  such  notice,  then  the  lessor  shall  not  be 
entitled to take possession of the said premises.</p></li>';

$html .= '<li><p style="text-align:justify;">That  in  addition  to  the  compensation  mentioned  above,  the  Lessee  shall  pay  the 
actual  electricity,  shared  maintenance,  water  bills  for  the  period  of  the  agreement 
directly  to  the  authorities  concerned.  The  relevant  `start  date`  meter  readings  are 
[Starting Meter Reading].</p></li>';

$html .= '<li><p style="text-align:justify;">That  the  Lessee  has  paid  to  the  Lessor  a  sum  of  <b>Rs.' . $agreement["rental_deposite"] . '</b>  as  deposit,  free  of  interest,  which  the  Lessor  does  accept  and  acknowledge. This deposit is for the due performance and observance of the terms and conditions 
of  this  Agreement.  The  deposit  shall  be  returned  to  the  Lessee  simultaneously  with 
the  Lessee  vacating  the  said  premises.  In  the  event  of  failure  on  the  part  of  the 
Lessor to refund the said deposit amount to the Lessee as aforesaid, the Lessee shall 
be entitled to continue to use and occupy the said premises without payment of any 
rent  until  the  Lessor  refunds  the  said  amount  (without  prejudice  to  the  Lessee`s 
rights and remedies in law to recover the deposit).</p></li>';

$html .= '<li><p style="text-align:justify;">That the Lessor shall be responsible for the payment of all taxes and levies 
pertaining to the said premises including but not limited to House Tax, Property Tax, 
other  cesses,  if  any,  and  any  other  statutory  taxes,  levied  by  the  Government  or 
Governmental  Departments.  During  the  term  of  this  Agreement,  the  Lessor  shall 
comply with all rules, regulations and requirements of any statutory authority, local, 
state and central government and governmental departments in relation to the said 
premises.</p></li>';

$html .= '</ol>';
$html .= '<p></p>';
$html .= '<p></p>';

$html .= '<p style="text-align:justify;">IN WITNESS WHEREOF, the parties hereto have set their hands on the day and year first 
hereinabove mentioned.</p>';

$html .= '<table><tr><td class="align-left">Lessor,</td><td class="align-right">Lessee,</td></tr>';

$html .= '<p></p>';

$html .= '<tr><td class="align-left"><b>' . $agreement["lessor_name"] . '</b></td><td class="align-right"><b>' . $agreement["lessee_name"] . '</b></td></tr>';

$html .= '<tr><td class="align-left"><b>' . $agreement["lessor_address"] . '</b></td><td class="align-right"><b>' . $agreement["lessee_address"] . '</b></td></tr>';

$html .= '<tr><td class="align-left"><b>' . $agreement["lradd2"] . '</b></td><td class="align-right"><b>' . $agreement["leadd2"] . '</b></td></tr>';

$html .= '<tr><td class="align-left"><b>' . $agreement["lrcity"] . ', ' . $agreement["lrstate"] . ', ' . $agreement["lrpincode"] . '</b></td><td class="align-right"><b>' . $agreement["lecity"] . ', ' . $agreement["lestate"] . ', ' . $agreement["lepincode"] . '</b></td></tr>';

$html .= '<p></p>';
$html .= '<p></p>';
$html .= '<p></p>';

$html .= '<tr><td class="align-left">WITNESS ONE</td><td class="align-right">WITNESS TWO</td></tr>';

$html .= '<p></p>';
$html .= '<p></p>';
$html .= '<p></p>';

$html .= '<tr><td class="align-left">Name & Address</td><td class="align-right">Name & Address</td></tr></table>';
// ... Add more content based on your agreement template

$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output('rental_agreement.pdf', 'I');
