<?php

class User_model extends CI_Model
{
    public $nama;
    public $username;
    public $password;
    public $is_active;

    private $_table = 'users';

    /**
     * Get user function
     * 
     * return all users if @param $id is not set
     * 
     * @param $id = null
     */
    public function get_users(string $id = null)
    {
        if ($id) {
            $query = $this->db->get_where($this->_table, ['id' => $id]);
            $user = $query->row();
            return $user;
        }

        $query = $this->db->select('id, nama, username, is_active')->get($this->_table);
        $users = $query->result();
        return $users;
    }

    /**
     * Update user function by user id
     * 
     * @param string $id
     * @param string $nama
     * @param string $username
     * @param string $password = null
     */
    public function update(string $id, $nama, $username, $password = null)
    {
        $data = [];

        if (!$password) {
            $data = [
                'nama' => $nama,
                'username' => $username,
            ];
        }

        if ($password) {
            $data = [
                'nama' => $nama,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                // 'is_active' => $is_active,
            ];
        }

        $this->db->update($this->_table, $data, ['id' => $id]);
    }

    /**
     * Delete user function by user id
     * 
     * @param string $id
     */
    public function destroy(string $id)
    {
        $this->db->delete($this->_table, ['id' => $id]);
    }
}
