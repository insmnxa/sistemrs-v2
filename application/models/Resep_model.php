<?php

class Resep_model extends CI_Model
{
    public $id;
    public $qty;
    public $sub_total;
    public $satuan;
    public $id_resep;
    public $id_obat;

    private $_table = 'resep';

    public function store(string $id_pasien, $id_dokter, int $total_harga, array $kode_obat, $satuan, $qty, $sub_total)
    {
        $data_resep = [
            'id' => uniqid('RSP-'),
            'total_harga' => $total_harga,
            'id_pasien' => $id_pasien,
            'id_dokter' => $id_dokter
        ];

        $data_detail_resep = [];

        foreach ($kode_obat as $key => $value) {
            $data_detail_resep[] = [
                'id' => uniqid('DRP-'),
                'id_obat' => $value,
                'id_resep' => $data_resep['id'],
                'qty' => $qty[$key],
                'satuan' => $satuan[$key],
                'sub_total' => $sub_total[$key],
            ];
        }

        $this->db->insert($this->_table, $data_resep);
        $this->db->insert_batch('detail_resep', $data_detail_resep);
        self::mark_pacient_as_complete($id_pasien);
    }

    public function get_receipt()
    {
        $this->db->select('resep.id r_i, resep.total_harga r_th, resep.status r_s, pasien.id p_i, pasien.nama pa, dokter.id, dokter.nama da');
        $this->db->from('resep');
        $this->db->join('pasien', 'resep.id_pasien = pasien.id');
        $this->db->join('dokter', 'resep.id_dokter = dokter.id');
        $this->db->group_by('resep.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_resep_with_details(string $id)
    {
        $this->db->select('resep.*, detail_resep.*');
        $this->db->from('resep');
        $this->db->join('detail_resep', 'resep.id = detail_resep.id_resep');
        $this->db->where('resep.id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    private function mark_pacient_as_complete(string $id_pasien)
    {
        $this->db->set('status', 'complete');
        $this->db->where('id', $id_pasien);
        $this->db->update('pasien');
    }

    public function get_receipt_by_patient_name(string $nama)
    {
        $this->db->select('id');
        $this->db->from('resep');
        $this->db->where('resep.id');
    }

    public function get_receipt_by_patient_id(string $id_pasien)
    {
        $this->db->select('pasien.nama p_nama, pasien.tgl_lahir p_tl, dokter.nama d_n, resep.id r_i, resep.total_harga r_th, resep.dibuat_pada r_dp, obat.merk om, detail_resep.*');
        $this->db->from('resep');
        $this->db->join('pasien', 'pasien.id = resep.id_pasien');
        $this->db->join('dokter', 'dokter.id = resep.id_dokter');
        $this->db->join('detail_resep', 'detail_resep.id_resep = resep.id');
        $this->db->join('obat', 'obat.id = detail_resep.id_obat');
        $this->db->where('resep.id_pasien', $id_pasien);
        $query = $this->db->get();
        $results = $query->result();

        $receipt = [];
        $detail_resep = [];

        foreach ($results as $row) {
            if (empty($receipt)) {
                $receipt = [
                    'p_nama' => $row->p_nama,
                    'p_tl' => $row->p_tl,
                    'd_n' => $row->d_n,
                    'r_i' => $row->r_i,
                    'r_th' => $row->r_th,
                    'r_dp' => explode(' ', $row->r_dp)[0],
                    'detail_resep' => []
                ];
            }

            $detail_resep[] = [
                'id' => $row->id,
                'id_resep' => $row->id_resep,
                'merk_obat' => $row->om,
                'qty' => $row->qty,
                'sub_total' => $row->sub_total,
                'satuan' => $row->satuan,
            ];
        }

        $receipt['detail_resep'] = $detail_resep;

        return json_encode($receipt);
    }
}
