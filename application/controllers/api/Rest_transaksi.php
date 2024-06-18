<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Rest_transaksi extends RestController
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
				date_default_timezone_set("Asia/Jakarta");
				$tanggal = date("Y-m");
				$this->db->select('sum(a.panjang*a.lebar*a.harga*a.jumlah) as total');
				$this->db->from('detail_produksi a');
				$this->db->join('produksi b', 'b.id_produksi = a.id_produksi', 'left');
				$this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m')", $tanggal);
				$total =  $this->db->get()->row()->total;
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

	public function omsetharian_post()
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
				date_default_timezone_set("Asia/Jakarta");
				$tanggal = date("Y-m-d");
				$this->db->select('sum(a.panjang*a.lebar*a.harga*a.jumlah) as total');
				$this->db->from('detail_produksi a');
				$this->db->join('produksi b', 'b.id_produksi = a.id_produksi', 'left');
				$this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m-%d')", $tanggal);
				$total = $this->db->get()->row()->total;
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

	public function desain_post()
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
				date_default_timezone_set("Asia/Jakarta");
				$tanggal = date("Y-m");
				$this->db->select('sum(biaya_design) as total');
				$this->db->from('produksi');
				$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
				$this->db->where("status !=", 1);
				$total = $this->db->get()->row()->total;
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

	public function desainharian_post()
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
				date_default_timezone_set("Asia/Jakarta");
				$tanggal = date("Y-m-d");
				$this->db->select('sum(biaya_design) as total');
				$this->db->from('produksi');
				$this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
				$this->db->where("status !=", 1);
				$total = $this->db->get()->row()->total;
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

	public function total_post()
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
				date_default_timezone_set("Asia/Jakarta");
				$tanggal = date("Y-m");
				$this->db->select('sum(total_tagihan) as total');
				$this->db->from('produksi');
				$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
				$this->db->where("status !=", 1);
				$total = $this->db->get()->row()->total;
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
