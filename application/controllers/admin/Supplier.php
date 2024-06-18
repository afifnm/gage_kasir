<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
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
            'title'                 => 'Data Supplier | '.$site['judul'],
            'site'                  => $site,
            'count'                 => $count
        );
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->from('supplier');
        $this->db->order_by('sup','ASC');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/supplier', array_merge($data,$data2));
    }

    public function input(){
        $data = array(
            'sup' => $this->input->post('nama'),
            'jenis' => '',
            'status' => 1
         );  
        $this->CRUD_model->Insert('supplier', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success"><div class="info-box-icon"><i class="fa fa-check"></i></div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Supplier baru, '.$this->input->post('nama').' telah ditambahkan.</div></div></p> ');
        redirect('admin/supplier');       
    }

    public function hapus($id){
        $where = array(
            'id_sup' => $id
        );
        $data = array(
            'status' => 0
         );  
        $data = $this->CRUD_model->Update('supplier', $data, $where);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-info"><div class="info-box-icon"><i class="fa fa-info-circle"></i></div><div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">INFO</b><br> Data supplier telah dihapus.</div></div></p>');
        redirect('admin/supplier/');
    }
    public function editdata($id){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Perbarui Data Supplier | '.$site['judul'],
        );
        $where = array('id_sup' => $id);
        $data2['supplier'] = $this->CRUD_model->edit_data($where,'supplier')->result();
        $this->template->load('layout/template', 'admin/supplier_edit', array_merge($data, $data2));
    }
    public function updatedata(){   
        $data = array(
            'sup' => $this->input->post('nama'),
            'jenis' => '',
         ); 
        $where = array(
            'id_sup' => $this->input->post('id_sup'),
        );
        $data = $this->CRUD_model->Update('supplier', $data, $where);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br> Supplier, '.$this->input->post('nama').' telah diperbarui.</div>
        </div>
        </p>
        ');
        redirect('admin/supplier');
    }
}
