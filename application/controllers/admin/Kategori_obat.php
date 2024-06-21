<?php

class Kategori_obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('kategori_obat_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $obat_categories = $this->kategori_obat_model->get_kategori_obat();
        $data = ['obat_categories' => $obat_categories];

        $this->slice->view('pages/admin/kategori_obat/index', $data);
    }

    public function create()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $this->slice->view('pages/admin/kategori_obat/create');
    }

    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages.admin.kategori_obat.create');
        }

        $nama = $this->input->post('nama');

        $this->kategori_obat_model->store($nama);
        redirect(base_url('admin/obat/kategori-obat'));
    }

    public function edit(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $obat_category = $this->kategori_obat_model->get_kategori_obat($id);
        $data = ['obat_category' => $obat_category];

        $this->slice->view('pages/admin/kategori_obat/edit', ['data' => $data]);
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages/admin/kategori_obat/edit');
        }

        $nama = $this->input->post('nama');

        $this->kategori_obat_model->update($id, $nama);
        redirect(base_url('admin/obat/kategori-obat'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->kategori_obat_model->destroy($id);
        redirect(base_url('admin/obat/kategori-obat'));
    }
}
