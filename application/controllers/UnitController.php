<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnitController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UnitModel');
    }

    public function index()
    {
        $this->UnitView();
    }

    public function UnitView()
    {
        $data['units'] = $this->UnitModel->FindAllUnits();
        $this->load->view('units/UnitsView', $data);
    }

    public function FetchOneUnit($uid)
    {
        $data = $this->UnitModel->FindOneUnit($uid);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchAllUnit()
    {
        $data = $this->UnitModel->FindAllUnit();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchUnitDataTable()
    {
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
		$param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
        $results = $this->UnitModel->FindUnitDataTable($param);
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function InitInsertUnit()
    {
        $this->UnitModel->ExecuteInsertUnit();
    }

    public function InitUpdateUnit()
    {
        $this->UnitModel->ExecuteUpdateUnit();
    }

    public function InitDeleteUnit($uid)
	{
		$this->UnitModel->ExecuteDeleteUnit($uid);
    }
    

}
