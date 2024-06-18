<?php
	foreach ($data2 as $produksi) {
	$pdf = new TCPDF('', 'mm', 'A4');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->AddPage('P');
	$pdf->SetFont('','B',12);
	$pdf->Image('assets/upload/logo.png',10,10,60,0,'PNG');
	$pdf->Cell(130 ,12,'',0,0);
	$pdf->Cell(35 ,12,'#'.$produksi['id_produksi'],0,0);
	$pdf->SetFont('','',11);
	$pdf->Cell(40 ,12,date("d F Y", strtotime($produksi['tanggal'])),0,1);
	
	$pdf->Cell(15 ,5,'Alamat',0,0);
	$pdf->Cell(5 ,5,' : ',0,0);
	$pdf->MultiCell(70, 5,$alamat, 0, 1, '', 0);
	$pdf->Cell(35 ,5,'PIC : '.$produksi['pic'],0,0);
	$pdf->Cell(15 ,5,'Nama',0,0);
	$pdf->Cell(34 ,5,' : '.$produksi['nama'],0,1);

	$pdf->Cell(15 ,5,'Phone',0,0);
	$pdf->Cell(5 ,5,' : ',0,0);
	$pdf->MultiCell(105, 5,$phone, 0, 1, '', 0);
	$pdf->Cell(15 ,5,'Alamat',0,0);
	$pdf->Cell(34 ,5,' : '.$produksi['alamat'],0,1);

	$pdf->Cell(15 ,5,'Email',0,0);
	$pdf->Cell(5 ,5,' : ',0,0);
	$pdf->MultiCell(105, 5,$email, 0, 1, '', 0);
	$pdf->Cell(15 ,5,'CP',0,0);
	$pdf->Cell(34 ,5,' : '.$produksi['cp'],0,1);	
	$borderheader = array(
	   'T' => array('width' => 0.5, 'color' => array(0,0,0)),
	   'B' => array('width' => 0.5, 'color' => array(0,0,0)),
	);
	$border = array();
	$border2 = array(
		'T' => array('width' => 0.5, 'color' => array(0,0,0)),
	);

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('','B',11);
	$pdf->MultiCell(9 ,5,'No.', $borderheader, 'C', '', 0);
	$pdf->MultiCell(60 ,5,'Description', $borderheader, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'P x L', $borderheader, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Bahan', $borderheader, 'C', '', 0);
	$pdf->MultiCell(25 ,5,'Harga', $borderheader, 'C', '', 0);
	$pdf->MultiCell(20 ,5,'Jumlah', $borderheader, 'C', '', 0);
	$pdf->MultiCell(30 ,5,'Total', $borderheader, 'C', '', 1);
	$pdf->SetFont('','',10);
	$no = 1;
	$sum = 0;

	foreach ($data3 as $u) {
		$pdf->Cell(9 ,5,$no,$border,0,'C'); $no++;
		$pdf->Cell(60 ,5,$u['deskripsi'],$border,0,'C');
		if($u['id_jenis']==1){
        $pxl = $u['panjang'].' x '.$u['lebar'];  } else { $pxl= '-'; }
		$pdf->Cell(20 ,5,$pxl,$border,0,'C');
		$pdf->Cell(25 ,5,$u['bahan'],$border,0,'C');
		$pdf->Cell(25 ,5,'Rp. '.number_format($u['harga'],0,",","."),$border,0,'R');
		$pdf->Cell(20 ,5,$u['jumlah'],$border,0,'C');
		$total = $u['panjang']*$u['lebar']*$u['harga']*$u['jumlah'];
        $sum = $sum+$total;
		$pdf->Cell(30 ,5,'Rp. '.number_format($total,0,",","."),$border,1,'R');
	}
		
		$pdf->Cell(139 ,5,'Perhatian, mohon barang dicek kembali, komplain lebih dari 1 hari tidak kami layani.',$border2,0);
		if($produksi['biaya_design']>0) { 
			$pdf->Cell(20 ,5,'Biaya Design',$border2,0);
			$pdf->Cell(30 ,5,'Rp. '.number_format($produksi['biaya_design'],0,",","."),$border2,1,'R');
		} else {
			$pdf->Cell(50 ,5,'',$border2,1);	
		}
		
		
		$pdf->Cell(139 ,5,$norek,0,0);
		if($produksi['diskon']>0) {
			$pdf->Cell(20 ,5,'Potongan '.number_format($produksi['diskon'],0,",",".").'%',0,0);
			$potongan = $sum*$produksi['diskon']/100; 
			$pdf->Cell(30 ,5,'- Rp. '.number_format($potongan,0,",","."),0,1,'R');
		} else {
			$pdf->Cell(0 ,5,'',0,1);	
		}
		
		$pdf->Cell(70 ,5,'Hormat Kami',0,0,'C');
		$pdf->Cell(69 ,5,'Penerima',0,0,'C');
		$pdf->Cell(20 ,5,'Total Tagihan',0,0);
		$pdf->Cell(30 ,5,'Rp. '.number_format($produksi['total_tagihan'],0,",","."),0,1,'R');

		$pdf->Cell(139 ,5,'',0,0);
		$pdf->Cell(20 ,5,'Bayar',0,0);
		$pdf->Cell(30 ,5,'Rp. '.number_format($produksi['total_tagihan']-$produksi['sisa_tagihan'],0,",","."),0,1,'R');

		$pdf->Cell(70 ,5,$this->session->userdata('nama'),0,0,'C');
		$pdf->Cell(69 ,5,$produksi['nama'],0,0,'C');
		$pdf->Cell(20 ,5,'Sisa Tagihan',0,0);
		$pdf->Cell(30 ,5,'Rp. '.number_format($produksi['sisa_tagihan'],0,",","."),0,1,'R');
	$pdf->Output('nota.pdf', 'I');
}
?>