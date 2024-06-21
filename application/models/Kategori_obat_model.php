<?php

class Kategori_obat_model extends CI_Model
{
    public $id;
    public $nama;

    private $_table = 'kategori_obat';

    public function get_kategori_obat($id = null, string $nama = '')
    {
        if (!empty($id)) {
            $query = $this->db->get_where($this->_table, ['id' => $id]);
            $kategori_obat = $query->row();
            return $kategori_obat;
        }

        if (!empty($nama)) {
            $query = $this->db->get_where($this->_table, ['nama' => $nama]);
            $kategori_obat = $query->row();
            return $kategori_obat;
        }

        $query = $this->db->get($this->_table);
        $kategori_obats = $query->result();
        return $kategori_obats;
    }

    public function store(string $nama)
    {
        $data = [
            'id' => uniqid("KOB-"),
            'nama' => $nama
        ];

        $this->db->insert($this->_table, $data);
    }

    public function update(string $id, $nama)
    {
        $data = [
            'nama' => $nama
        ];

        $this->db->update($this->_table, $data, ['id' => $id]);
    }

    public function destroy(string $id)
    {
        $this->db->delete($this->_table, ['id' => $id]);
    }
}
