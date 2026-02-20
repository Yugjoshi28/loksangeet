<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certificate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // DB load (fix undefined $db error)
        $this->load->database();

        // Session load (fix flashdata error)
        $this->load->library('session');
    }

    /* =====================================================
       LIST PAGE
    ===================================================== */
    public function index()
    {
        $data['certificates'] = $this->db
            ->order_by('id', 'DESC')
            ->get('certificates')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/certificate_list', $data);
        $this->load->view('admin/footer');
    }

    /* =====================================================
       ADD PAGE
    ===================================================== */
    public function add()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/certificate_add');
        $this->load->view('admin/footer');
    }

    /* =====================================================
       STORE
    ===================================================== */
    public function store()
    {
        $title = $this->input->post('title');

        if (empty($title) || empty($_FILES['image']['name'])) {
            $this->session->set_flashdata('error', 'Title & Image required');
            redirect('admin/certificate/add');
        }

        // upload path
        $upload_path = FCPATH . 'uploads/certificate/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp|jfif';
        $config['encrypt_name']  = true;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
            redirect('admin/certificate/add');
        }

        $file = $this->upload->data();

        $data = [
            'title'      => $title,
            'image'      => 'uploads/certificate/' . $file['file_name'],
            'isActive'   => 1,
            'created_on' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('certificates', $data);

        $this->session->set_flashdata('success', 'Certificate added successfully');
        redirect('admin/certificate');
    }

    /* =====================================================
       EDIT PAGE
    ===================================================== */
    public function edit($id)
    {
        $data['certificate'] = $this->db
            ->where('id', $id)
            ->get('certificates')
            ->row();

        if (!$data['certificate']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('admin/certificate_edit', $data);
        $this->load->view('admin/footer');
    }

    /* =====================================================
       UPDATE
    ===================================================== */
    public function update($id)
    {
        $row = $this->db->where('id', $id)->get('certificates')->row();

        if (!$row) {
            show_404();
        }

        $title = $this->input->post('title');
        $image = $row->image; // default old image

        // new image upload
        if (!empty($_FILES['image']['name'])) {

            $upload_path = FCPATH . 'uploads/certificate/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|webp|jfif';
            $config['encrypt_name']  = true;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {

                // delete old
                if (file_exists(FCPATH . $row->image)) {
                    unlink(FCPATH . $row->image);
                }

                $file  = $this->upload->data();
                $image = 'uploads/certificate/' . $file['file_name'];
            }
        }

        $this->db->where('id', $id)->update('certificates', [
            'title' => $title,
            'image' => $image
        ]);

        $this->session->set_flashdata('success', 'Certificate updated');
        redirect('admin/certificate');
    }

    /* =====================================================
       DELETE
    ===================================================== */
    public function delete($id)
    {
        $row = $this->db->where('id', $id)->get('certificates')->row();

        if ($row) {
            if (file_exists(FCPATH . $row->image)) {
                unlink(FCPATH . $row->image);
            }

            $this->db->where('id', $id)->delete('certificates');
        }

        $this->session->set_flashdata('success', 'Certificate deleted');
        redirect('admin/certificate');
    }

    /* =====================================================
       OPTIONAL STATUS TOGGLE
    ===================================================== */
    public function toggle($id, $status)
    {
        $this->db->where('id', $id)->update('certificates', [
            'isActive' => $status
        ]);

        redirect('admin/certificate');
    }
}
