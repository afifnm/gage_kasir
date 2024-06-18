<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Rest_dataproduksi extends RestController
{
	public function __construct()
	{
		parent::__construct();
	}


	public function index_post()
	{
		$password = $this->post('password');

		if ($password === null) {
			$this->response([
				'status' => true,
				'value' => 0,
				'message' => 'Password Tidak Boleh Kosong'
			],  RestController::HTTP_NOT_FOUND);
		} else {
			$asli = 'lestari12';
			if ($password == $asli) {
				$this->db->where('tanggal', date('Y-m-d'));
				$this->db->where('status !=', 1);
				$hasil = $this->db->get('produksi')->result_array();
				$nomor = 1;
				$arraykosong = [];
				foreach ($hasil as $h) {
				    $nama[$nomor] = $this->db->get_where('pelanggan', ['id_pelanggan' => $h['id_pelanggan']])->row_array();
					$prdks[$nomor] = [
						'nota' => $h['id_produksi'],
						'nama' => $nama[$nomor]['nama'],
					];
					array_push($arraykosong, $prdks[$nomor]);
					$nomor++;
				}
				$total = $arraykosong;
				$this->response([
					'status' => true,
					'value' => 1,
					'data' => $total
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => true,
					'value' => 0,
					'message' => 'Password Salah'
				],  RestController::HTTP_NOT_FOUND);
			}
		}
	}
	
	public function detailproduksi_post()
	{
		$password = $this->post('password');
		$nota = $this->post('nota');

		if ($password === null) {
			$this->response([
				'status' => true,
				'value' => 0,
				'message' => 'Password Tidak Boleh Kosong'
			],  RestController::HTTP_NOT_FOUND);
		} else {
			$asli = 'lestari12';
			if ($password == $asli) {
				$hasil = $this->db->get_where('detail_produksi', ['id_produksi' => $nota])->result_array();
				$nomor = 1;
				$arraykosong = [];
				foreach ($hasil as $h) {
					$prdks = [
						'deskripsi' => $h['deskripsi'],
						'pl' => $h['panjang'] . '&nbsp;X&nbsp;' . $h['lebar'],
						'bahan' => $h['bahan'],
						'harga' => $h['harga'],
						'jumlah' => $h['jumlah'],
						'akhir' => $h['jumlah'] * $h['harga'] * $h['panjang'] * $h['lebar'],
					];
					array_push($arraykosong, $prdks);
					$nomor++;
				}
				$total = $arraykosong;
				$this->response([
					'status' => true,
					'value' => 1,
					'data' => $total
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => true,
					'value' => 0,
					'message' => 'Password Salah'
				],  RestController::HTTP_NOT_FOUND);
			}
		}
	}
}
