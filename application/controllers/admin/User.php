<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/user_list');
        $this->load->view('admin/footer');
    }

    // ================= FETCH USERS =================
    public function fetch_users()
    {

        header('Content-Type: application/json');

        $search = $this->input->post('search');

        if (!empty($search)) {
            $this->db->like('name', $search);
            $this->db->or_like('mobile', $search);
        }

        $query = $this->db->get('users');

        echo json_encode([
            'data' => $query->result()
        ]);

        exit;
    }

    // ================= TOGGLE STATUS =================
    public function toggle_status()
    {

        header('Content-Type: application/json');

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $this->db->where('id', $id);
        $this->db->update('users', ['isActive' => $status]);

        echo json_encode([
            'success' => true
        ]);

        exit;
    }


    // ================= EDIT PAGE =================
    public function edit($id)
    {
        $data['user'] = $this->db->where('id', $id)->get('users')->row();

        $this->load->view('admin/header');
        $this->load->view('admin/user_edit', $data);
        $this->load->view('admin/footer');
    }
    // ================= UPDATE USER =================
    public function update()
    {
        $id = $this->input->post('id');

        $update = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'business' => $this->input->post('business'),
            'address' => $this->input->post('address'),
            'taluka' => $this->input->post('taluka'),
            'district' => $this->input->post('district'),
            'pincode' => $this->input->post('pincode'),
        ];

        $this->db->where('id', $id)->update('users', $update);

        // PHOTO
        if (!empty($_FILES['photo']['name'])) {

            $config['upload_path'] = './uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {

                $file = $this->upload->data();
                $this->db->where('id', $id)->update('users', ['photo' => $file['file_name']]);
            }
        }

        redirect('admin/user');
    }
}
