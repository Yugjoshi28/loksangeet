<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->library(['session', 'upload']);
        $this->load->helper(['url', 'security']);

        // 🔐 Protect all user pages
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    /* =====================================================
       USER LIST (ADMIN)
    ===================================================== */
    public function index()
    {
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('header');
        $this->load->view('user_list', $data);
        $this->load->view('footer');
    }


    /* =====================================================
   UPDATE USER (ADMIN)
===================================================== */
    public function update($id)
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user');
        }

        $data = [
            'name'    => $this->input->post('name', true),
            'email'   => $this->input->post('email', true),
            'phone'   => $this->input->post('phone', true),
            'address' => $this->input->post('address', true),
            'role'    => $this->input->post('role', true)
        ];

        $this->User_model->update_user($id, $data);

        $this->session->set_flashdata('success', 'User updated successfully');
        redirect('user');
    }


    /* =====================================================
       ADD USER PAGE (ADMIN)
    ===================================================== */
    public function add()
    {
        $this->load->view('header');
        $this->load->view('add_user');
        $this->load->view('footer');
    }

    /* =====================================================
       STORE USER (ADMIN)
    ===================================================== */
    public function store()
    {
        $photo = null;

        // 📸 Upload profile photo
        if (!empty($_FILES['photo']['name'])) {
            $config['upload_path']   = FCPATH . 'uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {
                $photo = $this->upload->data('file_name');
            }
        }

        $data = [
            'name'     => $this->input->post('name', true),
            'email'    => $this->input->post('email', true),
            'phone'    => $this->input->post('phone', true),
            'address'  => $this->input->post('address', true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'     => $this->input->post('role'),
            'photo'    => $photo,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->User_model->insert_user($data);

        $this->session->set_flashdata('success', 'User added successfully');
        redirect('user');
    }

    /* =====================================================
       USER PROFILE (USER SIDE)
    ===================================================== */
    public function profile()
    {
        $id = $this->session->userdata('user_id');

        $data['user'] = $this->User_model->get_user_by_id($id);

        $this->load->view('Userside/header');
        $this->load->view('Userside/profile', $data);
        $this->load->view('Userside/footer');
    }

    /* =====================================================
       UPDATE PROFILE (USER SIDE)
    ===================================================== */
    public function update_profile()
    {
        $id = $this->session->userdata('user_id');

        $data = [
            'name'    => $this->input->post('name', true),
            'email'   => $this->input->post('email', true),
            'phone'   => $this->input->post('phone', true),
            'address' => $this->input->post('address', true)
        ];

        // 📸 Upload new photo
        if (!empty($_FILES['photo']['name'])) {

            $config['upload_path']   = FCPATH . 'uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {

                $uploadData = $this->upload->data();
                $data['photo'] = $uploadData['file_name'];

                // ❌ Delete old photo
                $oldPhoto = $this->User_model->get_user_photo($id);
                if ($oldPhoto && file_exists(FCPATH . 'uploads/profile/' . $oldPhoto)) {
                    unlink(FCPATH . 'uploads/profile/' . $oldPhoto);
                }

                // ✅ Update session photo
                $this->session->set_userdata('photo', $data['photo']);
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('user/profile');
            }
        }

        $this->User_model->update_user($id, $data);

        $this->session->set_flashdata('success', 'Profile updated successfully');
        redirect('user/profile');
    }

    /* =====================================================
       LOGOUT
    ===================================================== */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }


    /* =====================================================
   DELETE USER (ADMIN)
===================================================== */
    public function delete($id)
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user');
        }

        // ❌ Prevent deleting yourself
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You cannot delete your own account');
            redirect('user');
        }

        $this->User_model->delete_user($id);

        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect('user');
    }

    /* =====================================================
   EDIT USER PAGE (ADMIN)
===================================================== */
    public function edit($id)
    {
        // 🔐 Only admin allowed
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user');
        }

        $data['user'] = $this->User_model->get_user_by_id($id);

        if (!$data['user']) {
            show_404();
        }

        $this->load->view('header');
        $this->load->view('edit_user', $data);
        $this->load->view('footer');
    }
}
