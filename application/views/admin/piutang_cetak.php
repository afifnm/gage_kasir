<?php
	if($kategori==0){
		$aa = '';
	} elseif ($kategori==1) {
		$aa = 'SUDAH LUNAS';
	} elseif ($kategori==2) {
		$aa = 'BELUM LUNAS';
	}
	$pdf = new TCPDF('P', 'mm', 'A4'); 
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetFont('times', 'B', 12);
	$pdf->AddPage();
	$pdf->SetFont('times','B',12);
	$pdf->Cell(0 ,5,'LAPORAN PIUTANG '.mediumdate_indo($tanggal1).' SAMPAI '.mediumdate_indo($tanggal2).' '.$aa,0,1,'C');
	$pdf->Cell(130 ,12,'',0,0);
	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','',10);
	$pdf->Cell(9 ,5,'NO',1,0,'C');
	$pdf->Cell(25 ,5,'NOTA',1,0,'C');
	$pdf->Cell(50 ,5,'NAMA',1,0,'C');
	$pdf->Cell(30 ,5,'TGL.  ORDER',1,0,'C');
	$pdf->Cell(30 ,5,'TOTAL TAGIHAN',1,0,'C');
	$pdf->Cell(30 ,5,'SISA TAGIHAN',1,0,'C');
	$pdf->Cell(20 ,5,'KET',1,0,'C');
	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','',10);
	$no = 1; $sum1 = 0; $sum2 = 0;
    foreach ($data3 as $uu) {
	    $pdf->Cell(9 ,4,$no,1,0,'C');
		$pdf->Cell(25 ,4,$uu['id_produksi'],1,0,'C');
		$pdf->SetFont('times','',9);
		$pdf->Cell(50 ,4,$uu['nama'],1,0,'L');
		$pdf->SetFont('times','',10);
		$pdf->Cell(30 ,4,mediumdate_indo($uu['tanggal']),1,0,'C');
		$pdf->Cell(30 ,4,'Rp. '.number_format($uu['total_tagihan']),1,0,'R');
		$pdf->Cell(30 ,4,'Rp. '.number_format($uu['sisa_tagihan']),1,0,'R');
		$sum1 = $sum1+$uu['total_tagihan'];
		$sum2 = $sum2+$uu['sisa_tagihan'];
		if($uu['sisa_tagihan']<=0){
			$ket = 'LUNAS';
		} else {
			$ket = 'UTANG';
		}
		$pdf->Cell(20 ,4,$ket,1,0,'C');
		$pdf->Cell(189 ,0,'',0,1);//end of line
		$no++;
	}
	$pdf->Cell(9 ,5,'',1,0,'C');
	$pdf->Cell(25 ,5,'',1,0,'C');
	$pdf->Cell(50 ,5,'',1,0,'C');
	$pdf->Cell(30 ,5,'',1,0,'C');
	$pdf->Cell(30 ,5,'Rp. '.number_format($sum1),1,0,'R');
	$pdf->Cell(30 ,5,'Rp. '.number_format($sum2),1,0,'R');
	$pdf->Cell(20 ,5,'',1,0,'C');
	$pdf->Output('laporan_piutang'.$tanggal1.'-'.$tanggal2.'.pdf', 'I');
?>
