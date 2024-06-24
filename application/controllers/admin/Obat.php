<?php

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_model->get_current_user();

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

        $this->form_validation->set_rules('merk', 'Merk', ['required', 'trim'], [
            'required' => 'Merk obat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', ['required', 'trim', 'numeric'], [
            'required' => 'Stok tidak boleh kosong',
            'numeric' => 'Stok obat tidak valid'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', ['required', 'trim', 'numeric'], [
            'required' => 'Harga obat tidak boleh kosong', 
            'numeric' => 'Harga obat tidak valid'
        ]);
        $this->form_validation->set_rules('kategori_obat', 'Kategori', ['required', 'trim'], [
            'required' => 'Kategori obat tidak boleh kosong'
        ]);

        if (!$this->form_validation->run()) {
            $kategori_obats = $this->kategori_obat_model->get_kategori_obat();
            $data = ['kategori_obats' => $kategori_obats];

            $this->session->set_flashdata('obat_create_error', 'Gagal menambahkan obat!');

            $this->slice->view('pages/admin/obat/create', ['data' => $data]);
        }

        $merk = $this->input->post('merk');
        $kategori = $this->kategori_obat_model->get_kategori_obat('', $this->input->post('kategori_obat'));
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');

        $this->obat_model->store($merk, $kategori->id, $stok, $harga);
        $this->session->set_flashdata('obat_create_success', 'Berhasil menambahkan obat!');

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
            'obat_categories' => $obat_categories,
        ];

        $this->slice->view('pages/admin/obat/edit', $data);
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('merk', 'Merk', ['required', 'trim'], [
            'required' => 'Merk obat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', ['required', 'trim', 'numeric'], [
            'required' => 'Stok tidak boleh kosong',
            'numeric' => 'Stok obat tidak valid'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', ['required', 'trim', 'numeric'], [
            'required' => 'Harga obat tidak boleh kosong', 
            'numeric' => 'Harga obat tidak valid'
        ]);
        $this->form_validation->set_rules('kategori_obat', 'Kategori', ['required', 'trim'], [
            'required' => 'Kategori obat tidak boleh kosong'
        ]);

        if (!$this->form_validation->run()) {
            $obat = $this->obat_model->get_obat($id);
            $data = ['obat' => $obat];

            $this->session->set_flashdata('obat_create_error', 'Gagal mengubah obat!');


            $this->slice->view('pages/admin/obat/edit', $data);
        }

        $merk = $this->input->post('merk');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $kategori = $this->kategori_obat_model->get_kategori_obat('', $this->input->post('kategori_obat'));

        $this->obat_model->update($id, $merk, $kategori->id, $stok, $harga);
        $this->session->set_flashdata('obat_create_success', 'Berhasil mengubah obat!');

        redirect(base_url('admin/obat'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->obat_model->destroy($id);
        $this->session->set_flashdata('obat_delete_success', 'Berhasil menghapus obat!');

        redirect(base_url('admin/obat'));
    }

    public function fetch()
    {
        $this->load->model('obat_model');
        $obat = $this->obat_model->get_obat();

        $searchTerm = $this->input->post('search');

        $matches = [];
        foreach ($obat as $o) {
            if (stripos($o->merk, $searchTerm) === 0) {
                $matches[] = $o;
            }
        }

        echo json_encode($matches);
    }
}
