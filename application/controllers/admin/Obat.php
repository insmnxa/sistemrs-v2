<?php

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['obat_model', 'kategori_obat_model']);

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $obats = $this->obat_model->get_obat();
        $data = ['obats' => $obats];

        $this->slice->view('pages/admin/obat/index', $data);
    }

    public function create()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $obat_categories = $this->kategori_obat_model->get_kategori_obat();
        $data = ['obat_categories' => $obat_categories];

        $this->slice->view('pages/admin/obat/create', $data);
    }

    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        // Set rules
        $this->form_validation->set_rules('merk', 'Merk', ['required', 'trim']);
        $this->form_validation->set_rules('stok', 'Stok', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('harga', 'Harga', ['required', 'trim', 'numeric']);
        $this->form_validation->set_rules('kategori', 'Kategori', ['required', 'trim', 'max_length[17]']);

        if (!$this->form_validation->run()) {
            $kategori_obats = $this->kategori_obat_model->get_kategori_obat();
            $data = ['kategori_obats' => $kategori_obats];

            $this->slice->view('pages/admin/obat/create', ['data' => $data]);
        }

        // Get user input
        $merk = $this->input->post('merk');
        $kategori = $this->input->post('kategori');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');

        $this->obat_model->store($merk, $kategori, $stok, $harga);
        redirect(base_url('admin/obat'));
    }

    public function edit(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $obat = $this->obat_model->get_obat($id);
        $obat_categories = $this->kategori_obat_model->get_kategori_obat();

        $data = [
            'obat' => $obat,
            'obat_categories' => $obat_categories
        ];

        $this->slice->view('pages/admin/obat/edit', $data);
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        // Set rules
        $this->form_validation->set_rules('merk', 'Merk', ['required', 'trim']);
        $this->form_validation->set_rules('stok', 'Stok', ['required', 'trim', 'int']);
        $this->form_validation->set_rules('harga', 'Harga', ['required', 'trim', 'decimal']);
        $this->form_validation->set_rules('kategori', 'Kategori', ['required', 'trim', 'max_length[17]']);

        if (!$this->form_validation->run()) {
            $obat = $this->obat_model->get_obat($id);
            $data = ['obat' => $obat];

            $this->slice->view('pages/admin/obat/edit', $data);
        }

        // Get user input
        $merk = $this->input->post('merk');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $kategori = $this->input->post('kategori');

        $this->obat_model->update($id, $merk, $kategori, $stok, $harga);
        redirect(base_url('admin/obat'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->obat_model->destroy($id);
        redirect(base_url('admin/obat'));
    }
}
