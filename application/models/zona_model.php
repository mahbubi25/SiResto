<?php

defined('BASEPATH') or exit('No direct script access allowed');

class zona_model extends CI_Model
{
    public function get_zona()
    {
        $query = $this->db->query("SELECT * FROM zona");
        return $query->result_array();
    }

    public function get_zona_kosong_by_date($array)
    {
        $query =  $this->db->query("SELECT * FROM zona WHERE id_jam NOT IN ( '" . implode("', '", $array) . "' )");
        return $query->result_array();
    }

    public function tambah_waktu()
    {
        $data = [
            'waktu' => htmlspecialchars($this->input->post('waktu', true)),
        ];
        $this->db->insert('zona', $data);
    }

    public function edit_waktu()
    {
        $data = [
            "waktu" => $this->input->post('waktu', true)
        ];
        $this->db->where('id_jam', $this->input->post('id_jam'));
        $this->db->update('zona', $data);
    }

    public function hapus_waktu($id)
    {
        $this->db->where('id_jam', $id);
        $this->db->delete('zona');
    }

    public function get_zona_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM zona WHERE id_jam = $id");
        return $query->row();
    }
}
