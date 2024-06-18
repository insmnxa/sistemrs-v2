<?php

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Loading models
        $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $this->auth_model->logout();
        redirect(base_url('login'));
    }
}
