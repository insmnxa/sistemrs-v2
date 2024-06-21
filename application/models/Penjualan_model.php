<?php

class Penjualan_model extends CI_Model
{
    public $id;
    public $id_resep;
    public $dibayar;
    public $kembali;

    private $_table = 'penjualan';

    public function get_penjualan(string $id = '')
    {
        if (!empty($id)) {
            $this->db->select('penjualan.*, resep.total_harga r_th, resep.status r_s, pasien.nama p_n');
            $this->db->from('penjualan');
            $this->db->join('resep', 'resep.id = penjualan.id_resep');
            $this->db->join('pasien', 'pasien.id = resep.id_pasien');
            $this->db->where('id', $id);

            $query = $this->db->get();
            return $query->result();
        }

        $this->db->select('penjualan.*, resep.total_harga r_th, resep.status r_s, pasien.nama p_n');
        $this->db->from('penjualan');
        $this->db->join('resep', 'resep.id = penjualan.id_resep');
        $this->db->join('pasien', 'pasien.id = resep.id_pasien');

        $query = $this->db->get();
        return $query->result();
    }

    public function filter_sellings_by_date(string $date)
    {
        $this->db->select('penjualan.*, resep.id r_i, resep.total_harga r_th, resep.status r_s, pasien.nama p_n');
        $this->db->from('penjualan');
        $this->db->join('resep', 'resep.id = penjualan.id_resep');
        $this->db->join('pasien', 'pasien.id = resep.id_pasien');
        $this->db->like('resep.dibuat_pada', $date);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_transactions_by_date(string $date)
    {
        $this->db->select_sum('r.total_harga');
        $this->db->from('resep r');
        $this->db->join('penjualan p', 'p.id_resep = r.id');
        $this->db->where('DATE(r.dibuat_pada)', $date);

        $query = $this->db->get();
        return $query->row();
    }

    public function store(float $dibayar, $kembali, string $id_resep)
    {
        $this->id = uniqid('SLG-');
        $this->id_resep = $id_resep;
        $this->dibayar = $dibayar;
        $this->kembali = $kembali;

        $this->db->insert($this->_table, $this);
        $this->db->update('resep', ['status' => 'lunas'], ['id' => $id_resep]);
    }
}
