<?php

#controlador de Login

defined('BASEPATH') OR exit('No direct script access allowed');

class Consultor extends CI_Controller {

    public function __construct() {
        parent::__construct();

        #load libraries
        $this->load->helper(array('form', 'url', 'date', 'string'));
        #$this->load->library(array('basico', 'Basico_model', 'form_validation'));
        $this->load->library(array('basico', 'form_validation'));
        $this->load->model(array('Basico_model', 'Funcao_model', 'Consultor_model'));
        #$this->load->model(array('Basico_model', 'Consultor_model'));
        $this->load->driver('session');

        #load header view
        $this->load->view('basico/headerfuncionario');
        $this->load->view('basico/nav_principalfuncionario');

        #$this->load->view('consultor/nav_secundario');
    }

    public function index() {

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        $this->load->view('consultor/tela_index', $data);

        #load footer view
        $this->load->view('basico/footer');
    }

    public function cadastrar() {

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        $data['query'] = quotes_to_entities($this->input->post(array(
			'idSis_Usuario',
			'idApp_Consultor',
			'Usuario',
            'NomeConsultor',
			'Senha',
			'Confirma',
            'DataNascimento',
            'Celular',
			'Email',
            'Sexo',
			#'Permissao',
			#'Funcao',
			'Inativo',
			'DataCriacao',
			'QuemCad',
			'Associado',
			'Cpf',
			'Rg',
			'OrgaoExp',
			'EstadoExp',
			'DataExp',			
			'Cep',
            'Telefone2',
            'Telefone3',
            'Endereco',
            'Bairro',
            'Municipio',
			'Estado',
			'Titulo',
			'Obs',

        ), TRUE));

        (!$data['query']['DataCriacao']) ? $data['query']['DataCriacao'] = date('d/m/Y', time()) : FALSE;
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

		$this->form_validation->set_rules('Email', 'E-mail', 'trim|valid_email|is_unique[App_Consultor.Email]');
        $this->form_validation->set_rules('Usuario', 'Usuário', 'required|trim|is_unique[App_Consultor.Usuario]');
		$this->form_validation->set_rules('NomeConsultor', 'NomeConsultor do Usuário', 'required|trim');
		$this->form_validation->set_rules('Senha', 'Senha', 'required|trim');
        $this->form_validation->set_rules('Confirma', 'Confirmar Senha', 'required|trim|matches[Senha]');
        $this->form_validation->set_rules('DataNascimento', 'Data de Nascimento', 'trim|valid_date');
		$this->form_validation->set_rules('DataExp', 'Data de Emissão', 'trim|valid_date');
        $this->form_validation->set_rules('Celular', 'Celular', 'required|trim');
		#$this->form_validation->set_rules('Permissao', 'Nível', 'required|trim');
		#$this->form_validation->set_rules('Funcao', 'Funcao', 'required|trim');

        $data['select']['Sexo'] = $this->Basico_model->select_sexo();
		#$data['select']['Consultor'] = $this->Basico_model->select_status_sn();
		$data['select']['Inativo'] = $this->Basico_model->select_inativo();
		$data['select']['Permissao'] = $this->Basico_model->select_permissao();
		$data['select']['Funcao'] = $this->Funcao_model->select_funcao();

        $data['titulo'] = 'Cadastrar Consultor';
        $data['form_open_path'] = 'consultor/cadastrar';
        $data['readonly'] = '';
        $data['disabled'] = '';
        $data['panel'] = 'primary';
        $data['metodo'] = 1;
		
        if ($data['query']['Sexo'] || $data['query']['Endereco'] || $data['query']['Bairro'] ||
			$data['query']['Municipio'] || $data['query']['Estado'] || $data['query']['Obs'] || $data['query']['Email'] || 
			$data['query']['Cep'] || $data['query']['Cpf'] || $data['query']['Rg']  || $data['query']['OrgaoExp'] || 
			$data['query']['EstadoExp']  || $data['query']['DataExp'])
            $data['collapse'] = '';
        else
            $data['collapse'] = 'class="collapse"';		

        $data['sidebar'] = 'col-sm-3 col-md-2';
        $data['main'] = 'col-sm-7 col-md-8';

        $data['tela'] = $this->load->view('consultor/form_consultor', $data, TRUE);

        #run form validation
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('consultor/form_consultor', $data);
        } else {

			$data['query']['idSis_Usuario'] = $_SESSION['log']['id'];
			$data['query']['Empresa'] = $_SESSION['log']['Empresa'];
            $data['query']['NomeEmpresa'] = $_SESSION['log']['NomeEmpresa'];
			$data['query']['idSis_EmpresaMatriz'] = $_SESSION['log']['Empresa'];
			$data['query']['Associado'] = 1;
			$data['query']['QuemCad'] = $_SESSION['log']['id'];
			$data['query']['Senha'] = md5($data['query']['Senha']);
			$data['query']['DataNascimento'] = $this->basico->mascara_data($data['query']['DataNascimento'], 'mysql');
			$data['query']['DataExp'] = $this->basico->mascara_data($data['query']['DataExp'], 'mysql');
            $data['query']['DataCriacao'] = $this->basico->mascara_data($data['query']['DataCriacao'], 'mysql');
			$data['query']['Codigo'] = md5(uniqid(time() . rand()));
            $data['query']['idTab_Modulo'] = $_SESSION['log']['idTab_Modulo'];
			$data['query']['Inativo'] = 0;
			$data['query']['Nivel'] = 3;
			$data['query']['Permissao'] = 3;
			$data['query']['Funcao'] = 1;
            unset($data['query']['Confirma']);
			#unset($data['query']['Confirma'], $data['query']['ConfirmarEmail']);

            $data['campos'] = array_keys($data['query']);
            $data['anterior'] = array();

            $data['idApp_Consultor'] = $this->Consultor_model->set_consultor($data['query']);

            if ($data['idApp_Consultor'] === FALSE) {
                $msg = "<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>";

                $this->basico->erro($msg);
                $this->load->view('consultor/form_consultor', $data);
            } else {

                $data['auditoriaitem'] = $this->basico->set_log($data['anterior'], $data['query'], $data['campos'], $data['idApp_Consultor'], FALSE);
                $data['auditoria'] = $this->Basico_model->set_auditoria($data['auditoriaitem'], 'App_Consultor', 'CREATE', $data['auditoriaitem']);
                $data['msg'] = '?m=1';
				/*
				$data['agenda'] = array(
                    'NomeAgenda' => 'Padrão',
					'Empresa' => $_SESSION['log']['Empresa'],
                    'idApp_Consultor' => $data['idApp_Consultor']
                );
                $data['campos'] = array_keys($data['agenda']);

                $data['idApp_Agenda'] = $this->Consultor_model->set_agenda($data['agenda']);
				$data['auditoriaitem'] = $this->basico->set_log($data['anterior'], $data['agenda'], $data['campos'], $data['idApp_Consultor']);
                $data['auditoria'] = $this->Basico_model->set_auditoria($data['auditoriaitem'], 'App_Agenda', 'CREATE', $data['auditoriaitem'], $data['idApp_Consultor']);
				*/
				redirect(base_url() . 'consultor/prontuario/' . $data['idApp_Consultor'] . $data['msg']);
				#redirect(base_url() . 'relatorio/consultor/' .  $data['msg']);
                exit();
            }
        }

        $this->load->view('basico/footer');
    }

    public function alterar($id = FALSE) {

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        $data['query'] = $this->input->post(array(

			'idApp_Consultor',
			#'Usuario',
            'NomeConsultor',
            'DataNascimento',
            'Celular',
            'Email',
			'Sexo',
			#'Permissao',
			#'Funcao',
			'Inativo',
			'Cpf',
			'Rg',
			'OrgaoExp',
			'EstadoExp',
			'DataExp',			
			'Cep',
            'Telefone2',
            'Telefone3',
            'Endereco',
            'Bairro',
            'Municipio',
			'Estado',
			'Titulo',
			'Obs',

        ), TRUE);

        if ($id) {
            $data['query'] = $this->Consultor_model->get_consultor($id);
            $data['query']['DataNascimento'] = $this->basico->mascara_data($data['query']['DataNascimento'], 'barras');
			$data['query']['DataExp'] = $this->basico->mascara_data($data['query']['DataExp'], 'barras');
        }

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        #$this->form_validation->set_rules('NomeConsultor', 'NomeConsultor do Responsável', 'required|trim|is_unique_duplo[App_Consultor.NomeConsultor.DataNascimento.' . $this->basico->mascara_data($data['query']['DataNascimento'], 'mysql') . ']');
        $this->form_validation->set_rules('NomeConsultor', 'NomeConsultor do Responsável', 'required|trim');
        $this->form_validation->set_rules('DataNascimento', 'Data de Nascimento', 'trim|valid_date');
        $this->form_validation->set_rules('DataExp', 'Data de Emissão', 'trim|valid_date');
		$this->form_validation->set_rules('Celular', 'Celular', 'required|trim');
        $this->form_validation->set_rules('Email', 'E-mail', 'trim|valid_email');
		#$this->form_validation->set_rules('Permissao', 'Nível', 'required|trim');
		#$this->form_validation->set_rules('Funcao', 'Funcao', 'required|trim');

        $data['select']['Municipio'] = $this->Basico_model->select_municipio();
        $data['select']['Sexo'] = $this->Basico_model->select_sexo();
		#$data['select']['Consultor'] = $this->Basico_model->select_status_sn();
		$data['select']['Inativo'] = $this->Basico_model->select_inativo();
		$data['select']['Permissao'] = $this->Basico_model->select_permissao();
		$data['select']['Funcao'] = $this->Funcao_model->select_funcao();

        $data['titulo'] = 'Editar Consultor';
        $data['form_open_path'] = 'consultor/alterar';
        $data['readonly'] = '';
        $data['disabled'] = '';
        $data['panel'] = 'primary';
        $data['metodo'] = 2;

        if ($data['query']['Sexo'] || $data['query']['Endereco'] || $data['query']['Bairro'] ||
			$data['query']['Municipio'] || $data['query']['Estado'] || $data['query']['Obs'] || $data['query']['Email'] || 
			$data['query']['Cep'] || $data['query']['Cpf'] || $data['query']['Rg']  || $data['query']['OrgaoExp'] || 
			$data['query']['EstadoExp']  || $data['query']['DataExp'])
            $data['collapse'] = '';
        else
            $data['collapse'] = 'class="collapse"';

        $data['nav_secundario'] = $this->load->view('consultor/nav_secundario', $data, TRUE);

        $data['sidebar'] = 'col-sm-3 col-md-2 sidebar';
        $data['main'] = 'col-sm-7 col-sm-offset-3 col-md-8 col-md-offset-2 main';

        #run form validation
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('consultor/form_consultoralterar', $data);
        } else {

            $data['query']['NomeConsultor'] = trim(mb_strtoupper($data['query']['NomeConsultor'], 'ISO-8859-1'));
            $data['query']['DataNascimento'] = $this->basico->mascara_data($data['query']['DataNascimento'], 'mysql');
			$data['query']['DataExp'] = $this->basico->mascara_data($data['query']['DataExp'], 'mysql');
            #$data['query']['Obs'] = nl2br($data['query']['Obs']);


            $data['anterior'] = $this->Consultor_model->get_consultor($data['query']['idApp_Consultor']);
            $data['campos'] = array_keys($data['query']);

            $data['auditoriaitem'] = $this->basico->set_log($data['anterior'], $data['query'], $data['campos'], $data['query']['idApp_Consultor'], TRUE);

            if ($data['auditoriaitem'] && $this->Consultor_model->update_consultor($data['query'], $data['query']['idApp_Consultor']) === FALSE) {
                $data['msg'] = '?m=2';
                redirect(base_url() . 'consultor/form_consultoralterar/' . $data['query']['idApp_Consultor'] . $data['msg']);
                exit();
            } else {

                if ($data['auditoriaitem'] === FALSE) {
                    $data['msg'] = '';
                } else {
                    $data['auditoria'] = $this->Basico_model->set_auditoria($data['auditoriaitem'], 'App_Consultor', 'UPDATE', $data['auditoriaitem']);
                    $data['msg'] = '?m=1';
                }

                redirect(base_url() . 'consultor/prontuario/' . $data['query']['idApp_Consultor'] . $data['msg']);
                exit();
            }
        }

        $this->load->view('basico/footer');
    }

    public function excluir($id = FALSE) {

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        $this->Consultor_model->delete_consultor($id);

        $data['msg'] = '?m=1';

		redirect(base_url() . 'relatoriofuncionario/consultores' . $data['msg']);
		exit();

        $this->load->view('basico/footer');
    }

    public function pesquisar() {

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        $this->form_validation->set_rules('Pesquisa', 'Pesquisa', 'required|trim|callback_get_consultor');

        if ($this->input->get('start') && $this->input->get('end')) {
            //$data['start'] = substr($this->input->get('start'),0,-3);
            //$data['end'] = substr($this->input->get('end'),0,-3);
            $_SESSION['agenda']['HoraInicio'] = substr($this->input->get('start'),0,-3);
            $_SESSION['agenda']['HoraFim'] = substr($this->input->get('end'),0,-3);
        }

        $data['titulo'] = "Pesquisar Consultor";

        $data['Pesquisa'] = $this->input->post('Pesquisa');
        //echo date('d/m/Y H:i:s', $data['start'],0,-3));

        #run form validation
        if ($this->form_validation->run() !== FALSE && $this->Consultor_model->lista_consultor($data['Pesquisa'], FALSE) === TRUE) {

            $data['query'] = $this->Consultor_model->lista_consultor($data['Pesquisa'], TRUE);

            if ($data['query']->num_rows() == 1) {
                $info = $data['query']->result_array();

                if ($_SESSION['agenda'])
                    redirect('consulta/cadastrar/' . $info[0]['idApp_Consultor'] );
                else
                    redirect('consultor/prontuario/' . $info[0]['idApp_Consultor'] );

                exit();
            } else {
                $data['list'] = $this->load->view('consultor/list_consultor', $data, TRUE);
            }

        }

        ($data['Pesquisa']) ? $data['cadastrar'] = TRUE : $data['cadastrar'] = FALSE;

        $this->load->view('consultor/pesq_consultor', $data);

        $this->load->view('basico/footer');
    }

    public function prontuario($id) {

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        $_SESSION['Consultor'] = $data['query'] = $this->Consultor_model->get_consultor($id, TRUE);
        #$data['query'] = $this->Paciente_model->get_paciente($prontuario, TRUE);
        $data['titulo'] = 'Prontuário ' . $data['query']['NomeConsultor'];
        $data['panel'] = 'primary';
        $data['metodo'] = 4;

        $_SESSION['log']['idApp_Consultor'] = $data['resumo']['idApp_Consultor'] = $data['query']['idApp_Consultor'];
        $data['resumo']['NomeConsultor'] = $data['query']['NomeConsultor'];

        $data['query']['Idade'] = $this->basico->calcula_idade($data['query']['DataNascimento']);
        $data['query']['DataNascimento'] = $this->basico->mascara_data($data['query']['DataNascimento'], 'barras');

        /*
        if ($data['query']['Sexo'] == 1)
            $data['query']['profile'] = 'm';
        elseif ($data['query']['Sexo'] == 2)
            $data['query']['profile'] = 'f';
        else
            $data['query']['profile'] = 'o';
        */
        $data['query']['profile'] = ($data['query']['Sexo']) ? strtolower($data['query']['Sexo']) : 'o';

        $data['query']['Sexo'] = $this->Basico_model->get_sexo($data['query']['Sexo']);
		$data['query']['Inativo'] = $this->Basico_model->get_inativo($data['query']['Inativo']);
		$data['query']['Funcao'] = $this->Basico_model->get_funcao($data['query']['Funcao']);
		$data['query']['Permissao'] = $this->Basico_model->get_permissao($data['query']['Permissao']);
		$data['query']['Empresa'] = $this->Basico_model->get_empresa($data['query']['Empresa']);
		#$data['query']['Consultor'] = $data['query']['Consultor'];

        $data['query']['Telefone'] = $data['query']['Celular'];

        $data['contatoconsultor'] = $this->Consultor_model->lista_contatoconsultor($id, TRUE);
        /*
          echo "<pre>";
          print_r($data['contatoconsultor']);
          echo "</pre>";
          exit();
          */
        if (!$data['contatoconsultor'])
            $data['list'] = FALSE;
        else
            $data['list'] = $this->load->view('consultor/list_contatoconsultor', $data, TRUE);

        $data['nav_secundario'] = $this->load->view('consultor/nav_secundario', $data, TRUE);
        $this->load->view('consultor/tela_consultor', $data);

        $this->load->view('basico/footer');
    }

    function get_consultor($data) {

        if ($this->Consultor_model->lista_consultor($data, FALSE) === FALSE) {
            $this->form_validation->set_message('get_consultor', '<strong>Consultor</strong> não encontrado.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
