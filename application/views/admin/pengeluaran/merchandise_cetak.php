<?php

	$pdf = new TCPDF('P', 'mm', 'A4');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetFont('times', 'B', 12);
	$pdf->AddPage();
	$pdf->SetFont('times','B',12);
	$pdf->Cell(0 ,5,'PENGELUARAN MERCHANDISE '.mediumdate_indo($tanggal1).' SAMPAI '.mediumdate_indo($tanggal2),0,1,'C');
	$pdf->Cell(130 ,12,'',0,0);

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('','B',9);
	$pdf->MultiCell(9 ,5,'No.', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Tanggal', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Order', 1, 'C', '', 0);
	$pdf->MultiCell(40 ,5,'Keterangan', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Bahan', 1, 'C', '', 0);
	$pdf->MultiCell(10 ,5,'QTY', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Harga', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Total', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Pembayaran', 1, 'C', '', 1);


	$no = 1; $sum = 0; $desen = 0; $tagihan = 0;
	$tanggal = '';
    foreach ($data2 as $u) {
		$pdf->SetFont('','',8);
		if($tanggal<>$u['tanggal']){
		$pdf->MultiCell(9 ,4,$no, 1, 'C', '', 0);
		$pdf->MultiCell(20 ,4,mediumdate_indo($u['tanggal']), 1, 'C', '', 0);
		$no++;
		} else {
		$pdf->MultiCell(29 ,4,'', 1, 'C', '', 0);
		}
		$pdf->Cell(25 ,4,$u['gramatur'], 1, 0,'C');
		$pdf->Cell(40 ,4,$u['keterangan'],  1, 0, 'L');
		$pdf->Cell(20 ,4,$u['id_sup'], 1, 'C', 0);
		$pdf->Cell(10 ,4,$u['qty'], 1, 'C', 0);
		$pdf->Cell(20 ,4,'Rp. '.number_format($u['harga'],0,",","."), 1, 0,'R');
		$pdf->Cell(20 ,4,'Rp. '.number_format($u['qty']*$u['harga'],0,",","."), 1, 0,'R');
		$pdf->MultiCell(25 ,4,$u['pembayaran'], 1, 'C', '', 1);
		$tanggal = $u['tanggal'];	
		$sum = $sum+$u['qty']*$u['harga'];
	
	}
	$pdf->SetFont('','B',8);
	$pdf->MultiCell(144 ,4,'Sub  Total', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,4,'Rp. '.number_format($sum,0,",","."), 1, 'R', '', 0);
	$pdf->MultiCell(25 ,4,'', 1, 'C', '', 1);
	// $pdf->MultiCell(20 ,4,'Rp. '.number_format($desen,0,",","."), 1, 'R', '', 0);
	// $pdf->MultiCell(25 ,4,'Rp. '.number_format($tagihan,0,",","."), 1, 'R', '', 1);
	$pdf->Output('pengeluaran_merchandise'.$tanggal1.'-'.$tanggal2.'.pdf', 'I');
?>