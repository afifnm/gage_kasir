<?php

	$pdf = new TCPDF('', 'mm', 'A4');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->AddPage('P');

	$pdf->SetFont('times','B',10);
	$pdf->Cell(0 ,5,'DATA PELANGGAN',0,1,'C');

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','B',10);
	$pdf->MultiCell(9 ,5,'No.', 1, 'C', '', 0);
	$pdf->MultiCell(40 ,5,'Nama', 1, 'C', '', 0);
	$pdf->MultiCell(30 ,5,'CV', 1, 'C', '', 0);
	$pdf->MultiCell(40 ,5,'Alamat', 1, 'C', '', 0);
	$pdf->MultiCell(18 ,5,'Broker', 1, 'C', '', 0);
	$pdf->MultiCell(30 ,5,'Contact Person', 1, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Transaksi', 1, 'C', '', 1);

	$no = 1;
    foreach ($data3 as $u) {
		$pdf->SetFont('times','',9);
		$pdf->MultiCell(9 ,4,$no, 1, 'C', '', 0);
		$pdf->Cell(40 ,4,$u['nama'],  1, 0, 'L');
		$pdf->Cell(30 ,4,$u['cv'],  1, 0, 'C');
		$pdf->Cell(40 ,4,$u['alamat'],  1, 0, 'C');
		$pdf->Cell(18 ,4,$u['broker'],  1, 0, 'C');
		$pdf->Cell(30 ,4,$u['cp'], 1, 0,'C');
		$total_tagihan = $this->CRUD_model->total_tagihan($u['id_pelanggan']);
		$pdf->Cell(20 ,4,'Rp. '.number_format($total_tagihan,0,".",","),  1, 0, 'R');
		$pdf->Cell(0 ,0,'',0,1);//end of line
		$no++;
	}
	$pdf->Output('datapelanggan.pdf', 'I');
?>