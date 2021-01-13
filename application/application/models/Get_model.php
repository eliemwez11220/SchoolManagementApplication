<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_model extends CI_Model
{
    /**
     *@ General get datas
     */
    public function get($table, $critere, $condition = false, $table_join = null, $key1 = null, $key2 = null, $details = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($condition) {
            // code...
            $this->db->join($table_join, "$table_join.$key1 = $table.$key2");

            if ($details == 'en attente') {
                // code...
                $this->db->where('tb_school_inscriptions.etat_inscription <=', 1);
                $this->db->order_by($critere, 'desc');
                $query = $this->db->get();
                return $query;
            } elseif ($details == 'traites') {
                // code...
                $this->db->where('tb_school_inscriptions.etat_inscription', 2);
                $this->db->order_by($critere, 'desc');
                $query = $this->db->get();
                return $query;
            } else {
                // code...
                $this->db->order_by($critere, 'desc');
                $query = $this->db->get();
                return $query;
            }
        } else {
            // code...
            $this->db->order_by($critere, 'desc');
            $query = $this->db->get();
            return $query;
        }
    }

    /**
     *@ General get join
     */
    public function get_join($table, $critere, $array = array(), $condition = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        // code...
        $condition = (int)$condition;

        foreach ($array as $v) {
            // code...
            $this->db->join($v[1], "$v[1].$v[2] = $table.$v[0]");
        }

        if ($condition AND is_int($condition) AND $condition != 0) {
            // code...
            if ($condition == 4) {
                // code...
                $this->db->where('etat_inscription', 4);
            } elseif ($condition == 3) {
                $this->db->where('etat_inscription', 3);
            } else {
                $this->db->where('etat_inscription <', 3);
            }
        }
        //elseif ($this->session->matricule) {
        // code...
        //$this->db->where('matricule_eleve', $this->session->matricule);
    //}

        $this->db->order_by($critere, 'desc');
        $query = $this->db->get();
        return $query;
    }

    /**
     *@ Get demande by month
     */
    public function get_demande_by_month()
    {
        $annee_encours = date('Y');
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('matricule_eleve, date_inscription');
            $this->db->from('tb_school_inscriptions');
            $this->db->where('MONTH(date_inscription)', $i);
            //$this->db->where('YEAR(date_inscription)', $annee_encours);

            $query[$i] = $this->db->get();
        }
        return $query;
    }

    /**
     *@ Get one
     */
    public function get_info_by_table_by_id($id, $table, $name_id)
    {
        return $this->db->get_where($table, array($name_id => $id))->row_array();
    }

    /**
     *@ Get one
     */
    public function get_Last_info($table, $field, $critere)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($field, $critere);
        $this->db->limit(1);
        $query = $this->db->get()->row_array();
        return $query;

    }


    # recuperation des demandes livrees durant l'annee encours
    public function get_livraisons()
    {
        $annee_encours = 2018; //date('Y');
        # code...
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('*');
            $this->db->from('tb_school_inscriptions');
            $this->db->where('YEAR(date_inscription)', $annee_encours);
            $query[$i] = $this->db->get();
        }
        return $query;
    }


# ============================= fonctions de verification des doublons =====================================

    /**
     *@ Get one information
     */
    public function get_onces($id, $rubrique)
    {
        return $this->db->get_where('tb_school_' . $rubrique . 's', array('id_' . $rubrique => $id))->row_array();
    }

    /**
     *@ Get one information in view request
     */
    public function get_view_onces($id, $rubrique, $champs)
    {
        return $this->db->get_where('view_school_' . $rubrique . 's', array($champs => $id))->row_array();
    }
/**
     *@ Get one information in view request
     */
    public function get_all_onces($rubrique,$matricule, $annee, $cycle, $etat)
    {
        return $this->db->get_where($rubrique, array('matricule_eleve' => $matricule,'annee_scolaire' => $annee,'cycle' => $cycle,'etat_inscription' => $etat))->row_array();
    }

    /**
     *@ Get one student
     */
    public function get_eleve($id)
    {
        return $this->db->get_where('tb_school_eleves', array('matricule_eleve' => $id))->row_array();
    }

    /**
     *@ Get one student - parcours scoalaire
     */
    public function get_parcours_eleve($id)
    {
        return $this->db->get_where('tb_school_inscriptions', array('matricule_eleve' => $id))->row_array();
    }

    public function get_classe($name)
    {

        $this->db->where('nom_classe', $name);
        $query = $this->db->get('tb_school_classes')->result();
        if ($query) {
            return $query[0];
        } else {
            return false;
        }
    }

    public function get_option_existant($name)
    {

        $this->db->where('nom_option', $name);
        $query = $this->db->get('tb_school_options')->result();
        if ($query) {
            return $query[0];
        } else {
            return false;
        }
    }

    public function get_section_existant($name)
    {

        $this->db->where('nom_section', $name);
        $query = $this->db->get('tb_school_sections')->result();
        if ($query) {
            return $query[0];
        } else {
            return false;
        }
    }

    public function user_existant($user_name)
    {
        $this->db->where('asset_username', $user_name);
        $query = $this->db->get('tb_school_assets')->result();
        if ($query) {
            return $query[0];
        } else {
            return false;
        }
    }

    /**
     *@ Get demande by month encours de validation
     */
    public function get_inscriptions_encours()
    {
        $annee_encours = date('Y');
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('matricule_eleve, date_inscription');
            $this->db->from('tb_school_inscriptions');
            $this->db->where('MONTH(date_inscription)', $i);
            $this->db->where('etat_inscription', 'en attente');
            //$this->db->where('YEAR(date_inscription)', $annee_encours);

            $query[$i] = $this->db->get();
        }
        return $query;
    }

    /**
     *@ Get demande by month encours de validation
     */
    public function get_inscriptions_traitees()
    {
        $annee_encours = date('Y');
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('matricule_eleve, date_inscription');
            $this->db->from('tb_school_inscriptions');
            $this->db->where('MONTH(date_inscription)', $i);
            $this->db->where('etat_inscription', 'validé');
            //$this->db->where('YEAR(date_inscription)', $annee_encours);
            $query[$i] = $this->db->get();
        }
        return $query;
    }
    #======================================paiements frais functions============================================
    #-----------------------------------------------------------------------------------------------------------

    /**
     *@ Get demande by month encours de validation
     */
    public function get_paiements_encours()
    {
        $annee_encours = date('Y');
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('matricule_eleve, date_paiement');
            $this->db->from('tb_school_paiements');
            $this->db->where('MONTH(date_paiement)', $i);
            $this->db->where('statut_paiement', 'en attente');
            //$this->db->where('YEAR(date_inscription)', $annee_encours);

            $query[$i] = $this->db->get();
        }
        return $query;
    }

    /**
     *@ Get demande by month encours de validation
     */
    public function get_paiements_amorces()
    {
        $annee_encours = date('Y');
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('matricule_eleve, date_validation');
            $this->db->from('tb_school_paiements');
            $this->db->where('MONTH(date_validation)', $i);
            $this->db->where('statut_paiement', 'amorcé');
            //$this->db->where('YEAR(date_inscription)', $annee_encours);

            $query[$i] = $this->db->get();
        }
        return $query;
    }

    /**
     *@ Get demande by month encours de validation
     */
    public function get_paiements_traitees()
    {
        $annee_encours = date('Y');
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $this->db->select('matricule_eleve, date_validation');
            $this->db->from('tb_school_paiements');
            $this->db->where('MONTH(date_validation)', $i);
            $this->db->where('statut_paiement', 'validé');
            //$this->db->where('YEAR(date_inscription)', $annee_encours);
            $query[$i] = $this->db->get();
        }
        return $query;
    }
}
