<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function auth()
    {
        $email = $this->input->post('email');
        $pass  = $this->input->post('password');

        // 🔹 get user by email
        $user = $this->db
            ->where('email', $email)
            ->get('users')
            ->row();

        // ❌ EMAIL NOT FOUND
        if (!$user) {
            $this->session->set_flashdata('login_error', 'Email not found');
            redirect('login');
        }

        // ❌ PASSWORD WRONG
        if (!password_verify($pass, $user->password)) {
            $this->session->set_flashdata('login_error', 'Wrong password');
            redirect('login');
        }

        // ✅ LOGIN SUCCESS
        $this->session->set_userdata([
            'user_id'   => $user->id,
            'user_name' => $user->name,
            'role'      => strtolower(trim($user->role)),
            'photo'     => $user->photo,
            'logged_in' => TRUE
        ]);

        // 🔹 role based redirect
        if (strtolower($user->role) === 'admin') {
            redirect('dashboard'); // admin panel
        } else {
            redirect('welcome');   // userside dashboard
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
