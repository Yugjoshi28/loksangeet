<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';

    /* =====================================================
       INSERT USER (ADMIN)
    ===================================================== */
    public function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /* =====================================================
       GET ALL USERS (ADMIN LIST / FILTERS)
    ===================================================== */
    public function get_all_users()
    {
        return $this->db
            ->select('id, name, email, phone, address, role, created_at, photo')
            ->from('users')
            ->where('LOWER(role)', 'user')   // keep if you only want users (not admin)
            ->order_by('name', 'ASC')
            ->get()
            ->result();
    }


    /* =====================================================
       GET USER BY ID
    ===================================================== */
    public function get_user_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    /* =====================================================
       GET USER BY EMAIL (LOGIN)
    ===================================================== */
    public function get_user_by_email($email)
    {
        return $this->db->where('email', $email)->get('users')->row();
    }

    /* =====================================================
       UPDATE USER (COMMON)
    ===================================================== */
    public function update_user($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    /* =====================================================
       DELETE USER (ADMIN)
    ===================================================== */
    public function delete_user($id)
    {
        // delete photo first
        $photo = $this->get_user_photo($id);
        if ($photo && file_exists(FCPATH . 'uploads/profile/' . $photo)) {
            unlink(FCPATH . 'uploads/profile/' . $photo);
        }

        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }

    /* =====================================================
       GET USER PHOTO ONLY
    ===================================================== */
    public function get_user_photo($id)
    {
        return $this->db
            ->select('photo')
            ->where('id', $id)
            ->get($this->table)
            ->row('photo');
    }

    /* =====================================================
       UPDATE PROFILE (USER SIDE)
    ===================================================== */
    public function update_profile($id, $data)
    {
        return $this->update_user($id, $data);
    }

    /* =====================================================
       CHANGE PASSWORD
    ===================================================== */
    public function update_password($id, $password)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, [
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
    }

    /* =====================================================
       COUNT USERS (DASHBOARD)
    ===================================================== */
    public function count_users()
    {
        return $this->db->count_all($this->table);
    }

    /* =====================================================
       GET USERS BY ROLE
    ===================================================== */
    public function get_users_by_role($role)
    {
        return $this->db
            ->where('role', $role)
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result();
    }

    /* =====================================================
       CHECK EMAIL EXISTS (VALIDATION)
    ===================================================== */
    public function email_exists($email, $exclude_id = null)
    {
        $this->db->where('email', $email);

        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }

        return $this->db->get($this->table)->num_rows() > 0;
    }
}
