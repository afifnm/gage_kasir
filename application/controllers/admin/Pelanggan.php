<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->load->library('Pdf');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Front Office")) {
            redirect('', 'refresh');
        }
    }

    public function broker(){
        $count = $this->CRUD_model->nomorpelanggan();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Pelanggan Broker| '.$site['judul'],
            'site'                  => $site,
            'pelanggan'             => 'Broker',
            'count'                 => $count
        );
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->where('broker', 'Broker');
        $this->db->from('pelanggan');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pelanggan_index', array_merge($data,$data2));
    }
    public function non(){
        $count = $this->CRUD_model->nomorpelanggan();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Pelanggan Non Broker| '.$site['judul'],
            'site'                  => $site,
            'pelanggan'             => 'Non Broker',
            'count'                 => $count
        );
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->where('broker', 'Non Broker');
        $this->db->from('pelanggan');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pelanggan_index', array_merge($data,$data2));
    }
    public function pajak(){
        $count = $this->CRUD_model->nomorpelanggan();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Pelanggan Kena Pajak | '.$site['judul'],
            'site'                  => $site,
            'pelanggan'             => 'Kena Pajak',
            'count'                 => $count
        );
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->where('broker', 'Pajak');
        $this->db->from('pelanggan');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/pelanggan_index', array_merge($data,$data2));
    }
    public function cetak(){
        $alamat = $this->input->get('alamat');
        $broker = $this->input->get('broker');
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Pelanggan | '.$site['judul'],
            'site'                  => $site
        );

        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->from('pelanggan');
        $this->db->like('alamat', $alamat);
        if($broker==1){
           $this->db->where('broker', 'Broker');  
        }
        if($broker==2){
           $this->db->where('broker', 'Non Broker');  
        }
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/pelanggan_print', array_merge($data, $data3));
    }
    
    public function input(){
        $data = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'nama' => $this->input->post('nama'),
            'cv' => $this->input->post('cv'),
            'cp' => $this->input->post('cp'),
            'broker' => $this->input->post('broker'),
            'alamat' => $this->input->post('alamat'),
            'status' => 1
         );  
        $this->CRUD_model->Insert('pelanggan', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success"><div class="info-box-icon"><i class="fa fa-check"></i></div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Pelanggan baru, '.$this->input->post('nama').' telah ditambahkan.</div></div></p> ');
        redirect('admin/pelanggan');       
    }
    public function hapus($id){
        $where = array(
            'id' => $id
        );
        $data = array(
            'status' => 0
         );  
        $data = $this->CRUD_model->Update('pelanggan', $data, $where);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Data pelanggan telah dihapus.</div></div></p>');
        redirect('admin/pelanggan/');
    }
    public function editdata($id){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Perbarui Data Pelanggan | '.$site['judul'],
        );
        $where = array('id' => $id);
        $data2['pelanggan'] = $this->CRUD_model->edit_data($where,'pelanggan')->result();
        $this->template->load('layout/template', 'admin/pelanggan_edit', array_merge($data, $data2));
    }
    public function updatedata(){   
        $data = array(
            'nama' => $this->input->post('nama'),
            'cv' => $this->input->post('cv'),
            'alamat' => $this->input->post('alamat'),
            'broker' => $this->input->post('broker'),
            'cp' => $this->input->post('cp')
         ); 
        $where = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
        );
        $data = $this->CRUD_model->Update('pelanggan', $data, $where);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br> Biodata profil, '.$this->input->post('nama').' telah diperbarui.</div>
        </div>
        </p>
        ');
        redirect('admin/pelanggan');
    }
    public function transaksi($id_pelanggan){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Pelanggan | '.$site['judul'],
            'site'                  => $site
        );
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);

        $this->db->select('*');
        $this->db->from('produksi a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->join('piutang c', 'c.id_produksi = a.id_produksi','left');
        $this->db->where('a.id_pelanggan', $id_pelanggan);
        $this->db->where('a.status !=', '1');
        $this->db->order_by('a.tanggal', 'DESC');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/pelanggan_transaksi', array_merge($data, $data2, $data3));
    }
}
