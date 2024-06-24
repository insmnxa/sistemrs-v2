<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_model->get_current_user();

        // Loading models
        $this->load->model(['user_model', 'auth_model']);

        // Loading libraries and helpers
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $users = $this->user_model->get_users();
        $data = ['users' => $users];

        $this->slice->view('pages/admin/user/index', ['data' => $data]);
    }

    /**
     * Show create user form function.
     */
    public function create()
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $this->slice->view('pages/admin/user/create');
    }

    /**
     * Store new user function.
     */
    public function store()
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Nama tidak boleh kosong',
            'max_length' => 'Nama tidak boleh lebih dari 128 karakter'
        ]);
        
        $this->form_validation->set_rules('username', 'Username', ['required', 'trim', 'max_length[128]'], [
            'required' => 'Username tidak boleh kosong',
            'max_length' => 'Username tidak boleh lebih dari 128 karakter'
        ]);

        $this->form_validation->set_rules('password', 'Password', ['required', 'trim', 'min_length[8]', 'matches[re_password]'], [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 8 karakter'
        ]);

        $this->form_validation->set_rules('re_password', 'Repeat password', ['required', 'trim', 'min_length[8]', 'matches[password]'], [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 8 karakter',
            'matches' => 'Password tidak sama'
        ]);

        $this->form_validation->set_error_delimiters('<div class="small pl-2 text-danger mt-1">', '</div>');


        if (!$this->form_validation->run()) {

            $this->session->set_flashdata('user_create_error', 'Gagal meregistrasi user!');

            $this->slice->view('pages/admin/user/create');

            return;
        }

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->auth_model->register($nama, $username, $password);
        $this->session->set_flashdata('user_create_success', 'Berhasil meregistrasi user!');

        redirect(base_url('admin/users'));
    }

    /**
     * Show edit form function by id.
     */
    public function edit(string $id)
    {
        if ($this->input->method() !== 'get') {
            show_error('Invalid method', 405);
        }

        $user = $this->user_model->get_users($id);
        $data = ['user' => $user];

        $this->slice->view('pages/admin/user/edit', ['data' => $data]);
    }

    /**
     * Update user by id function.
     */
    public function update(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $this->form_validation->set_rules('nama', 'Nama', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('username', 'Username', ['required', 'trim', 'max_length[128]']);
        $this->form_validation->set_rules('password', 'Password', ['trim', 'min_length[8]']);
        // $this->form_validation->set_rules('is_active', 'Status', ['required', 'integer', 'in_list[0, 1]']);

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('user_edit_error', 'Gagal mengubah user!');

            $this->slice->view('pages/admin/user/edit');

            return;
        }

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        // $is_active = $this->input->post('is_active');

        // $this->user_model->update($id, $nama, $username, $is_active, $password);
        $this->user_model->update($id, $nama, $username, $password);
        $this->session->set_flashdata('user_edit_success', 'Berhasil mengubah user!');

        redirect(base_url('admin/users'));
    }

    /**
     * Delete user by id function.
     */
    public function delete(string $id)
    {
        if ($this->input->method() !== 'post') {
            show_error('Invalid method', 405);
        }

        $user = $this->user_model->get_users($id);

        if (empty($user)) {
            show_error('User not found', 404);
        }

        $this->user_model->destroy($id);
        $this->session->set_flashdata('user_delete_success', 'Berhasil menghapus user!');

        redirect(base_url('admin/users'));
    }
}
