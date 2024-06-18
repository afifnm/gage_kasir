<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CRUD_model extends CI_Model{

 	public function GetWhere($table){
        $res=$this->db->get($table); // Kode ini berfungsi untuk memilih tabel yang akan ditampilkan
        return $res->result_array(); // Kode ini digunakan untuk mengembalikan hasil operasi $res menjadi sebuah array
    }
    public function edit_data($where,$table){      
        return $this->db->get_where($table,$where);
    }

    public function nomorpelanggan(){
        $this->db->select('*');
        $this->db->from('pelanggan');
        return $this->db->count_all_results();
    }
    public function nomorproduksi(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('*');
        $this->db->from('produksi');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        return $this->db->count_all_results();
    }

    public function produksi_jenis($id_jenis){
        date_default_timezone_set("Asia/Jakarta");
        $bulan = date("Y-m");
        $this->db->select('sum(a.panjang*a.lebar*a.harga*a.jumlah) as total');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->where('a.id_jenis', $id_jenis); 
        $this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m')", $bulan);
        return $this->db->get()->row()->total;
    }

    public function omset_harini(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->db->select('sum(a.panjang*a.lebar*a.harga*a.jumlah) as total');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m-%d')", $tanggal);
        return $this->db->get()->row()->total;
    }

    public function omset_bulan(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(a.panjang*a.lebar*a.harga*a.jumlah) as total');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m')", $tanggal);
        return $this->db->get()->row()->total;
    }

    public function biayadesenhari(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->db->select('sum(biaya_design) as total');
        $this->db->from('produksi');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $this->db->where("status !=", 1);
        return $this->db->get()->row()->total;
    }

    public function biayadesenbulan(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(biaya_design) as total');
        $this->db->from('produksi');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("status !=", 1);
        return $this->db->get()->row()->total;
    }

    public function total_tagihan2(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(total_tagihan) as total');
        $this->db->from('produksi');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("status !=", 1);
        return $this->db->get()->row()->total;
    }

    public function produksi($id_produksi){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("y-m-d");
        $this->db->select('*');
        $this->db->from('produksi a');
        $this->db->join('pelanggan b', 'b.id_pelanggan = a.id_pelanggan','left');
        $this->db->join('piutang c', 'c.id_produksi = a.id_produksi','left');
        $this->db->where('a.id_produksi', $id_produksi); 
        $this->db->where("a.status !=", 1);
        return $this->db->count_all_results();
    }
    public function cek_order($id_produksi){
        $this->db->select('*');
        $this->db->from('produksi');
        $this->db->where('id_produksi', $id_produksi); 
        $this->db->where('status', 0); 
        return $this->db->count_all_results();
    }
    public function total_tagihan($id_pelanggan){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('SUM(total_tagihan) as total');
        $this->db->from('produksi');
        $this->db->where('id_pelanggan', $id_pelanggan); 
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("status !=", 1);
        return $this->db->get()->row()->total;
    }
    public function cek_cicilan($id_produksi){
        $this->db->select('*');
        $this->db->from('detail_piutang');
        $this->db->where('id_produksi', $id_produksi); 
        return $this->db->count_all_results();
    }
    public function Insert($table,$data){
        $res = $this->db->insert($table, $data); // Kode ini digunakan untuk memasukan record baru kedalam sebuah tabel
        return $res; // Kode ini digunakan untuk mengembalikan hasil $res
    }
 
    public function Update($table, $data, $where){
        $res = $this->db->update($table, $data, $where); // Kode ini digunakan untuk merubah record yang sudah ada dalam sebuah tabel
        return $res;
    }
 
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }
    public function produksi_bahan($bahan,$id_jenis){
        date_default_timezone_set("Asia/Jakarta");
        $bulan = date("Y-m");
        $this->db->select('sum(a.panjang*a.lebar*a.jumlah) as total');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->where('a.id_jenis', $id_jenis); 
        $this->db->where('a.bahan', $bahan); 
        $this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m')", $bulan);
        return $this->db->get()->row()->total;
    }
    public function produksi_bahan2($bahan,$id_jenis){
        date_default_timezone_set("Asia/Jakarta");
        $bulan = date("Y-m-d");
        $this->db->select('sum(a.panjang*a.lebar*a.jumlah) as total');
        $this->db->from('detail_produksi a');
        $this->db->join('produksi b', 'b.id_produksi = a.id_produksi','left');
        $this->db->where('a.id_jenis', $id_jenis); 
        $this->db->where('a.bahan', $bahan); 
        $this->db->where("DATE_FORMAT(b.tanggal,'%Y-%m-%d')", $bulan);
        return $this->db->get()->row()->total;
    }
//--------------------------------------------------------------------------------------------
    public function pendapatanhari_cash(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->db->select('sum(nominal) as total');
        $this->db->from('detail_piutang');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $this->db->where("pembayaran", 'Tunai');
        return $this->db->get()->row()->total;
    }

    public function pendapatanhari_tf(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->db->select('sum(nominal) as total');
        $this->db->from('detail_piutang');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $this->db->where("pembayaran !=", 'Tunai');
        return $this->db->get()->row()->total;
    }

    public function pendapatanbulan_cash(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(nominal) as total');
        $this->db->from('detail_piutang');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("pembayaran", 'Tunai');
        return $this->db->get()->row()->total;
    }

    public function pendapatanbulan_tf(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(nominal) as total');
        $this->db->from('detail_piutang');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("pembayaran !=", 'Tunai');
        return $this->db->get()->row()->total;
    }

//--------------------------------------------------------------------------------------------
    public function pengeluaranhari_cash(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->db->select('sum(qty*harga) as total');
        $this->db->from('pengeluaran');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $this->db->where("pembayaran", 'Tunai');
        $this->db->group_start();
        $this->db->or_where("jenis", 'DIGITAL');
        $this->db->or_where("jenis", 'OFFSET');
        $this->db->or_where("jenis", 'MERCHANDISE');
        $this->db->or_where("jenis", 'RUMAH TANGGA');
        $this->db->group_end();
        return $this->db->get()->row()->total;
    }

    public function pengeluaranhari_tf(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->db->select('sum(qty*harga) as total');
        $this->db->from('pengeluaran');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $this->db->where("pembayaran", 'Bank');
        $this->db->group_start();
        $this->db->or_where("jenis", 'DIGITAL');
        $this->db->or_where("jenis", 'OFFSET');
        $this->db->or_where("jenis", 'MERCHANDISE');
        $this->db->or_where("jenis", 'RUMAH TANGGA');
        $this->db->group_end();
        return $this->db->get()->row()->total;
    }

    public function pengeluaranbulan_cash(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(qty*harga) as total');
        $this->db->from('pengeluaran');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("pembayaran", 'Tunai');
        $this->db->group_start();
        $this->db->or_where("jenis", 'DIGITAL');
        $this->db->or_where("jenis", 'OFFSET');
        $this->db->or_where("jenis", 'MERCHANDISE');
        $this->db->or_where("jenis", 'RUMAH TANGGA');
        $this->db->group_end();
        return $this->db->get()->row()->total;
    }

    public function pengeluaranbulan_tf(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m");
        $this->db->select('sum(qty*harga) as total');
        $this->db->from('pengeluaran');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $this->db->where("pembayaran", 'Bank');
        $this->db->group_start();
        $this->db->or_where("jenis", 'DIGITAL');
        $this->db->or_where("jenis", 'OFFSET');
        $this->db->or_where("jenis", 'MERCHANDISE');
        $this->db->or_where("jenis", 'RUMAH TANGGA');
        $this->db->group_end();
        return $this->db->get()->row()->total;
    }
}
