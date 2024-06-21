<?php

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_model->get_current_user();

        $this->load->model('dokter_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $docters = $this->dokter_model->get_dokter();
        $data = ['docters' => $docters];

        $this->slice->view('pages/admin/dokter/index', $data);
    }

    public function create()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $this->slice->view('pages/admin/dokter/create');
    }

    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('nip', 'NIP', ['required', 'trim', 'max_length[18]']);
        $this->form_validation->set_rules('alamat', 'Alamat', ['required', 'trim']);
        $this->form_validation->set_rules('no_telp', 'No Telepon', ['required', 'trim', 'max_length[20]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages/admin/dokter/create');
        }

        $nama = $this->input->post('nama');
        $nip = $this->input->post('nip');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');

        $this->dokter_model->store($nama, $nip, $alamat, $no_telp);
        redirect(base_url('admin/docters'));
    }

    public function edit(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $docter = $this->dokter_model->get_dokter($id);
        $data = ['docter' => $docter];

        $this->slice->view('pages/admin/dokter/edit', $data);
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('nip', 'NIP', ['required', 'trim', 'max_length[18]']);
        $this->form_validation->set_rules('alamat', 'Alamat', ['required', 'trim']);
        $this->form_validation->set_rules('no_telp', 'No Telepon', ['required', 'trim', 'max_length[20]']);

        if (!$this->form_validation->run()) {
            $docter = $this->dokter_model->get_dokter($id);
            $data = ['docter' => $docter];

            $this->slice->view('pages/admin/dokter/edit', $data);
        }

        $nama = $this->input->post('nama');
        $nip = $this->input->post('nip');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');

        $this->dokter_model->update($nama, $nip, $alamat, $no_telp);
        redirect(base_url('admin/docters'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->dokter_model->destroy($id);
        redirect(base_url('admin/docters'));
    }

    public function fetch()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $docters = [];

        $result = $this->dokter_model->get_dokter();

        foreach ($result as $r) {
            array_push($docters, $r->nama);
        }

        echo json_encode($docters);
    }
}
