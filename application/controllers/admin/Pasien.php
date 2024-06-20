<?php

use PhpParser\Node\Expr\PostDec;

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['pasien_model', 'dokter_model']);

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $patients = $this->pasien_model->get_pasien();

        $data = ['patients' => $patients];

        $this->slice->view('pages/admin/pasien/index', $data);
    }

    public function create()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $this->slice->view('pages/admin/pasien/create');
    }

    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', ['required', 'trim']);
        $this->form_validation->set_rules('no_ktp', 'No KTP', ['required', 'trim', 'max_length[16]']);
        $this->form_validation->set_rules('no_telp', 'No Telepon', ['required', 'trim', 'max_length[20]']);
        $this->form_validation->set_rules('id_dokter', 'Dokter', ['required', 'trim', 'max_length[17]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages.admin.pasien.create');
        }

        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_ktp = $this->input->post('no_ktp');
        $no_telp = $this->input->post('no_telp');
        $dokter = $this->dokter_model->get_dokter('', $this->input->post('dokter'));
        $id_user = $this->session->userdata('user_id');

        $this->pasien_model->store($nama, $tgl_lahir, $no_ktp, $no_telp, $dokter->id, $id_user);
        redirect(base_url('admin/patients'));
    }

    public function edit(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $patient = $this->pasien_model->get_pasien($id);
        $docters = $this->dokter_model->get_dokter();

        $data = [
            'patient' => $patient,
            'docters' => $docters
        ];

        $this->slice->view('pages/admin/pasien/edit', $data);
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', ['required', 'trim']);
        $this->form_validation->set_rules('no_ktp', 'No KTP', ['required', 'trim', 'max_length[16]']);
        $this->form_validation->set_rules('no_telp', 'No Telepon', ['required', 'trim', 'max_length[20]']);
        $this->form_validation->set_rules('id_dokter', 'Dokter', ['required', 'trim', 'max_length[17]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages.admin.pasien.edit');
        }

        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_ktp = $this->input->post('no_ktp');
        $no_telp = $this->input->post('no_telp');
        $id_dokter = $this->input->post('id_dokter');

        $this->pasien_model->update($id, $nama, $tgl_lahir, $no_ktp, $no_telp, $id_dokter);
        redirect(base_url('admin/patients'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->pasien_model->destroy($id);
        redirect(base_url('admin/patients'));
    }
}
