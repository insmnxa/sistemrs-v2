<?php

class Dokter_model extends CI_Model
{
    public $id;
    public $nama;
    public $nip;
    public $alamat;
    public $no_telp;

    private $_table = 'dokter';

    public function get_dokter(string $id = '', $nama = '')
    {
        if ($id) {
            $query = $this->db->get_where($this->_table, ['id' => $id]);
            $dokter = $query->row();
            return $dokter;
        }

        if ($nama) {
            $query  = $this->db->get_where($this->_table, ['nama' => $nama]);
            $dokter = $query->row();
            return $dokter;
        }

        $query = $this->db->get($this->_table);
        $dokters = $query->result();
        return $dokters;
    }

    public function store(string $nama, $nip, $alamat, $no_telp)
    {
        $this->id = uniqid('DKT-');
        $this->nama = $nama;
        $this->nip = $nip;
        $this->alamat = $alamat;
        $this->no_telp = $no_telp;

        $this->db->insert($this->_table, $this);
    }

    public function update(string $id, $nama, $nip, $alamat, $no_telp)
    {
        $data = [
            'nama' => $nama,
            'nip' => $nip,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
        ];

        $this->db->update($this->_table, $data, ['id' => $id]);
    }

    public function destroy(string $id)
    {
        $this->db->delete($this->_table, ['id' => $id]);
    }
}
