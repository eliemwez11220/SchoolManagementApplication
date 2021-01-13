<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Passports_model extends CI_Model
{
    /**
     * passports_model constructor.
     */
    public $prefs;

    function __construct()
    {
        parent::__construct();

        $this->prefs = array(
            'start_day'    => 'monday',
            'month_type'   => 'long',
            'day_type'     => 'long',
            'show_next_prev' => TRUE,
            //'next_url' => base_url($this->session->role_utilisateur . '/vue_agents')
            'next_prev_url' => base_url().'admin/get_calendar/'
            //'next_prev_url' => base_url() . 'auth/get_calendar/'
        );
        $this->prefs['template'] = '

        {table_open}<table border="5" cellpadding="2" cellspacing="5" 
        class="table table-sm table-condensed table-bordered" style="font-size: 20px;">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th class="font-weight-bold"><a href="{previous_url}" class="btn btn-lg font-weight-bold btn-dark">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}" class="bg-light text-center text-uppercase" style="border-radius: 10px;">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}" class="btn btn-lg font-weight-bold btn-dark">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td class="bg-dark">{/cal_cell_start}
        {cal_cell_start_today}<td class="bg-success font-weight-bold text-center" style="font-size: 25px;">{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="#" class="text-success text-center" style="font-size: 25px;">{day} | {content}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day} |{content}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}';
    }

    public function get_calendrier($year, $month)
    {
        $this->load->library('calendar', $this->prefs);
        //$data = array(6 => 'Update effectif ', 9 => 'Update effectif ');
        $data=$this->get_calendar_db($year, $month);
        return $this->calendar->generate($year, $month, $data);
    }
    public function get_calendar_db($year, $month)
    {
        $query = $this->db->select('effectif, date_created')->from('tb_school_classes')->like('date_created',
            "$year-$month", 'after')->get();
        $cal_data=array();
        foreach ($query->result() as $row)
        {
            $calendar_date=date("Y-m-d", strtotime($row->calendar));
            $cal_data[substr($calendar_date, 8, 2)]=$row->nombre_agent;
        }
        return $cal_data;
    }
    /**
     * la fonction pour selectionner une seule ligne dans une table
     * @param $table
     * @param array $where condition de selection
     * @return un tableau d'une ligne
     */
    public function get_unique($table, $where = [])
    {
        return $query = $this->db->get_where($table, $where)->row();
    }

    /**
     * la fonction permettant de selectionner tous dans une table
     * @param $table
     * @param array $where la condition de selection
     * @param string $order_by l'ordre de tri
     * @return un tableau de resultat
     */
    function get_result($table, $where = [], string $order_by = '', $order = '', $per_page = [], $position = [])
    {
        $this->db->order_by($order_by, $order);
        $this->db->limit($per_page, $position);
        $query = $this->db->get_where($table, $where);
        return $query->result();
    }
    public function get_distinct($table, $select, $where = [], $order_by = '')
    {

        $this->db->order_by($order_by, 'DESC');
        $this->db->distinct();
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
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
    public function get_count($table, $where = [])
    {
        return $this->db->where($where)->count_all_results($table);
    }

    /**
     * la fonction pour supprimer un enregistrement dans une table
     * @param $table
     * @param array $where
     * @return bool
     */
    public function set_delete($table, $where = [])
    {
        return $this->db->delete($table, $where);
    }
    /*** EMAR get_join ***
     *
     ************** get_join une fonction parcourant une db à l'aide des clés étrangères ***************
     *
     * @author EMAR RUCHI
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
        array $table, array $join, array $where = [], string $select = '*', string $order_by, string $order = 'DESC', string $mode = 'result', $per_page = [], $position = [])
    {

        $join_var = [];
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
        $this->db->limit($per_page, $position);


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

}
