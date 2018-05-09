<?php

#modelo que verifica usu�rio e senha e loga o usu�rio no sistema, criando as sess�es necess�rias

defined('BASEPATH') OR exit('No direct script access allowed');

class orcatrataprintcons_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('basico');
        $this->load->model(array('Basico_model'));
    }

    public function get_orcatrata($data) {

        /*
        OT.DataOrca,
        OT.DataPrazo,
        OT.DataConclusao,
        OT.DataRetorno,
        OT.DataEntradaOrca,
        OT.idApp_Cliente,

        OT.ValorOrca,
        OT.ValorEntradaOrca,
        OT.ValorRestanteOrca,
        FP.FormaPag,
        OT.QtdParcelasOrca,
        OT.DataVencimentoOrca
        */        

        $query = $this->db->query(
            'SELECT
                *
            FROM           	
                Tab_FormaPag AS FP,
				App_OrcaTrataCons AS OT
				LEFT JOIN Sis_EmpresaFilial AS EF ON EF.idSis_EmpresaFilial = OT.Empresa
            WHERE
            	OT.idApp_OrcaTrataCons = ' . $data . ' AND
                OT.FormaPagamento = FP.idTab_FormaPag'
        );
        $query = $query->result_array();

        /*
        //echo $this->db->last_query();
        echo '<br>';
        echo "<pre>";
        print_r($query);
        echo "</pre>";
        exit ();
        */

        return $query[0];
    }

	public function get_servico($data) {
		$query = $this->db->query(
            'SELECT
            	PV.QtdVendaServico,
				PV.DataValidadeServico,
				PV.ObsServico,
				PV.idApp_ServicoVendaCons,
				PV.idApp_OrcaTrataCons,
				P.UnidadeProduto,
				P.CodProd,
				TP3.Prodaux3,
				TP1.Prodaux1,
            	TP2.Prodaux2,
				TCO.Convenio,
				V.Convdesc,
				TFO.NomeFornecedor,
				CONCAT(IFNULL(PV.idApp_ServicoVendaCons,""), " - Obs.: " , IFNULL(PV.ObsServico,"")) AS idApp_ServicoVendaCons,
				CONCAT(IFNULL(PV.QtdVendaServico,""), " - " , IFNULL(P.UnidadeProduto,"")) AS QtdVendaServico,
            	CONCAT(IFNULL(P.CodProd,""), " -- ", IFNULL(TP3.Prodaux3,""), " -- ", IFNULL(P.Produtos,""), " -- ", IFNULL(TP1.Prodaux1,""), " -- ", IFNULL(TP2.Prodaux2,"")) AS NomeServico,
            	PV.ValorVendaServico
            FROM
            	App_ServicoVendaCons AS PV,
            	Tab_Valor AS V
            		LEFT JOIN Tab_Convenio AS TCO ON idTab_Convenio = V.Convenio
            		LEFT JOIN Tab_Produtos AS P ON P.idTab_Produtos = V.idTab_Produtos
            		LEFT JOIN App_Fornecedor AS TFO ON TFO.idApp_Fornecedor = P.Fornecedor
            		LEFT JOIN Tab_Prodaux3 AS TP3 ON TP3.idTab_Prodaux3 = P.Prodaux3
            		LEFT JOIN Tab_Prodaux2 AS TP2 ON TP2.idTab_Prodaux2 = P.Prodaux2
            		LEFT JOIN Tab_Prodaux1 AS TP1 ON TP1.idTab_Prodaux1 = P.Prodaux1
            WHERE
            	PV.idApp_OrcaTrataCons = ' . $data . ' AND
                PV.idTab_Servico = V.idTab_Valor AND
            	P.idTab_Produtos = V.idTab_Produtos
            ORDER BY
            	PV.idApp_ServicoVendaCons'
        );
        $query = $query->result_array();

        return $query;
    }

    public function get_produto($data) {
		$query = $this->db->query(
            'SELECT
            	PV.QtdVendaProduto,
				PV.DataValidadeProduto,
				PV.ObsProduto,
				PV.idApp_ProdutoVendaCons,
				PV.idApp_OrcaTrataCons,
				P.UnidadeProduto,
				P.CodProd,
				TP3.Prodaux3,
				TP1.Prodaux1,
            	TP2.Prodaux2,
				TCO.Convenio,
				V.Convdesc,
				TFO.NomeFornecedor,
				CONCAT(IFNULL(PV.idApp_ProdutoVendaCons,""), " - Obs.: " , IFNULL(PV.ObsProduto,"")) AS idApp_ProdutoVendaCons,
				CONCAT(IFNULL(PV.QtdVendaProduto,""), " - " , IFNULL(P.UnidadeProduto,"")) AS QtdVendaProduto,
            	CONCAT(IFNULL(P.CodProd,""), " -- ", IFNULL(TP3.Prodaux3,""), " -- ", IFNULL(P.Produtos,""), " -- ", IFNULL(TP1.Prodaux1,""), " -- ", IFNULL(TP2.Prodaux2,"")) AS NomeProduto,
            	PV.ValorVendaProduto
            FROM
            	App_ProdutoVendaCons AS PV,
            	Tab_Valor AS V
            		LEFT JOIN Tab_Convenio AS TCO ON idTab_Convenio = V.Convenio
            		LEFT JOIN Tab_Produtos AS P ON P.idTab_Produtos = V.idTab_Produtos
            		LEFT JOIN App_Fornecedor AS TFO ON TFO.idApp_Fornecedor = P.Fornecedor
            		LEFT JOIN Tab_Prodaux3 AS TP3 ON TP3.idTab_Prodaux3 = P.Prodaux3
            		LEFT JOIN Tab_Prodaux2 AS TP2 ON TP2.idTab_Prodaux2 = P.Prodaux2
            		LEFT JOIN Tab_Prodaux1 AS TP1 ON TP1.idTab_Prodaux1 = P.Prodaux1
            WHERE
            	PV.idApp_OrcaTrataCons = ' . $data . ' AND
                PV.idTab_Produto = V.idTab_Valor AND
            	P.idTab_Produtos = V.idTab_Produtos
            ORDER BY
            	PV.idApp_ProdutoVendaCons'
        );
        $query = $query->result_array();

        return $query;
    }

    public function get_parcelasrec($data) {
		$query = $this->db->query('SELECT * FROM App_ParcelasRecebiveisCons WHERE idApp_OrcaTrataCons = ' . $data);
        $query = $query->result_array();

        return $query;
    }

    public function get_procedimento($data) {
		$query = $this->db->query('SELECT * FROM App_ProcedimentoCons WHERE idApp_OrcaTrataCons = ' . $data);
        $query = $query->result_array();

        return $query;
    }

    public function get_profissional($data) {
		$query = $this->db->query('SELECT NomeProfissional FROM App_Profissional WHERE idApp_Profissional = ' . $data);
        $query = $query->result_array();

        return (isset($query[0]['NomeProfissional'])) ? $query[0]['NomeProfissional'] : FALSE;
    }

}
