<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_model extends CI_Model {

    public function update_data($id, $table, $datas, $type_field = false) {
        $field = ($type_field) ? 'id_'.substr($table, 0, strlen($table)-1) : 'matricule_eleve';
        $this->db->where($field, $id);
        $this->db->update('tb_school_'.$table, $datas);
    }

    public function update_join_data($value_join, $id_join, $table, $datas) {
        $this->db->where($id_join, $value_join);
        $this->db->update('tb_school_'.$table, $datas);
    }

    public function update_data_by_table_and_field($name_field, $value_field, $table, $datas) {
        $this->db->where($name_field, $value_field);
        $this->db->update($table, $datas);
    }
    //function updating data
    public function set_update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }
}
