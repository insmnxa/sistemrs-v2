<?php

class Penjualan_model extends CI_Model
{
    public $id;
    public $id_resep;
    public $dibayar;
    public $kembali;

    private $_table = 'penjualan';

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
