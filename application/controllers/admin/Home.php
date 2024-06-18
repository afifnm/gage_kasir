<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Front Office")) {
            redirect('', 'refresh');
        }
    }

    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Dashboard | '.$site['judul'],
            'site'                  => $site,
        );
        $this->db->select('*');
        $this->db->from('jenis');
        $data3 = $this->db->get()->result_array();
        $data3 = array('data3' => $data3);
        $this->template->load('layout/template', 'admin/dashboard', array_merge($data,$data3));
    }
}
 