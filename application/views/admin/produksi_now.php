<?php
	date_default_timezone_set("Asia/Jakarta");
    $tanggal = date("Y-m-d");
	$pdf = new TCPDF('L', 'mm', 'A4');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetFont('times', 'B', 12);
	$pdf->AddPage();
	$pdf->SetFont('times','B',12);
	$pdf->Cell(0 ,5,'PRODUKSI '.mediumdate_indo($tanggal),0,1,'C');
	$pdf->Cell(130 ,12,'',0,0);

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','B',10);
	$pdf->MultiCell(9 ,5,'No.', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'No. Nota', 1, 'C', '', 0);
	$pdf->MultiCell(35 ,5,'Nama', 1, 'C', '', 0);
	$pdf->MultiCell(45 ,5,'Description', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'P x L', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Bahan', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Harga', 1, 'C', '', 0);
	$pdf->MultiCell(15 ,5,'Jumlah', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Total', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'B. Design', 1, 'C', '', 0);
	$pdf->MultiCell(30 ,5,'Total Tagihan', 1, 'C', '', 1);

	$no = 1; $sum = 0; $desen = 0; $tagihan = 0;
	$id_produksi = '';
    foreach ($data3 as $produksi) {
		$pdf->SetFont('times','',9);
		if($id_produksi<>$produksi['id_produksi']){
		$pdf->MultiCell(9 ,4,$no, 1, 'C', '', 0);
		$pdf->MultiCell(25 ,4,$produksi['id_produksi'], 1, 'L', '', 0);
		$pdf->MultiCell(35 ,4,$produksi['nama'], 1, 'L', '', 0);
		} else {
		$pdf->MultiCell(69 ,4,'', 1, 'C', '', 0);
		}
		$pdf->Cell(45 ,4,$produksi['deskripsi'],1,0,'L');
		if(($produksi['id_jenis']==1) OR ($produksi['id_jenis']==5 )){ $pxl=$produksi['panjang'].' x '.$produksi['lebar'];  } else { $pxl='-'; }
		$pdf->Cell(25 ,4,$pxl,1,0,'C');
		$pdf->Cell(25 ,4,$produksi['bahan'], 1,0,'C');
		$pdf->Cell(20 ,4,'Rp. '.number_format($produksi['harga'],0,",","."),1,0,'R');
		$pdf->Cell(15 ,4,$produksi['jumlah'],1,0,'C');
		$total = $produksi['panjang']*$produksi['lebar']*$produksi['harga']*$produksi['jumlah'];
        $sum = $sum+$total;
		$pdf->Cell(25 ,4,'Rp. '.number_format($total,0,",","."),1,0,'R');

		if($id_produksi<>$produksi['id_produksi']){
		$pdf->MultiCell(20 ,4,'Rp. '.number_format($produksi['biaya_design'],0,",","."), 1, 'R', '', 0);
		$pdf->MultiCell(30 ,4,'Rp. '.number_format($produksi['total_tagihan'],0,",","."), 1, 'R', '', 1);
		$desen = $desen+$produksi['biaya_design'];
		$tagihan = $tagihan+$produksi['total_tagihan'];
		$no++;
		} else {
		$pdf->MultiCell(50 ,4,'', 1, 'R', '', 1);	
		}
		$id_produksi = $produksi['id_produksi'];	
	}
	$pdf->SetFont('times','B',9);
	$pdf->MultiCell(199 ,4,'Sub  Total', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,4,'Rp. '.number_format($sum,0,",","."), 1, 'R', '', 0);
	$pdf->MultiCell(20 ,4,'Rp. '.number_format($desen,0,",","."), 1, 'R', '', 0);
	$pdf->MultiCell(30 ,4,'Rp. '.number_format($tagihan,0,",","."), 1, 'R', '', 1);
	$pdf->Output('produksi '.mediumdate_indo($tanggal).'.pdf', 'I');
?>