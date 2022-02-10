<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DiseaseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DiseaseModel');
    }

    public function index()
    {
        $this->DiseaseListView();
    }

    public function DiseaseListView()
    {
        $data['diseases'] = $this->DiseaseModel->FindAllDiseases();
        $this->load->view('diseases/DiseasesView', $data);
    }

    public function FetchOneDisease($did)
    {
        $data = $this->DiseaseModel->FindOneDisease($did);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchAllDisease()
    {
        $data = $this->DiseaseModel->FindAllDisease();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchDiseaseDataTable()
    {
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
		$param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
        $results = $this->DiseaseModel->FindDiseaseDataTable($param);
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function InitInsertDisease()
    {
        $this->DiseaseModel->ExecuteInsertDisease();
    }

    public function InitUpdateDisease()
    {
        $this->DiseaseModel->ExecuteUpdateDisease();
    }

    public function InitDeleteDisease($did)
	{
		$this->DiseaseModel->ExecuteDeleteDisease($did);
	}

    
}
