<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->load->model('Auth_model');
        $this->load->library('Pdf');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Front Office")) {
            redirect('', 'refresh');
        }
    }

    public function index(){
        $count = $this->CRUD_model->nomorproduksi();
        $count2 = $this->CRUD_model->nomorpelanggan();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Produksi | '.$site['judul'],
            'site'                  => $site,
            'count'                 => $count,
            'countpelanggan'        => $count2
        );
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("y-m-d");
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->from('pelanggan');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);

        $this->db->select('*');
        $this->db->from('produksi a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->where('a.status !=', '1');
        $this->db->where('a.tanggal', $tanggal);
        $this->db->order_by('id_produksi', 'ASC');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->db->select('*');
        $this->db->from('jenis');
        $data4 = $this->db->get()->result_array();
        $data4 = array('data4' => $data4);  
        $this->template->load('layout/template', 'admin/produksi', array_merge($data, $data2, $data3,$data4));
    }
    public function inputproduksi(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("y-m-d");
        $sisa_tagihan = $this->input->post('total_tagihan')-$this->input->post('bayar');
        if ($sisa_tagihan < 1){
            $keterangan = 'LUNAS';
            $sisa_tagihan = 0;
            $data = array(
                'id_produksi' => $this->input->post('id_produksi'),
                'cicilan_ke' => 'DP',
                'nominal' => $this->input->post('total_tagihan'),
                'tanggal' => $tanggal,
                'pembayaran' => $this->input->post('pembayaran')
             );  
            $this->CRUD_model->Insert('detail_piutang', $data);
            
            $data = array(
                'id_produksi' => $this->input->post('id_produksi'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'total_tagihan' => $this->input->post('total_tagihan'),
                'sisa_tagihan' => $sisa_tagihan
             );  
            $this->CRUD_model->Insert('piutang', $data);
        } elseif ($sisa_tagihan>0) {
            $keterangan = 'UTANG';
            $data = array(
                'id_produksi' => $this->input->post('id_produksi'),
                'cicilan_ke' => 'DP',
                'nominal' => $this->input->post('bayar'),
                'tanggal' => $tanggal,
                'pembayaran' => $this->input->post('pembayaran')
             );  
            $this->CRUD_model->Insert('detail_piutang', $data);
            
            $data = array(
                'id_produksi' => $this->input->post('id_produksi'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'total_tagihan' => $this->input->post('total_tagihan'),
                'sisa_tagihan' => $sisa_tagihan
             );  
            $this->CRUD_model->Insert('piutang', $data);
        }
        $data = array(
            'id_produksi' => $this->input->post('id_produksi'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'pic' => $this->input->post('pic'),
            'biaya_design' => $this->input->post('biaya_design'),
            'username' => $this->session->userdata('username'),
            'diskon' => $this->input->post('diskon'),
            'tanggal' => $tanggal,
            'total_tagihan' => $this->input->post('total_tagihan'),
            'bayar' => $this->input->post('bayar'),
            'pembayaran' => $this->input->post('pembayaran'),
            'keterangan' => $keterangan
         );  
        $this->CRUD_model->Insert('produksi', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Berhasil melakukan order.</div>
        </div>
        </p>
        ');
        redirect('admin/produksi/invoice/'.$this->input->post('id_produksi'));       
    }
    public function inputpelanggan(){
        $data = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'nama' => $this->input->post('nama'),
            'cv' => $this->input->post('cv'),
            'broker' => $this->input->post('broker'),
            'cp' => $this->input->post('cp'),
            'alamat' => $this->input->post('alamat'),
            'status' => 1
         );  
        $this->CRUD_model->Insert('pelanggan', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pelanggan baru, '.$this->input->post('nama').' telah ditambahkan.</div>
        </div>
        </p>
        ');
        redirect('admin/produksi');       
    }
    public function order($id_pelanggan){
        $count = $this->CRUD_model->nomorproduksi();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Produksi | '.$site['judul'],
            'site'                  => $site,
            'count'                 => $count
        );
        $this->db->select('*');
        $this->db->where('id', $id_pelanggan);
        $this->db->from('pelanggan');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
          $gage=date('ymd');
          if($count==0){
            $nonota = $gage.'0001';
          }
          elseif($count<9){
            $count++;
            $nonota = $gage.'000'.$count;
          }
          elseif($count<99){
            $count++;
            $nonota = $gage.'00'.$count;
          }
          elseif($count<999){
            $count++;
            $nonota = $gage.'0'.$count;
          }
          elseif($count<9999){
            $count++;
            $nonota = $gage.$count;
          }
        $this->db->select('*');
        $this->db->where('id_produksi', $nonota);
        $this->db->from('detail_produksi');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);  
        $this->db->select('*');
        $this->db->from('jenis');
        $data4 = $this->db->get()->result_array();
        $data4 = array('data4' => $data4);        

        $this->template->load('layout/template', 'admin/produksi_order', array_merge($data, $data2, $data3, $data4));
    }
    public function edit_order($id_detail,$id_pelanggan){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Perbarui data order | '.$site['judul'],
            'site'                  => $site,
            'id_pelanggan'          => $id_pelanggan
        );
        $this->db->select('*');
        $this->db->from('jenis');
        $data4 = $this->db->get()->result_array();
        $data4 = array('data4' => $data4);
        $where = array('id' => $id_detail);
        $data2['data2'] = $this->CRUD_model->edit_data($where,'detail_produksi')->result();      
        $this->template->load('layout/template', 'admin/produksi_edit', array_merge($data, $data2, $data4));
    }

    public function invoice($id_produksi){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Invoice | '.$site['judul'],
            'site'                  => $site,
            'nama'                  => $site['nama'],
            'email'                 => $site['email'],
            'alamat'                => $site['alamat'],
            'phone'                 => $site['phone'],
            'norek'                 => $site['norek'],

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
        $this->db->from('detail_produksi');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);  
        $this->template->load('layout/template', 'admin/produksi_invoice', array_merge($data, $data2, $data3));
    }
    public function cetaknota($id_produksi){ 
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Cetak Nota '.$id_produksi. ' | '.$site['judul'],
            'site'                  => $site,
            'nama'                  => $site['nama'],
            'email'                 => $site['email'],
            'alamat'                => $site['alamat'],
            'phone'                 => $site['phone'],
            'norek'                 => $site['norek'],

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
        $this->db->from('detail_produksi');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);  
        $this->load->view('admin/produksi_nota', array_merge($data, $data2, $data3));
    }
    public function excel($id_produksi){ 
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Cetak Nota '.$id_produksi. ' | '.$site['judul'],
            'site'                  => $site,
            'nama'                  => $site['nama'],
            'email'                 => $site['email'],
            'alamat'                => $site['alamat'],
            'phone'                 => $site['phone'],
            'norek'                 => $site['norek'],

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
        $this->db->from('detail_produksi');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);  
        $this->load->view('admin/produksi_excel', array_merge($data, $data2, $data3));
        
    }
    public function excel2($id_produksi){ 
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Cetak Nota '.$id_produksi. ' | '.$site['judul'],
            'site'                  => $site,
            'nama'                  => $site['nama'],
            'email'                 => $site['email'],
            'alamat'                => $site['alamat'],
            'phone'                 => $site['phone'],
            'norek'                 => $site['norek'],

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
        $this->db->from('detail_produksi');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);  
        $this->load->view('admin/excel', array_merge($data, $data2, $data3));
        
    }
    public function tambah_order(){
        $data = array(
            'id_produksi' => $this->input->post('id_produksi'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_jenis' => $this->input->post('id_jenis'),
            'bahan' => $this->input->post('bahan'),
            'panjang' => $this->input->post('panjang'),
            'lebar' => $this->input->post('lebar'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga')
         );  
        $this->CRUD_model->Insert('detail_produksi', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>'.$this->input->post('deskripsi').' telah ditambahkan.</div>
        </div>
        </p>
        ');
        redirect('admin/produksi/order/'.$this->input->post('id'));       
    }
    public function delete_order($id_detail,$id_pelanggan){
        $id = array('id' => $id_detail);
        $this->CRUD_model->Delete('detail_produksi', $id);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-trash"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Berhasil menghapus daftar order.</div>
        </div>
        </p>
        ');
        redirect('admin/produksi/order/'.$id_pelanggan); 
    }
    public function perbarui_order(){   
        $data = array(
            'deskripsi' => $this->input->post('deskripsi'),
            'id_jenis' => $this->input->post('id_jenis'),
            'bahan' => $this->input->post('bahan'),
            'panjang' => $this->input->post('panjang'),
            'lebar' => $this->input->post('lebar'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga')
         ); 
        $where = array(
            'id' => $this->input->post('id'),
        );
        $data = $this->CRUD_model->Update('detail_produksi', $data, $where);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>'.$this->input->post('deskripsi').' telah diperbarui.</div>
        </div>
        </p>
        ');
        redirect('admin/produksi/order/'.$this->input->post('id_pelanggan')); 
    }
    public function cek_nota(){   
        $count = $this->CRUD_model->cek_order($this->input->post('id_produksi'));
        if($count==1){
        redirect('admin/produksi/invoice/'.$this->input->post('id_produksi')); 
        } else {
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info">
        <div class="info-box-icon">
        <i class="fa fa-close"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br>Nomor nota '.$this->input->post('id_produksi').' tidak ditemukan.</div>
        </div>
        </p>
        ');
        redirect('admin/produksi');         
        }
    }
    public function cancel_order(){
        $id_produksi = $this->input->post('id_produksi');
        $count = $this->CRUD_model->cek_order($this->input->post('id_produksi'));
        if($count>0){
            $data = array('status' => '1'); 
            $where = array('id_produksi' => $id_produksi);
            $data = $this->CRUD_model->Update('produksi', $data, $where);
            $id = array('id_produksi' => $id_produksi);
            $this->CRUD_model->Delete('piutang', $id);
            $this->CRUD_model->Delete('detail_produksi', $id);
            $this->CRUD_model->Delete('detail_piutang', $id);
            $this->session->set_flashdata('alert', '<p class="box-msg">
            <div class="info-box alert-danger">
            <div class="info-box-icon">
            <i class="fa fa-trash"></i>
            </div>
            <div class="info-box-content" style="font-size:14">
            <b style="font-size: 20px">INFO</b><br>Order '.$id_produksi.' telah dibatalkan.</div>
            </div>
            </p>
            ');
            redirect('admin/produksi'); 
        } else {
            $this->session->set_flashdata('alert', '<p class="box-msg">
            <div class="info-box alert-info">
            <div class="info-box-icon">
            <i class="fa fa-info"></i>
            </div>
            <div class="info-box-content" style="font-size:14">
            <b style="font-size: 20px">INFO</b><br>Nomor nota '.$id_produksi.' tidak ditemukan.</div>
            </div>
            </p>
            ');
            redirect('admin/produksi');   

        }
    }
    public function cetaknow(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Produksi hari ini | '.$site['judul'],
            'site'                  => $site
        );
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("y-m-d");

        $this->db->select('*');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->join('pelanggan c', 'c.id_pelanggan = b.id_pelanggan','left');
        $this->db->where('b.status !=', '1');
        $this->db->where('b.tanggal', $tanggal);
        $this->db->order_by('a.id_produksi', 'ASC');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/produksi_now', array_merge($data, $data3));
    }

    public function laporan(){
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $id_jenis = $this->input->get('id_jenis');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Produksi hari ini | '.$site['judul'],
            'site'                  => $site,
            'tanggal1'              => $tanggal1,
            'tanggal2'              => $tanggal2,
            'id_jenis'              => $id_jenis
        );

        $this->db->select('*');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->join('pelanggan c', 'c.id_pelanggan = b.id_pelanggan','left');
        $this->db->join('jenis d', 'd.id_jenis = a.id_jenis','left');
        $this->db->where('b.status !=', '1');
        $this->db->where('b.tanggal <=', $tanggal2);
        $this->db->where('b.tanggal >=', $tanggal1); 
        if($id_jenis!=0){
           $this->db->where('a.id_jenis', $id_jenis);  
        }
        $this->db->order_by('a.id_produksi', 'ASC');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/produksi_laporan', array_merge($data, $data3));
    }
    
}
