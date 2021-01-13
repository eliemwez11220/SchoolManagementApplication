<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insert_model extends CI_Model {

    /**
     * @param $data
     * @param $table
     */
    public function insert_data($data, $table) {
        $this->db->insert($table, $data);
    }
    /**
     * la fonction pour inserer un enregistrement dans une table
     * @param $table
     * @param $data les données à inserer
     * @return bool
     */
    public function set_insert($table, $data){
        return $this->db->insert($table, $data);
    }
}
