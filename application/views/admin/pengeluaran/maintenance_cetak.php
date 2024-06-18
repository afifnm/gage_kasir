<?php

	$pdf = new TCPDF('P', 'mm', 'A4');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetFont('times', 'B', 12);
	$pdf->AddPage();
	$pdf->SetFont('times','B',12);
	$pdf->Cell(0 ,5,'PENGELUARAN MAINTENANCE '.mediumdate_indo($tanggal1).' SAMPAI '.mediumdate_indo($tanggal2),0,1,'C');
	$pdf->Cell(130 ,12,'',0,0);

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','B',10);
	$pdf->MultiCell(9 ,5,'No.', 1, 'C', '', 0);
	$pdf->MultiCell(30 ,5,'Tanggal', 1, 'C', '', 0);
	$pdf->MultiCell(60 ,5,'Keterangan', 1, 'C', '', 0);
	$pdf->MultiCell(30 ,5,'Nominal', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Pembayaran', 1, 'C', '', 1);

	$no = 1; $sum = 0; $desen = 0; $tagihan = 0;
	$tanggal = '';
    foreach ($data2 as $u) {
		$pdf->SetFont('times','',9);
		if($tanggal<>$u['tanggal']){
		$pdf->MultiCell(9 ,4,$no, 1, 'C', '', 0);
		$pdf->MultiCell(30 ,4,mediumdate_indo($u['tanggal']), 1, 'C', '', 0);
		$no++;
		} else {
		$pdf->MultiCell(39 ,4,'', 1, 'C', '', 0);
		}
		$pdf->Cell(60 ,4,$u['keterangan'],  1, 0, 'L');
		$pdf->Cell(30 ,4,'Rp. '.number_format($u['harga'],0,",","."), 1, 0,'R');
		$pdf->Cell(25 ,4,$u['pembayaran'],  1, 0, 'C');
		$pdf->Cell(0 ,0,'',0,1);//end of line
		
		$tanggal = $u['tanggal'];	
		$sum = $sum+$u['harga'];
		
	}
	$pdf->SetFont('times','B',9);
	$pdf->MultiCell(99 ,4,'Sub  Total', 1, 'C', '', 0);
	$pdf->MultiCell(30 ,4,'Rp. '.number_format($sum,0,",","."), 1, 'R', '', 0);
	$pdf->MultiCell(25 ,4,'', 1, 'C', '', 1);
	// $pdf->MultiCell(20 ,4,'Rp. '.number_format($desen,0,",","."), 1, 'R', '', 0);
	// $pdf->MultiCell(25 ,4,'Rp. '.number_format($tagihan,0,",","."), 1, 'R', '', 1);
	$pdf->Output('pengeluaran_lainlain'.$tanggal1.'-'.$tanggal2.'.pdf', 'I');
?>