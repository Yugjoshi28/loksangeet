<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        // ✅ LOAD MODEL
        $this->load->model('Dashboard_model');

        // 🔴 ADMIN LOGIN CHECK
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') !== 'admin'
        ) {
            redirect('login');
            exit;
        }
    }



    // 🏠 Dashboard Home
    public function index()
    {
        $data['total_tasks'] = $this->db->count_all('tasks');
        $data['performance'] = $this->Dashboard_model->get_user_performance();
        $data['performance'] = $this->Dashboard_model->get_performance_summary();
        $data['total_users'] = $this->db
            ->where('role !=', 'admin')
            ->count_all_results('users');

        $data['completed_tasks'] = $this->db
            ->where('status', 'completed')
            ->count_all_results('tasks');

        $this->load->view('header');
        $this->load->view('dashboard', $data);
        $this->load->view('footer');
    }

    // ➕ Add Project Page
    public function add_project()
    {
        $this->load->view('header');
        $this->load->view('add_project');
        $this->load->view('footer');
    }

    // 📋 Project List Page
    public function project_list()
    {
        $this->load->view('header');
        $this->load->view('project_list');
        $this->load->view('footer');
    }




    // ➕ Add User Page
    public function add_user()
    {
        $this->load->view('header');
        $this->load->view('add_user');
        $this->load->view('footer');
    }
}
