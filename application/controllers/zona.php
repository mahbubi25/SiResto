<?php

defined('BASEPATH') or exit('No direct script access allowed');

class zona extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id_pegawai'))) {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->load->model('zona_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Pegawai';
        $data['zona'] = $this->zona_model->get_zona();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/zona/index');
        $this->load->view('admin/layout/footer');
    }
    public function tambah_waktu()
{
    $this->form_validation->set_rules(
        'waktu',
        'waktu',
        'required|is_unique[zona.waktu]',
        array(
            'is_unique' => 'waktu bertabrakan!'
        )
    );

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
    } else {
        $this->zona_model->tambah_waktu();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Menambah Data waktu</div>');
    }
    redirect('zona');
}

public function edit_waktu()
{
    $this->form_validation->set_rules('waktu', 'waktu', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
    } else {
        $this->zona_model->edit_waktu();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses Mengedit Data waktu</div>');
    }
    redirect('zona');
}

    public function get_zona_by_id($id)
    {
        echo json_encode($this->zona_model->get_zona_by_id($id));
    }

    public function hapus_waktu($id)
    {
        $this->zona_model->hapus_waktu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Sukses Hapus Data Waktu
       </div>');
        redirect('zona');
    }
}

