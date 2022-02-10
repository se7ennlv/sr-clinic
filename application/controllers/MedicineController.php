<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MedicineController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MedicineModel');
        $this->load->model('UnitModel');
    }

    public function index()
    {
        $this->MedicineView();
    }

    public function MedicineView()
    {
        $data['mds'] = $this->MedicineModel->FindAllMedicines();
        $data['units'] = $this->UnitModel->FindAllUnits();

        $this->load->view('medicines/MedicinesView', $data);
    }

    public function FetchOneMedicine($mid)
    {
        $data = $this->MedicineModel->FindOneMedicine($mid);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchAllMedicines($mid)
    {
        $data = $this->MedicineModel->FindAllMedicines($mid);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchMedDataTable()
    {
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
        $param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
        $results = $this->MedicineModel->FindMedDataTable($param);
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function InitInsertMedicine()
    {
        $this->MedicineModel->ExecuteInsertMedicine();
    }

    public function InitUpdateMedicine()
    {
        $this->MedicineModel->ExecuteUpdateMedicine();
    }

    public function InitUpdateStock()
    {
        $this->MedicineModel->ExecuteUpdateStock();
    }

    public function InitDeleteMedicine($mid)
    {
        $this->MedicineModel->ExecuteDeleteMedicine($mid);
    }

}
