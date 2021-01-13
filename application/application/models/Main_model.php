<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
    /**
     *@ infos of admin
     */
    public function infos_admin($username, $password){

        $this->db->where('asset_username', $username);
        $this->db->where('asset_type', 'administrator');
        $query = $this->db->get('tb_school_assets')->result();
        if($query){
            if(password_verify($password,$query[0]->asset_password)){
                return $query[0];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function admin_existant()
    {
        $this->db->select('*');
        $this->db->from('tb_school_assets');
        $this->db->where('asset_type', 'administrator');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    /**
     *@ infos of visitor
     */
    public function infos_eleve($matricule){
        $this->db->select('*');
        $this->db->from('tb_school_eleves');
        $this->db->join('tb_school_inscriptions', 'tb_school_inscriptions.matricule_eleve = tb_school_eleves.matricule_eleve');
        $this->db->where('tb_school_eleves.matricule_eleve', $matricule);
        // $this->db->where('demande_observation', '');
        $query = $this->db->get()->result();
        if ($query) {
          // code...
          return $query[0];
        } else {
          // code...
          return false;
        }
    }
    /**
     * get All Administrator
     */
    public function getAllAdmin(){

        $this->db->select('asset_email,asset_username');
        $this->db->from('tb_school_assets');
        $this->db->where('asset_type', 'administrator');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    /**
     *@ infos of agent
     */
    public function infos_agent($username, $password){

        $this->db->where('asset_username', $username);
        $this->db->where('asset_type', 'utilisateur');
        $query = $this->db->get('tb_school_assets')->result();
        if($query){
            if(password_verify($password,$query[0]->asset_password)){
                return $query[0];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     *@ infos of agent
     */
    public function info_by_email($email){

        $this->db->where('asset_email', $email);
        $query = $this->db->get('tb_school_assets')->result();
        if($query){
            if($query[0] != null){
                return $query[0];
            }else return false;

        }else{
            return false;
        }
    }

    public function user_existant($username, $email){

        $this->db->where('asset_username', $username);
        $this->db->where('asset_email', $email);
        $query = $this->db->get('tb_school_assets')->result();
        if($query){
            return $query[0];
        }else{
            return false;
        }
    }

    public function delete_data ($rubriques, $id) {
      $criteria = 'id_' .substr($rubriques, 0, strlen($rubriques)-1);
      $this->db->where($criteria, $id);
      $this->db->delete('tb_school_'.$rubriques);
    }

    public function update_data ($id, $rubriques, $etat) {
      $criteria = 'id_' .substr($rubriques, 0, strlen($rubriques)-1);
      $this->db->where($criteria, $id);
      if ($etat == 0) {
        // code...
        $this->db->update('tb_school_'.$rubriques, ['status' => 1]);
      } else {
        // code...
        $this->db->update('tb_school_'.$rubriques, ['status' => 0]);
      }
    }
}
