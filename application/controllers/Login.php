<?php

#controlador de Login

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array('Loginconsultor_model', 'Basico_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('basico', 'form_validation', 'user_agent', 'email'));
        $this->load->driver('session');

        #load header view
        $this->load->view('basico/headerloginconsultor');

        if ($this->agent->is_browser()) {

            if (
                    (preg_match("/(chrome|Firefox)/i", $this->agent->browser()) && $this->agent->version() < 30) ||
                    (preg_match("/(safari)/i", $this->agent->browser()) && $this->agent->version() < 6) ||
                    (preg_match("/(opera)/i", $this->agent->browser()) && $this->agent->version() < 12) ||
                    (preg_match("/(internet explorer)/i", $this->agent->browser()) && $this->agent->version() < 9 )
            ) {
                $msg = '<h2><strong>Navegador não suportado.</strong></h2>';

                echo $this->basico->erro($msg);
                exit();
            }
        }
    }

    public function index() {

        #$_SESSION['log']['cliente'] = $_SESSION['log']['nome_modulo'] =
        $_SESSION['log']['nome_modulo'] = $_SESSION['log']['modulo'] = $data['modulo'] = $data['nome_modulo'] = 'varejo';
        $_SESSION['log']['idTab_Modulo'] = 1;

        ###################################################
        #só pra eu saber quando estou no banco de testes ou de produção
        #$CI = & get_instance();
        #$CI->load->database();
        #if ($CI->db->database != 'sishuap')
        #echo $CI->db->database;
        ###################################################
        #change error delimiter view
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        #Get GET or POST data
        $usuario = $this->input->get_post('Usuario');
		#$nomeempresa = $this->input->get_post('NomeEmpresa');
        $senha = md5($this->input->get_post('Senha'));

        #set validation rules
        $this->form_validation->set_rules('Usuario', 'Usuário', 'required|trim|callback_valid_usuario');
		#$this->form_validation->set_rules('NomeEmpresa', 'Nome da Empresa', 'required|trim|callback_valid_nomeempresa[' . $usuario . ']');
        $this->form_validation->set_rules('Senha', 'Senha', 'required|trim|md5|callback_valid_senha[' . $usuario . ']');

        if ($this->input->get('m') == 1)
            $data['msg'] = $this->basico->msg('<strong>Informações salvas com sucesso</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 2)
            $data['msg'] = $this->basico->msg('<strong>Erro no Banco de dados. Entre em contato com o administrador deste sistema.</strong>', 'erro', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 3)
            $data['msg'] = $this->basico->msg('<strong>Sua sessão expirou. Faça o login novamente.</strong>', 'erro', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 4)
            $data['msg'] = $this->basico->msg('<strong>Usuário ativado com sucesso! Faça o login para acessar o sistema.</strong>', 'sucesso', TRUE, TRUE, TRUE);
        elseif ($this->input->get('m') == 5)
            $data['msg'] = $this->basico->msg('<strong>Link expirado.</strong>', 'erro', TRUE, TRUE, TRUE);
        else
            $data['msg'] = '';

        #run form validation
        if ($this->form_validation->run() === FALSE) {
            #load login view
            $this->load->view('loginconsultor/form_loginconsultor', $data);
        } else {

            session_regenerate_id(true);

            $query = $this->Loginconsultor_model->check_dados_usuario($senha, $usuario, TRUE);
            #$_SESSION['log']['Agenda'] = $this->Loginconsultor_model->get_agenda_padrao($query['idApp_Consultor']);

            #echo "<pre>".print_r($query)."</pre>";
            #exit();

            if ($query === FALSE) {
                #$msg = "<strong>Senha</strong> incorreta ou <strong>usuário</strong> inexistente.";
                #$this->basico->erro($msg);
                $data['msg'] = $this->basico->msg('<strong>Senha</strong> incorreta.', 'erro', FALSE, FALSE, FALSE);
				#$data['msg'] = $this->basico->msg('<strong>NomeEmpresa</strong> incorreta.', 'erro', FALSE, FALSE, FALSE);
                $this->load->view('form_login', $data);

            } else {
                #initialize session
                $this->load->driver('session');

                #$_SESSION['log']['Usuario'] = $query['Usuario'];
                //se for necessário reduzir o tamanho do nome de usuário, que pode ser um email
                $_SESSION['log']['Usuario'] = (strlen($query['Usuario']) > 15) ? substr($query['Usuario'], 0, 15) : $query['Usuario'];
                $_SESSION['log']['NomeConsultor2'] = (strlen($query['NomeConsultor']) > 8) ? substr($query['NomeConsultor'], 0, 8) : $query['NomeConsultor'];
				$_SESSION['log']['NomeConsultor'] = $query['NomeConsultor'];
				$_SESSION['log']['id'] = $query['idApp_Consultor'];
				$_SESSION['log']['idSis_EmpresaFilial'] = $query['idSis_EmpresaFilial'];
				$_SESSION['log']['idSis_EmpresaMatriz'] = $query['idSis_EmpresaMatriz'];
				$_SESSION['log']['Empresa'] = $query['Empresa'];
				$_SESSION['log']['NomeEmpresa2'] = (strlen($query['NomeEmpresa']) > 12) ? substr($query['NomeEmpresa'], 0, 12) : $query['NomeEmpresa'];
				$_SESSION['log']['NomeEmpresa'] = $query['NomeEmpresa'];				
				$_SESSION['log']['Nivel'] = $query['Nivel'];
				$_SESSION['log']['Permissao'] = $query['Permissao'];
				$_SESSION['log']['Funcao'] = $query['Funcao'];
				$_SESSION['log']['Associado'] = $query['Associado'];

                $this->load->database();
                $_SESSION['db']['hostname'] = $this->db->hostname;
                $_SESSION['db']['username'] = $this->db->username;
                $_SESSION['db']['password'] = $this->db->password;
                $_SESSION['db']['database'] = $this->db->database;

                if ($this->Loginconsultor_model->set_acesso($_SESSION['log']['id'], 'LOGIN') === FALSE) {
                    $msg = "<strong>Erro no Banco de dados. Entre em contato com o Administrador.</strong>";

                    $this->basico->erro($msg);
                    $this->load->view('form_loginconsultor');
                } else {
					redirect('acessoconsultor');
					#redirect('acesso');
					#redirect('agenda');
					#redirect('cliente');
                }
            }
        }

        #load footer view
        $this->load->view('basico/footerloginconsultor');
        $this->load->view('basico/footer');
    }

    function valid_usuario($data) {

        if ($this->Loginconsultor_model->check_usuario($data) == 1) {
            $this->form_validation->set_message('valid_usuario', '<strong>%s</strong> não existe.');
            return FALSE;
        } else if ($this->Loginconsultor_model->check_usuario($data) == 2) {
            $this->form_validation->set_message('valid_usuario', '<strong>%s</strong> inativo! Fale com o Administrador da sua Empresa!');
            return FALSE;
        } else if ($this->Loginconsultor_model->check_usuario($data) == 3) {
            $this->form_validation->set_message('valid_usuario', '<strong>%s</strong> Acesso Errado! Entre pelo Acesso Correto!');
            return FALSE;
        } else if ($this->Loginconsultor_model->check_usuario($data) == 4) {
            $this->form_validation->set_message('valid_usuario', '<strong>%s</strong> Rede Errada! Entre pelo Rede Correta!');
            return FALSE;			
		} else {
            return TRUE;
        }
    }

    function valid_senha($senha, $usuario) {

        if ($this->Loginconsultor_model->check_dados_usuario($senha, $usuario) == FALSE) {
            $this->form_validation->set_message('valid_senha', '<strong>%s</strong> incorreta! Ou este não é o Módulo do seu Sistema.');
            return FALSE;
        } else {
            return TRUE;
        }
    }


}
