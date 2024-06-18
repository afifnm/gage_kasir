<?php
	if($id_jenis==0){
		$jenis = '';
	} else {
		foreach ($data3 as $produksi1) { $jenis = $produksi1['jenis']; }
	}
	$pdf = new TCPDF('', 'mm', 'A4');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->AddPage('L');
	$pdf->SetFont('','B',11);
	$pdf->Cell(0 ,5,'PRODUKSI '.$jenis.' '.mediumdate_indo($tanggal1).' SAMPAI '.mediumdate_indo($tanggal2),0,1,'C');
	$pdf->Cell(130 ,12,'',0,0);

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('','B',9);
	$pdf->MultiCell(9 ,5,'No.', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Tanggal', 1, 'C', '', 0);
	$pdf->MultiCell(50 ,5,'Nama', 1, 'C', '', 0);
	$pdf->MultiCell(50 ,5,'Description', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'P x L', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Bahan', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Harga', 1, 'C', '', 0);
	$pdf->MultiCell(15 ,5,'Jumlah', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Total', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'B. Design', 1, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Total Tagihan', 1, 'C', '', 1);

	$no = 1; $sum = 0; $desen = 0; $tagihan = 0; $jumlah =0;
	$id_produksi = '';
    foreach ($data3 as $produksi) {
		$pdf->SetFont('','',8);
		if($id_produksi<>$produksi['id_produksi']){
		$pdf->MultiCell(9 ,4,$no, 1, 'C', '', 0);
		$pdf->MultiCell(20 ,4,mediumdate_indo($produksi['tanggal']), 1, 'C', '', 0);
		$pdf->MultiCell(50 ,4,$produksi['nama'], 1, 'L', '', 0);
		} else {
		$pdf->MultiCell(79 ,4,'', 1, 'C', '', 0);
		}
		$pdf->Cell(50 ,4,$produksi['deskripsi'], 1, 'L', '', 0);
		$pxl=$produksi['panjang'].' x '.$produksi['lebar'];
		$pdf->Cell(20 ,4,$pxl, 1,0,'C');
		$pdf->Cell(20 ,4,$produksi['bahan'], 1,0,'C');
		$pdf->Cell(20 ,4,'Rp. '.number_format($produksi['harga'],0,",","."), 1,0,'R');
		$pdf->Cell(15 ,4,$produksi['jumlah'], 1,0,'C');
		$total = $produksi['panjang']*$produksi['lebar']*$produksi['harga']*$produksi['jumlah'];
        $sum = $sum+$total;
		$pdf->Cell(25 ,4,'Rp. '.number_format($total,0,",","."), 1,0,'R');

		if($id_produksi<>$produksi['id_produksi']){
		$pdf->MultiCell(20 ,4,'Rp. '.number_format($produksi['biaya_design'],0,",","."), 1, 'R', '', 0);
		$pdf->MultiCell(25 ,4,'Rp. '.number_format($produksi['total_tagihan'],0,",","."), 1, 'R', '', 1);
		$desen = $desen+$produksi['biaya_design'];
		$tagihan = $tagihan+$produksi['total_tagihan'];
		$jumlah = $jumlah+$produksi['jumlah'];
		$no++;
		} else {
		$pdf->MultiCell(45 ,4,'', 1, 'R', '', 1);	
		}
		$id_produksi = $produksi['id_produksi'];	
	}
	$pdf->SetFont('','B',8);
	$pdf->MultiCell(189 ,4,'Sub  Total', 1, 'C', '', 0);
	$pdf->MultiCell(15 ,4,$jumlah, 1, 'C', '', 0);
	$pdf->MultiCell(25 ,4,'Rp. '.number_format($sum,0,",","."), 1, 'R', '', 0);
	$pdf->MultiCell(20 ,4,'Rp. '.number_format($desen,0,",","."), 1, 'R', '', 0);
	$pdf->MultiCell(25 ,4,'Rp. '.number_format($tagihan,0,",","."), 1, 'R', '', 1);
	$pdf->Output('produksi'.$tanggal1.' - '.$tanggal2.'.pdf', 'I');
?>