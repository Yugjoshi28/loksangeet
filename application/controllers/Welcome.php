<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 🔐 User login check
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') !== 'user'
        ) {
            redirect('login');
        }

        // Load required models ONCE
        $this->load->model('Task_model');
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        // All user tasks
        $data['tasks'] = $this->Task_model->get_user_tasks($user_id);

        // 🔥 Task Overview Card
        $data['task_counts'] = $this->Dashboard_model->get_task_counts($user_id);

        // 🔥 Today's Tasks Card
        $data['today_tasks'] = $this->Dashboard_model->get_today_tasks($user_id);

        // Recent completed tasks
        $data['recent_tasks'] = $this->Task_model->get_recent_completed_tasks(7);

        // Load dashboard views
        $this->load->view('Userside/header');
        $this->load->view('dashboardd', $data);
        $this->load->view('Userside/footer');
    }


}
