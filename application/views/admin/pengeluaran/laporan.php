<?php

	$pdf = new TCPDF('L', 'mm', 'A4'); 
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetFont('times', 'B', 12);
	$pdf->AddPage();
	$pdf->SetFont('times','B',12);
	$pdf->Cell(0 ,5,'PENGELUARAN '.mediumdate_indo($tanggal1).' SAMPAI '.mediumdate_indo($tanggal2),0,1,'C');
	$pdf->Cell(130 ,12,'',0,0);

	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','B',9);
	$pdf->Cell(20 ,4,'TANGGAL', 1,0,'C');
	$pdf->Cell(50 ,4,'KETERANGAN', 1,0,'C');
	$pdf->Cell(30 ,4,'SALDO AWAL', 1,0,'C');
	$pdf->Cell(30 ,4,'PENDAPATAN', 1,0,'C');
	$pdf->Cell(30 ,4,'DIGITAL PRINT', 1,0,'C');
	$pdf->Cell(30 ,4,'OFFSET', 1,0,'C');
	$pdf->Cell(30 ,4,'MERCHANDISE', 1,0,'C');
	$pdf->Cell(30 ,4,'RUMAH TANGGA', 1,0,'C');
	$pdf->Cell(30 ,4,'PRIVE', 1,0,'C');
	$pdf->Cell(189 ,0,'',0,1);//end of line

	$pdf->SetFont('times','',8);
	$saldo = $saldo+$this->Pengeluaran_model->pendapatan_b4($tanggal1)-$this->Pengeluaran_model->pengeluaran_b4($tanggal1);	
	$saldo2 = $saldo2+$this->Pengeluaran_model->pendapatan_b4_bank($tanggal1)-$this->Pengeluaran_model->pengeluaran_b4_bank($tanggal1);	
	$sum1 = 0;$sum2 = 0;$sum3 = 0;$sum4 = 0;$sum5 = 0;$sum6 = 0;$sum7 = 0;$sum8 = 0; $sum =0;
	$sum1b = 0;$sum2b = 0;$sum3b = 0;$sum4b = 0;$sum5b = 0;$sum6b = 0;$sum7b = 0;$sum8b = 0; $sumb =0;
	$tanggal = '';
	// if($cek == TRUE ) {
	// 	$cash = 0;
	// 	$tf = 0;
	// } else {
	// 	$cash = $this->Pengeluaran_model->pendapatan_cash($tanggal1,$tanggal2);	
	// 	$tf = $this->Pengeluaran_model->pendapatan_tf($tanggal1,$tanggal2);
	// }
	 
	$pdf->Cell(20 ,0,'', 1,0,'C');
	$pdf->Cell(50 ,0,'', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(15 ,0,'Tunai', 1,0,'C');
	$pdf->Cell(15 ,0,'Bank', 1,0,'C');
	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->SetFont('times','',7);

	$pdf->Cell(20 ,0,'', 1,0,'C');
	$pdf->Cell(50 ,0,'', 1,0,'C');
	$pdf->Cell(15 ,0,number_format($saldo,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($saldo2,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(15 ,0,'', 1,0,'R');
	$pdf->Cell(189 ,0,'',0,1);//end of line

    foreach ($data2 as $u) {
		if($tanggal<>$u['tanggal']){
		$pdf->MultiCell(20 ,0,mediumdate_indo($u['tanggal']), 1, 'C', '', 0);
		} else {
		$pdf->MultiCell(20 ,0,'', 1, 'C', '', 0);
		}
		$pdf->Cell(50 ,0,$u['gramatur'].' '.$u['keterangan'],  1, 0, 'L');
		$jenis = $u['jenis'];
		if($jenis=='PENDAPATAN'){
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');

			if($u['pembayaran']=='Tunai'){
				$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R');
				$pdf->Cell(15 ,0,'', 1,0,'R');
				$sum1 = $sum1+$u['qty']*$u['harga'];
			 } else { 
			 	$pdf->Cell(15 ,0,'', 1,0,'R');
			 	$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R'); 
			 	$sum1b = $sum1b+$u['qty']*$u['harga'];
			 }
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,1,'R');
		} 
		elseif($jenis=='DIGITAL'){
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			if($u['pembayaran']=='Tunai'){
				$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R');
				$pdf->Cell(15 ,0,'', 1,0,'R');
				$sum2 = $sum2+$u['qty']*$u['harga'];
			 } else { 
			 	$pdf->Cell(15 ,0,'', 1,0,'R');
			 	$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R'); 
			 	$sum2b = $sum2b+$u['qty']*$u['harga'];
			 }

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,1,'R');
		} 
		elseif($jenis=='OFFSET'){
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			if($u['pembayaran']=='Tunai'){
				$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R');
				$pdf->Cell(15 ,0,'', 1,0,'R');
				$sum3 = $sum3+$u['qty']*$u['harga'];
			 } else { 
			 	$pdf->Cell(15 ,0,'', 1,0,'R');
			 	$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R'); 
			 	$sum3b = $sum3b+$u['qty']*$u['harga'];
			 }

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,1,'R');
		}
		elseif($jenis=='MERCHANDISE'){
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			if($u['pembayaran']=='Tunai'){
				$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R');
				$pdf->Cell(15 ,0,'', 1,0,'R');
				$sum4 = $sum4+$u['qty']*$u['harga'];
			 } else { 
			 	$pdf->Cell(15 ,0,'', 1,0,'R');
			 	$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R'); 
			 	$sum4b = $sum4b+$u['qty']*$u['harga'];
			 }

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,1,'R');
		}
		elseif($jenis=='RUMAH TANGGA'){
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			if($u['pembayaran']=='Tunai'){
				$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R');
				$pdf->Cell(15 ,0,'', 1,0,'R');
				$sum5 = $sum5+$u['qty']*$u['harga'];
			 } else { 
			 	$pdf->Cell(15 ,0,'', 1,0,'R');
			 	$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R'); 
			 	$sum5b = $sum5b+$u['qty']*$u['harga'];
			 }
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,1,'R');
		}
		elseif($jenis=='PRIVE'){
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');
			
			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');

			$pdf->Cell(15 ,0,'', 1,0,'R');
			$pdf->Cell(15 ,0,'', 1,0,'R');

			if($u['pembayaran']=='Tunai'){
				$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,0,'R');
				$pdf->Cell(15 ,0,'', 1,1,'R');
				$sum6 = $sum6+$u['qty']*$u['harga'];
			 } else { 
			 	$pdf->Cell(15 ,0,'', 1,0,'R');
			 	$pdf->Cell(15 ,0,number_format($u['qty']*$u['harga'],0,",","."), 1,1,'R'); 
			 	$sum6b = $sum6b+$u['qty']*$u['harga'];
			 }

		}
		$tanggal = $u['tanggal'];	
	}
	$pdf->SetFont('times','IB',8);


	
	$pdf->Cell(70 ,0,'TOTAL', 1,0,'C');
	$pdf->Cell(15 ,0,number_format($saldo,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($saldo2,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum1,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum1b,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum2,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum2b,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum3,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum3b,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum4,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum4b,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum5,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum5b,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum6,0,",","."), 1,0,'R');
	$pdf->Cell(15 ,0,number_format($sum6b,0,",","."), 1,0,'R');
	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->Cell(50 ,0,'SALDO AKHIR TUNAI :', 0,0,'R');
	$pdf->Cell(30 ,0,'Rp. '.number_format($saldo+$sum1-$sum2-$sum3-$sum4-$sum5-$sum6,0,",","."), 0,0,'R');
	$pdf->Cell(189 ,0,'',0,1);//end of line
	$pdf->Cell(50 ,0,'SALDO AKHIR BANK :', 0,0,'R');
	$pdf->Cell(30 ,0,'Rp. '.number_format($saldo2+$sum1b-$sum2b-$sum3b-$sum4b-$sum5b-$sum6b,0,",","."), 0,0,'R');

	// $pdf->MultiCell(20 ,4,'Rp. '.number_format($desen,0,",","."), 1, 'R', '', 0);
	// $pdf->MultiCell(25 ,4,'Rp. '.number_format($tagihan,0,",","."), 1, 'R', '', 1);
	$pdf->Output('pengeluaran_digital'.$tanggal1.'-'.$tanggal2.'.pdf', 'I');
?>
