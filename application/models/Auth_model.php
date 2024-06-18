<?php

class Auth_model extends CI_Model
{
    public $id;
    public $nama;
    public $username;
    public $password;
    public $is_active;

    private $_table = 'users';
    const SESSION_KEY = 'user_id';

    /**
     * Login function
     * 
     * @param string $username
     * @param string $password
     */
    public function login(string $username, $password)
    {
        $query = $this->db->get_where($this->_table, ['username' => $username]);
        $user = $query->row();

        if (!$user) {
            return FALSE;
        }

        if ($user->is_active < 1) {
            return FALSE;
        }

        if (!password_verify($password, $user->password)) {
            return FALSE;
        }

        $this->session->set_userdata(self::SESSION_KEY, $user->id);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    /**
     * Register function
     * 
     * @param string $nama
     * @param string $username
     * @param string $password
     */
    public function register(string $nama, $username, $password)
    {
        $this->id = uniqid('USR-');
        $this->nama = $nama;
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->is_active = 0;

        $this->db->insert($this->_table, $this);
    }

    /**
     * Logout function
     */
    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }

    /**
     * Get current user that has been logged in
     */
    public function get_current_user()
    {
        $user_id = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['id' => $user_id]);
        $user = $query->row();

        if (empty($user)) {
            show_error('You have to login first', 404);
        }

        return $user;
    }
}
