<?php

class Pasien_model extends CI_Model
{
    public $id;
    public $nama;
    public $tgl_lahir;
    public $no_ktp;
    public $no_telp;
    public $id_dokter;
    public $id_user;

    private $_table = 'pasien';

    public function get_pasien(string $id = '', $is_receipt_made = null)
    {
        if ($id) {
            $this->db->select('pasien.id p_i, pasien.nama p_n, pasien.tgl_lahir p_tgl, pasien.no_ktp p_ktp, pasien.no_telp p_tlp, dokter.id di, dokter.nama dn, users.id, users.nama un');
            $this->db->from('pasien');
            $this->db->join('dokter', 'dokter.id = pasien.id_dokter');
            $this->db->join('users', 'users.id = pasien.id_user');
            $this->db->where('pasien.id', $id);
            $pasien = $this->db->get();

            return $pasien->row();
        }

        if (isset($is_receipt_made)) {
            $query = $this->db->get_where($this->_table, ['is_receipt_made' => $is_receipt_made]);
            $pasiens = $query->result();

            return $pasiens;
        } else {
            $this->db->select('pasien.id p_i, pasien.nama p_n, pasien.tgl_lahir p_tgl, pasien.no_ktp p_ktp, pasien.no_telp p_tlp, pasien.status, dokter.id, dokter.nama dn, users.id, users.nama un');
            $this->db->from('pasien');
            $this->db->join('dokter', 'dokter.id = pasien.id_dokter');
            $this->db->join('users', 'users.id = pasien.id_user');
            $query = $this->db->get();

            return $query->result();
        }
    }

    public function store(string $nama, $tgl_lahir, $no_ktp, $no_telp, $id_dokter, $id_user)
    {
        $this->id = uniqid('PSN-');
        $this->nama = $nama;
        $this->tgl_lahir = $tgl_lahir;
        $this->no_ktp = $no_ktp;
        $this->no_telp = $no_telp;
        $this->id_dokter = $id_dokter;
        $this->id_user = $id_user;

        $this->db->insert($this->_table, $this);
    }

    public function update(string $id, $nama, $tgl_lahir, $no_ktp, $no_telp, $id_dokter)
    {
        $data = [
            'nama' => $nama,
            'tgl_lahir' => $tgl_lahir,
            'no_ktp' => $no_ktp,
            'no_telp' => $no_telp,
            'id_dokter' => $id_dokter,
        ];

        $this->db->update($this->_table, $data, ['id' => $id]);
    }

    public function destroy(string $id)
    {
        $this->db->delete($this->_table, ['id' => $id]);
    }

    public function count(): int
    {
        return $this->db->count_all($this->_table);
    }
}
