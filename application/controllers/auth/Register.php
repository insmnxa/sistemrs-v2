<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Loading model
        $this->load->model('auth_model');

        // Load libraries and helper
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    /**
     * Show register function form
     */
    public function index()
    {
        if (!$this->input->method() === 'get') {
            show_404();
        }

        $this->slice->view('pages/auth/register');
    }

    /**
     * Register function
     */
    public function authenticate()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('username', 'Username', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('password', 'Password', ['required', 'trim', 'min_length[8]']);
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', ['required', 'trim', 'matches[password]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages/auth/register');
            return;
        }

        // Get user provided input
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->auth_model->register($nama, $username, $password);

        redirect(base_url('login'));
    }
}
