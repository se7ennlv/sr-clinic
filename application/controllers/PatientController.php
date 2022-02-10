<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PatientController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PatientModel');
        $this->load->model('AppModel');
        $this->load->model('DiseaseModel');
        $this->load->model('MedicineModel');
    }

    public function index()
    {
        $this->PatientView();
    }

    public function PatientView()
    {
        $data['depts'] = $this->AppModel->FindAllDepts();
        $data['jobs'] = $this->AppModel->FindAllJobs();
        $data['dises'] = $this->DiseaseModel->FindAllDiseases();
        $data['mds'] = $this->MedicineModel->FindAllMedicines();

        $this->load->view('patients/PatientHisView');
        $this->load->view('patients/PatientModal', $data);
        $this->load->view('global/GlobalScript');
    }

    public function FetchOnePatient()
    {
        $data = $this->PatientModel->FindOnePatient();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchCountOnePatient($pid, $groupId)
    {
        $data = $this->PatientModel->FindCountOnePatient($pid, $groupId);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchOneFullTimeEmp($pid)
    {
        $data = $this->PatientModel->FindOneFullTimeEmp($pid);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchOneDailyEmp($pid)
    {
        $data = $this->PatientModel->FindOneDailyEmp($pid);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchOneCustomer($pid)
    {
        $data = $this->PatientModel->FindOneCustomer($pid);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FetchPatientHisDataTable()
    {
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
		$param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
        $results = $this->PatientModel->FindPatientHisDataTable($param);
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function InitDisablePatient($pid)
    {
        $this->PatientModel->ExecuteDisablePatient($pid);
    }

    public function InitInsertPatient()
    {
        $this->PatientModel->ExecuteInsertPatient();
    }

    public function InitUpdatePatient()
    {
        $this->PatientModel->ExecuteUpdatePatient();
    }


}
