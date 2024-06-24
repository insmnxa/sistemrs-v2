<?php

class Kategori_obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_model->get_current_user();

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

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Nama tidak boleh kosong',
            'max_length' => 'Nama kategori tidak boleh lebih dari 128 karakter'
        ]);

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('kategori_obat_error', 'Gagal menambahkan kategori obat baru!');
            $this->slice->view('pages.admin.kategori_obat.create');

            return;
        }

        $nama = $this->input->post('nama');

        $this->kategori_obat_model->store($nama);
        $this->session->set_flashdata('kategori_obat_success', 'Berhasil menambahkan kategori obat baru!');

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

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Nama tidak boleh kosong',
            'max_length' => 'Nama kategori tidak boleh lebih dari 128 karakter'
        ]);

        if (!$this->form_validation->run()) {
            $obat_category = $this->kategori_obat_model->get_kategori_obat($id);
            $data = ['obat_category' => $obat_category];

            $this->session->set_flashdata('kategori_obat_error_edit', 'Gagal mengubah kategori obat!');

            $this->slice->view('pages/admin/kategori_obat/edit', $data);
            return;
        }

        $nama = $this->input->post('nama');

        $this->kategori_obat_model->update($id, $nama);
        $this->session->set_flashdata('kategori_obat_success_edit', 'Berhasil mengubah kategori obat!');

        redirect(base_url('admin/obat/kategori-obat'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->kategori_obat_model->destroy($id);
        $this->session->set_flashdata('kategori_obat_success_delete', 'Berhasil menghapus kategori obat!');

        redirect(base_url('admin/obat/kategori-obat'));
    }

    public function fetch()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $obat_categories = [];

        $result = $this->kategori_obat_model->get_kategori_obat();

        foreach ($result as $r) {
            array_push($obat_categories, $r->nama);
        }

        echo json_encode($obat_categories);
    }
}
