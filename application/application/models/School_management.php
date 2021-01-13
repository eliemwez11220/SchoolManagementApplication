<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_management extends CI_Model
{

    /**
     * Masomo_meneja_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * la fonction permettant de selectionner tous dans une table
     * @param $table
     * @param array $where la condition de selection
     * @param string $order_by l'ordre de tri
     * @return un tableau de resultat
     */
    function get_result($table, $where = array(), string $order_by = '', $order = '', $per_page = array(), $position = array())
    {
        $this->db->order_by($order_by, $order);
        $this->db->limit($per_page, $position);
        $query = $this->db->get_where($table, $where);
        return $query->result();
    }

    /**
     * la fonction permettant de selectionner dans une table avec de façon distincte
     * @param $table
     * @param $select elements à selectionner
     * @param array $where condition de selection
     * @param string $order_by l'ordre de selection
     * @return un tableau de resultat
     */
    public function get_distinct($table, $select, $where = array(), $order_by = '')
    {

        $this->db->order_by($order_by, 'DESC');
        $this->db->distinct();
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
    }

    /**
     * la fonction pour selectionner une seule ligne dans une table
     * @param $table
     * @param array $where condition de selection
     * @return un tableau d'une ligne
     */
    public function get_unique($table, $where = array())
    {
        return $query = $this->db->get_where($table, $where)->row();
    }

    /**
     * la fonction pour inserer un enregistrement dans une table
     * @param $table
     * @param $data les données à inserer
     * @return bool
     */
    public function set_insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    /**
     * la fonction permettant de modifier un enregistrement dans une table
     * @param $table
     * @param $data les donnees à modifier
     * @param $where la condition de modification
     * @return bool
     */
    public function set_update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    /**
     * la fonction pour compter le nombre d'enregistrements dans une table
     * @param $table
     * @param array $where
     * @return bool
     */
    public function get_count($table, $where = array())
    {
        return $this->db->where($where)->count_all_results($table);
    }

    /**
     * la fonction pour supprimer un enregistrement dans une table
     * @param $table
     * @param array $where
     * @return bool
     */
    public function set_delete($table, $where = array())
    {
        return $this->db->delete($table, $where);
    }

    /**
     * la fonction pour constituer sa propre requete
     * @param $req la requete attentue
     * @return mixed
     */
    public function get_req($req)
    {
        return $this->db->query($req);
    }

    /*** Joflamme get_join ***
     *
     ************** get_join une fonction parcourant une db à l'aide des clés étrangères ***************
     *
     * @author elie mwez
     * @version 1.3.0
     *
     *
     * @param array $table : les tables par ordre de jointure
     * @param array $join : les champs de jointure dans les tables, length = length of tables moins un
     * @param array $where : une ou plusieurs conditions sur WHERE, default = []
     * @param string $select : les champs sélectionnés sur SELECT, default = *
     * @param string $order_by : l'ordre de tri des elements apres jointure
     * @param string $order
     * @param string $mode : fetching mode, choisir entre result et row, default = default
     * @param array $per_page : nombre d'enregistrements de la selection
     * @param array $position : valeur de début du nombre d'enregistrements
     * @return string|result|bool : valeur de retour de la fonction soit une chaine des caractères, un tableau ou encore false
     */
    public function get_join(
        array $table, array $join, array $where = array(), $select = '*', $order_by, $order = 'DESC', $mode = 'result', $per_page = array(), $position = array())
    {

        $join_var = array();
        $size_table = sizeof($table);
        $size_join = sizeof($join);

        if ($size_join != ($size_table - 1))
            return "Vos tables ne sont pas compatibles avec vos joins !";

        for ($i = 0; $i < $size_table; $i++) {

            if ($i != ($size_table - 1)) {

                $join_var[] = $table[$i + 1] . ',' . $table[$i] . ',' . $join[$i] . ',' . $table[$i + 1] . ',' . $join[$i];
            }
        }

        $this->db->distinct();
        $this->db->select($select);
        $this->db->order_by($order_by, $order);
        $this->db->where($where);
        $this->db->from($table[0]);
        if(!empty($per_page)){
            $this->db->limit($per_page, $position);
        }

        foreach ($join_var as $joint_var_item) {

            $explode_by_jlk = explode(',', $joint_var_item);
            $this->db->join($explode_by_jlk[0], $explode_by_jlk[1] . '.' . $explode_by_jlk[2] . ' = ' . $explode_by_jlk[3] . '.' . $explode_by_jlk[4], 'left');
        }

        return $query = $this->db->get()->$mode();

    }

    /**
     * la fonction permettant d'importer un fichier lors d'une insertion dans une table
     * @param $table
     * @param $data
     * @return bool
     */
    function import_data($table, $data)
    {

        if ($this->db->insert_batch($table, $data)) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
    public function get_joins($table, $critere, $array = array(), $condition = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        // code...
        $condition = (int)$condition;

        foreach ($array as $v) {
            // code...
            //$this->db->join($v[1], "$v[1].$v[2].$v[3].$v[4] = $table.$v[0]");
            $this->db->join($v[0], $v[1] . '.' . $v[2] . '.' . $v[3] . ' = ' . $v[4] . '.' . $v[5], 'left');
        }
        $this->db->order_by($critere, 'desc');
        $query = $this->db->get();
        return $query;
    }
}