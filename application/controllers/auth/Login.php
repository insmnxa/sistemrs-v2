<?php

class Login extends CI_Controller
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
     * Show login form function
     */
    public function index()
    {
        if (!$this->input->method() === 'get') {
            show_404();
        }

        $this->slice->view('pages/auth/login');
    }

    /**
     * Login function
     */
    public function authenticate()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $this->form_validation->set_rules('username', 'Username', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('password', 'Password', ['required', 'trim', 'min_length[8]']);

        if (!$this->form_validation->run()) {
            $this->slice->view('pages/auth/login');
            return;
        }

        // Get user provided input
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (!$this->auth_model->login($username, $password)) {
            $this->session->set_flashdata('login_error', 'Username atau password salah!');
            redirect(base_url('login'));
        }

        redirect(base_url('admin/dashboard'));
    }
}
