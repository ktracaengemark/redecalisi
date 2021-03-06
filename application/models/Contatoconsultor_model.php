<?php

#modelo que verifica usu�rio e senha e loga o usu�rio no sistema, criando as sess�es necess�rias

defined('BASEPATH') OR exit('No direct script access allowed');

class Contatoconsultor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('basico');
        $this->load->model(array('Basico_model'));
    }
    
    public function set_contatoconsultor($data) {

        $query = $this->db->insert('App_ContatoConsultor', $data);

        if ($this->db->affected_rows() === 0) {
            return FALSE;
        } else {
            #return TRUE;
            return $this->db->insert_id();
        }
    }

    public function get_contatoconsultor($data) {
        $query = $this->db->query('SELECT * FROM App_ContatoConsultor WHERE idApp_ContatoConsultor = ' . $data);
        
        $query = $query->result_array();

        return $query[0];
    }

    public function update_contatoconsultor($data, $id) {

        unset($data['Id']);
        $query = $this->db->update('App_ContatoConsultor', $data, array('idApp_ContatoConsultor' => $id));
        /*
          echo $this->db->last_query();
          echo '<br>';
          echo "<pre>";
          print_r($query);
          echo "</pre>";
          exit ();
         */
        if ($this->db->affected_rows() === 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_contatoconsultor($data) {
        $query = $this->db->delete('App_ContatoConsultor', array('idApp_ContatoConsultor' => $data));

        if ($this->db->affected_rows() === 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function lista_contatoconsultor($x) {

        $query = $this->db->query('SELECT * '
                . 'FROM App_ContatoConsultor WHERE '
                . 'idApp_Consultor = ' . $_SESSION['Consultor']['idApp_Consultor'] . ' '
                . 'ORDER BY NomeContatoConsultor ASC ');
        /*
          echo $this->db->last_query();
          echo "<pre>";
          print_r($query);
          echo "</pre>";
          exit();
         */
        if ($query->num_rows() === 0) {
            return FALSE;
        } else {
            if ($x === FALSE) {
                return TRUE;
            } else {
                foreach ($query->result() as $row) {
                    $row->Idade = $this->basico->calcula_idade($row->DataNascimento);
                    $row->DataNascimento = $this->basico->mascara_data($row->DataNascimento, 'barras');
                    $row->Sexo = $this->Basico_model->get_sexo($row->Sexo);
					$row->RelaPes = $this->Basico_model->get_relapes($row->RelaPes);
                }

                return $query;
            }
        }
    }
    
    public function select_status_vida($data = FALSE) {

        if ($data === TRUE) {
            $array = $this->db->query('SELECT * FROM Tab_StatusVida');
        } else {
            $query = $this->db->query('SELECT * FROM Tab_StatusVida');

            $array = array();
            foreach ($query->result() as $row) {
                $array[$row->Abrev] = $row->StatusVida;
            }
        }

        return $array;
    }    

}
