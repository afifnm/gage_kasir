<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Piutang extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->library('Pdf');
        $this->load->model('CRUD_model');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Front Office")) {
            redirect('', 'refresh');
        }
    }

    public function index(){
        $count = $this->CRUD_model->nomorpelanggan();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Piutang | '.$site['judul'],
            'site'                  => $site,
            'count'                 => $count
        );
        $this->db->select('*');
        $this->db->from('piutang a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->where('a.sisa_tagihan >', 0);
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/piutang_index', array_merge($data, $data3));
    }
    public function cetak1(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2'); 
        $kategori = $this->input->get('kategori');
        // $tanggal1 = '2019-05-1';
        // $tanggal2 = '2019-05-28';
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Piutang | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2,
            'kategori'              => $kategori
        );
        $this->db->select('*');
        $this->db->from('piutang a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->join('produksi c', 'c.id_produksi = a.id_produksi','left');
        $this->db->where('c.tanggal <=', $tanggal2);
        $this->db->where('c.tanggal >=', $tanggal1); 
        if ($kategori==1) {
            $this->db->where('a.sisa_tagihan <=', 0); 
        } elseif ($kategori==2) {
            $this->db->where('a.sisa_tagihan >', 0); 
        }
        $this->db->order_by('c.id_produksi', 'ASC'); 
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/piutang_cetak', array_merge($data, $data3));
    }

    public function cetak2(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $kategori = $this->input->get('kategori');
        // $tanggal1 = '2019-05-1';
        // $tanggal2 = '2019-05-28';
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Piutang | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2,
            'kategori'              => $kategori
        );
        $this->db->select('*');
        $this->db->from('detail_piutang a');
        $this->db->join('piutang b', 'b.id_produksi = a.id_produksi','left');
        $this->db->join('pelanggan c', 'c.id_pelanggan = b.id_pelanggan','left');
        $this->db->where('a.tanggal <=', $tanggal2);
        $this->db->where('a.tanggal >=', $tanggal1); 
        if ($kategori==1) {
            $this->db->where('a.sisa_tagihan <=', 0); 
        } elseif ($kategori==2) {
            $this->db->where('a.sisa_tagihan >', 0); 
        }
        $this->db->order_by('a.id_produksi', 'ASC'); 
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/piutang_cetakpembayaran', array_merge($data, $data3));
    }

    public function cetak3(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $kategori = $this->input->get('kategori');
        // $tanggal1 = '2019-05-1';
        // $tanggal2 = '2019-05-28';
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Piutang | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2,
            'kategori'              => $kategori
        );
        $this->db->select('*');
        $this->db->from('piutang a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->join('produksi c', 'c.id_produksi = a.id_produksi','left');
        $this->db->where('c.tanggal <=', $tanggal2);
        $this->db->where('c.tanggal >=', $tanggal1); 
        if ($kategori==1) {
            $this->db->where('a.sisa_tagihan <=', 0); 
        } elseif ($kategori==2) {
            $this->db->where('a.sisa_tagihan >', 0); 
        }
        $this->db->order_by('a.id_produksi', 'ASC'); 
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/piutang_cetakcicilan', array_merge($data, $data3));
    }

     public function cicilan($id_produksi){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Detail Cicilan Piutang | '.$site['judul'],
            'site'                  => $site
        );
        $this->db->select('*');
        $this->db->from('produksi a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->join('piutang c', 'c.id_produksi = a.id_produksi','left');
        $this->db->where('a.id_produksi', $id_produksi); 
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2); 

        $this->db->select('*');
        $this->db->where('id_produksi', $id_produksi);
        $this->db->from('detail_piutang');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);  
        $this->template->load('layout/template', 'admin/piutang_cicilan', array_merge($data, $data2, $data3));
    }
    public function bayarpiutang(){   
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("y-m-d");
        $sisa_tagihan = $this->input->post('sisa_tagihan')-$this->input->post('nominal');
        if($sisa_tagihan<1){ $sisa_tagihan = 0; }
        $data = array('sisa_tagihan' => $sisa_tagihan); 
        $where = array('id_produksi' => $this->input->post('id_produksi'));
        $data = $this->CRUD_model->Update('piutang', $data, $where);
        $count = $this->CRUD_model->cek_cicilan($this->input->post('id_produksi'));
        if($sisa_tagihan>0){
            $data = array(
                'id_produksi' => $this->input->post('id_produksi'),
                'cicilan_ke' => $count,
                'nominal' => $this->input->post('nominal'),
                'tanggal' => $tanggal,
                'pembayaran' => $this->input->post('pembayaran')
             );  
            $this->CRUD_model->Insert('detail_piutang', $data);
            $this->session->set_flashdata('alert', '<p class="box-msg">
            <div class="info-box alert-success">
            <div class="info-box-icon">
            <i class="fa fa-check"></i>
            </div>
            <div class="info-box-content" style="font-size:14">
            <b style="font-size: 20px">SUCCESS</b><br> Pembayaran piutang berhasil dilakukan.</div>
            </div>
            </p>
            ');
            redirect('admin/piutang');            
        } else {
             $data = array(
                'id_produksi' => $this->input->post('id_produksi'),
                'cicilan_ke' => $count,
                'nominal' => $this->input->post('sisa_tagihan'),
                'tanggal' => $tanggal,
                'pembayaran' => $this->input->post('pembayaran')
             );  
            $this->CRUD_model->Insert('detail_piutang', $data);
            $this->session->set_flashdata('alert', '<p class="box-msg">
            <div class="info-box alert-success">
            <div class="info-box-icon">
            <i class="fa fa-check"></i>
            </div>
            <div class="info-box-content" style="font-size:14">
            <b style="font-size: 20px">SUCCESS</b><br> Piutang telah dilunasi.</div>
            </div>
            </p>
            ');
            redirect('admin/piutang');    
        }

    }
}
