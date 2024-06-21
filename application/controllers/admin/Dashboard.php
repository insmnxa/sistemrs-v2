<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Loading Models
        $this->load->model('auth_model');

        $this->auth_model->get_current_user();
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_404();
        }

        $this->slice->view('pages/admin/dashboard');
    }
}
