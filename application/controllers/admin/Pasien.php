<?php

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_model->get_current_user();

        $this->load->model(['pasien_model', 'dokter_model']);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="small pl-2 text-danger mt-1">', '</div>');
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
        $this->form_validation->set_rules('dokter', 'Dokter', ['required', 'trim', 'max_length[128]']);

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('pasien_create_error', 'Gagal meregistrasi pasien!');
            $this->slice->view('pages.admin.pasien.create');

            return;
        }

        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_ktp = $this->input->post('no_ktp');
        $no_telp = $this->input->post('no_telp');
        $dokter = $this->dokter_model->get_dokter('', $this->input->post('dokter'));
        $id_user = $this->session->userdata('user_id');

        $this->pasien_model->store($nama, $tgl_lahir, $no_ktp, $no_telp, $dokter->id, $id_user);
        $this->session->set_flashdata('pasien_create_success', 'Berhasil meregistrasi pasien!');

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
            'docters' => $docters,
        ];

        $this->slice->view('pages/admin/pasien/edit', $data);
    }

    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Nama tidak boleh kosong',
            'max_length' => 'Nama tidak boleh lebih dari 128 karakter'
        ]);

        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', ['required', 'trim'], [
            'Tanggal lahir tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('no_ktp', 'No KTP', ['required', 'trim', 'max_length[16]', 'min_length[16]'], [
            'required' => 'No KTP tidak boleh kosong',
            'max_length' => 'Nama tidak boleh lebih dari 16 karakter',
            'min_length' => 'No KTP harus 16 karakter'
        ]);

        $this->form_validation->set_rules('no_telp', 'No Telepon', ['required', 'trim', 'max_length[20]'], [
            'required' => 'No telepon tidak boleh kosong',
            'max_length' => 'No telepon tidak boleh lebih dari 20 karakter'
        ]);

        $this->form_validation->set_rules('dokter', 'Dokter', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Dokter tidak boleh kosong',
            'max_length' => 'Nama dokter tidak boleh lebih dari 128 karakter'
        ]);

        if (!$this->form_validation->run()) {
            $patient = $this->pasien_model->get_pasien($id);
            $docters = $this->dokter_model->get_dokter();
    
            $data = [
                'patient' => $patient,
                'docters' => $docters,
            ];

            $this->session->set_flashdata('pasien_edit_error', 'Gagal mengubah pasien!');
            $this->slice->view('pages.admin.pasien.edit', $data);

            return;
        }

        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_ktp = $this->input->post('no_ktp');
        $no_telp = $this->input->post('no_telp');
        $dokter = $this->dokter_model->get_dokter('', $this->input->post('dokter'));

        $this->pasien_model->update($id, $nama, $tgl_lahir, $no_ktp, $no_telp, $dokter->id);
        $this->session->set_flashdata('pasien_edit_success', 'Berhasil mengubah pasien!!');

        redirect(base_url('admin/patients'));
    }

    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->pasien_model->destroy($id);
        $this->session->set_flashdata('pasien_delete_success', 'Berhasil menghapus pasien!');

        redirect(base_url('admin/patients'));
    }
}
