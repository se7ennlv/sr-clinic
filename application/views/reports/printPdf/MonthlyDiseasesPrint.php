<?php
function Footer() {
	// Position at 15 mm from bottom
	$this->SetY(-15);
	// Set font
	$this->SetFont('helvetica', 'I', 8);
	// Page number
	$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
}
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$fromDate = date('d/m/Y',strtotime($fDate));
$toDate = date('d/m/Y', strtotime($tDate));
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("SR Clinic Summary Monthly Report");
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 11);
$pdf->startPageGroup();
$pdf->AddPage();
$date = date('m/d/Y');
$time = date('H:i:s A');
$logo = '<p align="center"><img img height="50px" src="http://172.16.98.171/srclinic/assets/img/logo.png" ></p>';
$pdf->writeHTML($logo);
$Header = '
		<h2 align="center">Savan Legend Resorts Sole Co.,Ltd.</h2>
		<h3 align="center">Summary Diseases of the month</h3>
		<h5 align="center"> From : '.$fromDate.'  To : '.$toDate.'</5>
		<h2 align="center">Health Center</h2> 
		<h1></h1>';
$pdf->writeHTML($Header);
$table =  '<table border="0" cellspacing="0" cellpadding="3"> ';
$table =  '<table border="0" cellspacing="0" cellpadding="3"> ';

$table .='<tr class="mb-0"> 
<hr> 
	 <th width="40%">Diagnosis</th>
	 <th width="9.5%" align="center">ICD-IO</th>
	 <th width="9%" align="center">Male</th>
	 <th width="9%" align="center">Female</th>
	 <th width="9%" align="center">Total</th> 
	 <th width="12%" align="right">Costs</th> 
	<th width="12%" align="center">Percent(%)</th> 
</tr>  
<hr>';
$mTotal =0;
$fTotal =0;
$tTotal =0;
$aAmount =0;
$TpPpPercent =0;
foreach($dises as $dise )  {
	$mTotal += $dise->Male;		
	$fTotal += $dise->Female;
	$tTotal += $dise->Total;
	$aAmount += $dise->Amount;	
	$TpPpPercent += $dise->pPercent;
	$table .= '<tr>
					<td width="40%">'.$dise->DiseasesName.'</td>
					<td width="9.5%">'.$dise->Code.'</td>
					<td width="10%" align="center">'.$dise->Male.'</td>
					<td width="9%" align="center">'.$dise->Female.'</td>
					<td width="9%" align="center">'.$dise->Total.'</td>
					<td width="12%" align="right">'.number_format($dise->Amount,2,".",",").'</td>
					<td width="12%" align="right">'.number_format($dise->pPercent,2,".",",").'%</td>
				</tr>';
}
$table .='</table>';
$pdf->writeHTML($table);
$endTable ='<hr class="m-1" style="border-top: 0px double #8c8b8b;">';
$pdf->writeHTML($endTable);
$Tablefooter =  '<table border="0" cellspacing="0" cellpadding="3"> ';
$Tablefooter .='<tr class="mb-0">  
<th width="40%" align="right">Grand Total</th>
<th width="9.5%" align="right"></th>
<th width="10%" align="center">'.$mTotal.'</th>
<th width="9%" align="center">'.$fTotal.'</th>
<th width="9%" align="center">'.$tTotal.'</th> 
<th width="12%" align="right">'.number_format($aAmount,2,".",",").'</th> 
<th width="12%" align="right">'.number_format($TpPpPercent,2,".",",").'%</th> 
</tr>  ';

$Tablefooter .='</table>';

$pdf->writeHTML($Tablefooter);
// $pdf->Cell(0, 0, 'Date: '.date("Y-m-d")."-Time: ".$time , 0, false, 'L');
// $pdf->Cell(0, 0, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'R', 0, '', 0, true, 'T', 'M');

$pdf->Output('Monthlyreport.pdf', 'I');
