<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggestion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ⭐ LIST PAGE
    public function index()
    {
        $data['suggestions'] = $this->db
            ->order_by('id', 'DESC')
            ->get('suggestions')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/suggestion_list', $data);
        $this->load->view('admin/footer');
    }

    // ⭐ DELETE
    public function delete($id)
    {
        $this->db->where('id', $id)->delete('suggestions');

        $this->session->set_flashdata('success', 'Suggestion deleted');
        redirect('admin/suggestion');
    }
}
