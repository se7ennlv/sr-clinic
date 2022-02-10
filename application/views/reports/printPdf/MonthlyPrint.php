<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$fromDate = date('d/m/Y',strtotime($fDate));
$toDate = date('d/m/Y', strtotime($tDate));
$totalGerderT = '';
$totalGerderE = '';
$totalGerderT = $sumtime->MaleT + $sumtime->FemaleT;
$totalGerderE = $mf->Male + $mf->Female;

$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("SR Clinic Summary Monthly Report");
$pdf->SetFont('freeserif', '', 14, '', true);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('freeserif');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('freeserif', '', 11);
$pdf->AddPage();
$logo = '<p align="center"><img img height="50px" src="http://172.16.98.171/srclinic/assets/img/logo.png" ></p>';
$pdf->writeHTML($logo);
$Header = '
<h2 align="center">Savan Legend Resorts Sole Co.,Ltd.</h2>
<h3 align="center">Summary Monthly Report </h3>
<h5 align="center"> From : '.$fromDate.'  To : '.$toDate.'</5>
<h2 align="center">Health Center</h2> 
<h1></h1>';
$pdf->writeHTML($Header);
$line1 = '<hr>';
$pdf->writeHTML($line1);
$content = '1. Summary Total Patient of Monthly(By Per time visit)/ยอดผู้รับบริการทั้งหมด (นับตามจำนวนครั้งที่ใช้บริการ)';
$pdf->writeHTML($content);
$Table1 = '
<table border="1" cellspacing="0" cellpadding="3">  
		<tr>  
			<th width="5%"></th>
			<th width="20%">Patient Male</th>
			<th width="20%">' . $sumtime->MaleT . '</th>
			<th width="55%">Time</th> 
		
		</tr> 
			<tr>  
			<th width="5%"></th>
			<th width="20%">Patient Female</th>
			<th width="20%">' . $sumtime->FemaleT . '</th>
			<th width="55%">Time</th> 
		</tr> 
		<tr>  
			<th width="5%"></th>
			<th width="20%">Total</th>
			<th width="20%">' . $totalGerderT . '</th>
			<th width="55%">Time</th> 
		</tr> 
';
$pdf->writeHTML($Table1);
$line2 = '<hr>';
$pdf->writeHTML($line2);
$content2 = '2. Summary Total Patient visit of Monthly(By Employee Name) / ยอดผู้รับบริการทั้งหมด (นับตามชื่อของพนักงานที่ใช้บริการ)';
$pdf->writeHTML($content2);

$Table2 = '
<table border="1" cellspacing="0" cellpadding="3">  
	  <tr>  
		   <th width="5%"></th>
		   <th width="20%">Patient Male</th>
		   <th width="20%">' . $mf->Male . '</th>
		   <th width="55%">Time</th> 
	  </tr> 
	  <tr>  
		   <th width="5%"></th>
		   <th width="20%">Patient Female</th>
		   <th width="20%">' . $mf->Female . '</th>
		   <th width="55%">Time</th> 
	  </tr> 
	  <tr>  
		   <th width="5%"></th>
		   <th width="20%">Total</th>
		   <th width="20%">' . $totalGerderE . '</th>
		   <th width="55%">Time</th> 
	  </tr> 
';
$pdf->writeHTML($Table2);
$line3 = '<hr>';
$pdf->writeHTML($line3);
$content3 = '3. Summary Cost/ค่าใช้จ่ายทั้งหมด';
$pdf->writeHTML($content3);
$Table3 = '
<table border="1" cellspacing="0" cellpadding="3">  
	  <tr>  
		   <th width="5%"></th>
		   <th width="45%">- Total cost of the month</th>
		   <th width="20%">Cost</th>
		   <th width="20%">' . number_format($sumtime->TotalSumaryMonth,2,".",",") . '</th>
		   <th width="20%">THB</th> 
	  </tr> 
	  <tr>  
		   <th width="5%"></th>
		   <th width="45%">-  Expenses Average per time</th>
		   <th width="20%">Cost</th>
		   <th width="20%">' . number_format($sumtime->PerTimeAvg,2,".",",").'</th>
		   <th width="20%">THB</th> 
	  </tr> 
';
$pdf->writeHTML($Table3);

$pdf->Output('Monthlyreport.pdf', 'I');
