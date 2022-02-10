<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ServiceController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ServiceModel');
        $this->load->model('DiseaseModel');
        $this->load->model('MedicineModel');
        $this->load->model('AppModel');
    }

    public function VisitRecordView()
    {
        $visit['docno'] = $this->ServiceModel->FindDocNo();
        $visit['dises'] = $this->DiseaseModel->FindAllDiseases();
        $visit['mds'] = $this->MedicineModel->FindAllMedicines();

        $sickleave['dgroups'] = $this->DiseaseModel->FindAllDiseasesGroup();
        $sickleave['vss'] = $this->DiseaseModel->FindAllVitalSigns();

        $this->load->view('services/VisitRecordView', $visit);
        $this->load->view('services/SickLeaveModal', $sickleave);
        $this->load->view('global/MedicalCertificateView');
        $this->load->view('global/GlobalScript');
    }

    function InitUpdateSickLeave()
    {
        $this->ServiceModel->ExecuteUpdateSickLeave();
    }

    function InitInsertTransaction()
    {
        $this->ServiceModel->ExecuteInsertTransaction();
    }

    function InitUpdateTransaction()
    {
        $this->ServiceModel->ExecuteUpdateTransaction();
    }

    function InitInsertDispensing()
    {
        $this->ServiceModel->ExecuteInsertDispensing();
    }

    function InitDeleteDispensing($docNo)
    {
        $this->ServiceModel->ExecuteDeleteDispensing($docNo);
    }

    function InitInsertSickLeaveDetail()
    {
        $this->ServiceModel->ExecuteInsertSickLeaveDetail();
    }

    function InitDeleteSickLeave($docNo)
    {
        $this->ServiceModel->ExecuteDeleteSickLeave($docNo);
    }

    public function InitCutStock()
    {
        $this->ServiceModel->ExecuteCutStock();
    }

}
