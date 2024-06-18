<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->load->model('Pengeluaran_model');
        $this->load->model('Auth_model');
        $this->load->library('Pdf');
        $this->check_login();
        if ($this->session->userdata('level') != "Admin") {
            redirect('', 'refresh');
        }
    }

    public function laporan(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        // $tanggal1 = '2019-05-1';
        // $tanggal2 = '2019-05-28';
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran | '.$site['judul'],
            'site'                  => $site,
            'saldo'                 => $site['saldo'],
            'saldo2'                 => $site['saldo2'],
            'cek'                   => $this->input->post('cek'),
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan($tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/laporan', array_merge($data, $data2));
    }

    public function digital(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran Digital | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('DIGITAL');
        $data2 = array('data2' => $data2);

        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->where('jenis','DIGITAL');
        $this->db->where('status',1);
        $this->db->order_by('sup','ASC');
        $data4 = $this->db->get()->result_array();
        $data4 = array('data4' => $data4); 
        $this->template->load('layout/template', 'admin/pengeluaran/digital', array_merge($data, $data2, $data4));
    }

    public function digital_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran Digital | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran('DIGITAL',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/digital_cetak', array_merge($data, $data2));
    }

    public function digital_input(){
        $data = array(
            'jenis' => 'DIGITAL',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => $this->input->post('gramatur'),
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => $this->input->post('id_sup'),
            'qty' => $this->input->post('qty'),
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('gramatur').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/digital');       
    }
    public function digital_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/digital');
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function offset(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran Offset | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran2('OFFSET');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/offset', array_merge($data, $data2));
    }
    public function offset_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran Offset | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran2('OFFSET',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/offset_cetak', array_merge($data, $data2));
    }
    public function offset_input(){
        $data = array(
            'jenis' => 'OFFSET',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => $this->input->post('gramatur'),
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => $this->input->post('id_sup'),
            'qty' => $this->input->post('qty'),
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('gramatur').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/offset');       
    }
    public function offset_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/offset');
    } 

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function merchandise(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran Merchandise | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran2('merchandise');
        $data2 = array('data2' => $data2);

        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->where('jenis','MERCHANDISE');
        $this->db->where('status',1);
        $this->db->order_by('sup','ASC');
        $data4 = $this->db->get()->result_array();
        $data4 = array('data4' => $data4); 
        $this->template->load('layout/template', 'admin/pengeluaran/merchandise', array_merge($data, $data2, $data4));
    }
    public function merchandise_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran Merchandise | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran2('MERCHANDISE',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/merchandise_cetak', array_merge($data, $data2));
    }
    public function merchandise_input(){
        $data = array(
            'jenis' => 'MERCHANDISE',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => $this->input->post('gramatur'),
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => $this->input->post('id_sup'),
            'qty' => $this->input->post('qty'),
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('gramatur').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/merchandise');       
    }
    public function merchandise_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/merchandise');
    }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function rm(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran Rumah Tangga | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('RUMAH TANGGA');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/rm', array_merge($data, $data2));
    }
    public function rm_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran Rumah Tangga | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran('RUMAH TANGGA',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/rm_cetak', array_merge($data, $data2));
    }
    public function rm_input(){
        $data = array(
            'jenis' => 'RUMAH TANGGA',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => $this->input->post('gramatur'),
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => '-',
            'qty' => $this->input->post('qty'),
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('gramatur').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/rm');       
    }
    public function rm_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/rm');
    } 

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function prive(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran Prive | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('PRIVE');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/prive', array_merge($data, $data2));
    }
    public function prive_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran Prive | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran('PRIVE',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/prive_cetak', array_merge($data, $data2));
    }
    public function prive_input(){
        $data = array(
            'jenis' => 'PRIVE',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => '',
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => '-',
            'qty' => '1',
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('keterangan').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/prive');       
    }
    public function prive_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/prive');
    } 

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function lain(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran Prive | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('LAIN');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/lain', array_merge($data, $data2));
    }
    public function lain_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran Lain-lain | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran('LAIN',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/lain_cetak', array_merge($data, $data2));
    }
    public function lain_input(){
        $data = array(
            'jenis' => 'LAIN',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => '',
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => '-',
            'qty' => '1',
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('keterangan').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/lain');       
    }
    public function lain_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/lain');
    } 


    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function maintenance(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran maintenance | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('MAINTENANCE');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/maintenance', array_merge($data, $data2));
    }
    public function maintenance_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran maintenance | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran('MAINTENANCE',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/maintenance_cetak', array_merge($data, $data2));
    }
    public function maintenance_input(){
        $data = array(
            'jenis' => 'MAINTENANCE',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => '',
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => '-',
            'qty' => '1',
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('keterangan').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/maintenance');       
    }
    public function maintenance_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/maintenance');
    } 


        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function zakat(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pengeluaran zakat | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('ZAKAT');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/zakat', array_merge($data, $data2));
    }
    public function zakat_cetak(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Laporan Pengeluaran zakat | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2
        );
        $data2 = $this->Pengeluaran_model->laporan_pengeluaran('ZAKAT',$tanggal1,$tanggal2);
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/zakat_cetak', array_merge($data, $data2));
    }
    public function zakat_input(){
        $data = array(
            'jenis' => 'ZAKAT',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => '',
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => '-',
            'qty' => '1',
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pengeluaran, '.$this->input->post('keterangan').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/zakat');       
    }
    public function zakat_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pengeluaran telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/zakat');
    } 


        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function pendapatan(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'PENDAPATAN | '.$site['judul'],
            'site'                  => $site
        );
        $data2 = $this->Pengeluaran_model->pengeluaran('PENDAPATAN');
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pengeluaran/pendapatan', array_merge($data, $data2));
    }

    public function pendapatan_input(){
        $data = array(
            'jenis' => 'PENDAPATAN',
            'tanggal' => $this->input->post('tanggal'),
            'gramatur' => '',
            'keterangan' => $this->input->post('keterangan'),
            'id_sup' => '-',
            'qty' => '1',
            'harga' => $this->input->post('harga'),
            'pembayaran' => $this->input->post('pembayaran')
         );  
        $this->CRUD_model->Insert('pengeluaran', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg"><div class="info-box alert-success">
        <div class="info-box-icon"><i class="fa fa-check"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pendapatan, '.$this->input->post('keterangan').' telah ditambahkan.</div>
        </div></p>');
        redirect('admin/pengeluaran/pendapatan');       
    }
    public function pendapatan_hapus($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('pengeluaran', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Pendapatan telah dihapus.</div></div></p>');
        redirect('admin/pengeluaran/pendapatan');
    } 


}