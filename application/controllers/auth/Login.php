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

        $this->form_validation->set_error_delimiters('<div class="small pl-2 text-danger mt-1">', '</div>');
    }

    /**
     * Show login form function.
     */
    public function index()
    {
        if (!$this->input->method() === 'get') {
            show_404();
        }

        $this->slice->view('pages/auth/login');
    }

    /**
     * Login function.
     */
    public function authenticate()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $this->form_validation->set_rules('username', 'Username', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Username tidak boleh kosong',
            'max_length' => 'Username tidak boleh lebih dari 128 karakter',
        ]);
        $this->form_validation->set_rules('password', 'Password', ['required', 'trim', 'min_length[8]'], [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 8 karakter',
        ]);

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

        $this->session->set_flashdata('login_success', 'Berhasil login!');

        redirect(base_url('admin/dashboard'));
    }
}
