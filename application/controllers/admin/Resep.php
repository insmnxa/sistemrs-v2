<?php

class Resep extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_model->get_current_user();

        $this->load->model(['pasien_model', 'resep_model']);

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $pasien = $this->pasien_model->get_pasien();
        $data = ['patients' => $pasien];

        $this->slice->view('pages/admin/resep/index', $data);
    }

    public function create(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $patient = $this->pasien_model->get_pasien($id);
        $data = ['patient' => $patient];

        $this->slice->view('pages/admin/resep/create', $data);
    }

    public function store(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('kode[]', 'Kode Obat', ['required', 'trim', 'max_length[17]']);
        $this->form_validation->set_rules('satuan[]', 'Satuan', ['required', 'trim', 'in_list[pcs,kpl,tbl,btl]']);
        $this->form_validation->set_rules('qty[]', 'Jumlah', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('sub_total[]', 'Sub Total', ['required', 'trim', 'numeric']);

        if (!$this->form_validation->run()) {
            $pasien = $this->pasien_model->get_pasien($id);
            $data = ['pasien' => $pasien];

            $this->slice->view('pages/admin/resep/create', ['data' => $data]);
        }

        $arr_kode = $this->input->post('kode', true);
        $arr_satuan = $this->input->post('satuan', true);
        $arr_qty = $this->input->post('qty', true);
        $arr_sub_total = $this->input->post('sub_total', true);

        $id_pasien = $id;
        $id_dokter = $this->input->post('id_dokter');
        $total_harga = $this->input->post('total_harga');

        $this->resep_model->store($id_pasien, $id_dokter, $total_harga, $arr_kode, $arr_satuan, $arr_qty, $arr_sub_total);
        redirect(base_url('admin/receipts'));
    }

    public function show(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $result = $this->resep_model->get_receipt_by_patient_id($id);
        $data = ['result' => json_decode($result)];

        $this->slice->view('pages/admin/resep/show', $data);
    }

    public function edit(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }
    }
}
