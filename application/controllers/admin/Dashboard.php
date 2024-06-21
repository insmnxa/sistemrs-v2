<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Loading Models
        $this->load->model(['auth_model', 'pasien_model', 'dokter_model', 'obat_model', 'user_model']);

        $this->auth_model->get_current_user();
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_404();
        }

        $patients_count = $this->pasien_model->count();
        $docters_count = $this->dokter_model->count();
        $users_count = $this->user_model->count();
        $obat_count = $this->obat_model->count();

        $data = [
            'patients_count' => $patients_count,
            'docters_count' => $docters_count,
            'users_count' => $users_count,
            'obat_count' => $obat_count,
        ];

        $this->slice->view('pages/admin/dashboard', $data);
    }
}
