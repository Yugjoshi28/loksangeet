<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Project_model');
        $this->load->library('session');
        $this->load->helper('url');

        // 🔐 Login required
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // 🔐 Admin only
        if ($this->session->userdata('role') !== 'admin') {
            redirect('login');
        }
    }


    public function index()
    {
        $data['projects'] = $this->Project_model->get_all_projects();

        $this->load->view('header');
        $this->load->view('project_list', $data);
        $this->load->view('footer');
    }

    public function add()
    {
        $this->load->view('header');
        $this->load->view('add_project');
        $this->load->view('footer');
    }


    public function store()
    {
        $data = [
            'project_name' => $this->input->post('project_name'),
            'project_description' => $this->input->post('project_description'),

            // 🔥 FIX
            'user_id' => $this->session->userdata('user_id'),

            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->Project_model->insert_project($data);

        redirect('project');
    }



    public function edit($id)
    {
        $data['project'] = $this->Project_model->get_project($id);

        if (!$data['project']) {
            show_404();
        }

        $this->load->view('header');
        $this->load->view('add_project', $data);
        $this->load->view('footer');
    }


    public function update($id)
    {
        $data = [
            'project_name'        => $this->input->post('project_name', true),
            'project_description' => $this->input->post('project_description', true),
        ];

        $this->Project_model->update_project($id, $data);


        redirect('project');
    }



    public function tasks_by_project($project_id)
    {
        $data['tasks'] = $this->Project_model->get_tasks_by_project($project_id);

        $this->load->view('header');
        $this->load->view('admin/tasks_by_project', $data);
        $this->load->view('footer');
    }



    public function task_logs($task_id)
    {
        $data['logs'] = $this->Project_model->get_logs_by_task($task_id);

        $this->load->view('header');
        $this->load->view('admin/task_logs', $data);
        $this->load->view('footer');
    }




    public function projects_by_user($user_id = null)
    {
        // If no user_id passed, use logged-in user
        if ($user_id === null) {
            $user_id = $this->session->userdata('user_id');
        }

        $data['projects'] = $this->Project_model->get_projects_by_user($user_id);

        $this->load->view('header');
        $this->load->view('admin/my_projects', $data);
        $this->load->view('footer');
    }


    // ADMIN – ALL PROJECTS
    public function all_projects()
    {
        $data['projects'] = $this->Project_model->get_all_projects();

        $this->load->view('header');
        $this->load->view('admin/my_projects', $data);
        $this->load->view('footer');
    }

    public function delete($id)
    {
        if (!$id) {
            show_404();
        }

        // Check project exists
        $project = $this->Project_model->get_project($id);

        if (!$project) {
            show_404();
        }

        // Delete using model
        $this->Project_model->delete_project($id);

        $this->session->set_flashdata('success', 'Project deleted successfully');

        redirect('project');
    }
}
