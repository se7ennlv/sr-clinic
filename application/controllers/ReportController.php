
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReportModel');
		$this->load->model('DiseaseModel');
		$this->load->model('MedicineModel');
		$this->load->model('AppModel');
		$this->load->library('pdf_report');
	}

	public function VisitView()
	{
		$this->load->view('reports/VisitView');
	}

	public function VisitDetailView()
	{
		$this->load->view('reports/VisitDetailView');
	}

	public function FetchAllVisitDetail()
	{
		$data['trans'] = $this->ReportModel->FindAllDocNo();
		$data['items'] = $this->ReportModel->FindAllVisitDetail();
		$this->load->view('reports/VisitDetailList', $data);
	}
	// --------------------------------------------
	public function FetchAllDistributed()
	{

		$data['depts'] = $this->ReportModel->FindTranDepts();
		// $data['docs'] = $this->ReportModel->FindDocNo1();
		$data['details'] = $this->ReportModel->FindAllDetail();
		$this->load->view('reports/DrugSummaryByDeptList', $data);
	}
	// ----------------------------------------------------
	public function FetchAllVisit()
	{
		$lists['lists'] = $this->ReportModel->FindAllVisit();
		$visit['dises'] = $this->DiseaseModel->FindAllDiseases();
		$visit['mds'] = $this->MedicineModel->FindAllMedicines();

		$this->load->view('reports/VisitList', $lists);
		$this->load->view('reports/UpdateModal', $visit);
		$this->load->view('global/MedicalCertificateView');
		$this->load->view('global/GlobalScript');
	}

	public function FetchSickLeaveByDocNo($docNo)
	{
		$data['sl'] = $this->ReportModel->FindSickLeaveByDocNo($docNo);
		$data['sld'] = $this->ReportModel->FindSickLeaveDetailByDocNo($docNo);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function FetchDataByDocNo($docNo)
	{
		$data['visit'] = $this->ReportModel->FindVisitByDocNo($docNo);
		$data['dispensing'] = $this->ReportModel->FindDispensingByDocNo($docNo);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function InitVoided($id)
	{
		$this->ReportModel->ExecuteVoided($id);
	}

	public function FetchAllSummary()
	{
		$data['bygroup'] = $this->ReportModel->FindCountByPatientGroup();
		$data['bydept'] = $this->ReportModel->FindCountByDept();
		$data['bygender'] = $this->ReportModel->FindCountByGender();

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function ShowAllMedAlerts()
	{
		$data['mds'] = $this->ReportModel->FindAllMedAlerts();
		$this->load->view('reports/ShowAllMedAlerts', $data);
	}

	public function DeptSummaryView()
	{
		$this->load->view('reports/DeptSummaryView');
	}

	public function FetchDeptSummary($fDate, $tDate)
	{
		$data['depts'] = $this->ReportModel->FindAllDepts();
		$data['dates'] = $this->DateRange($fDate, $tDate);

		$this->load->view('reports/DeptSummaryList', $data);
	}
	public function FetchMedSummary($fDate, $tDate)
	{
		$data['meds'] = $this->ReportModel->FindAllMed();
		$data['dates'] = $this->DateRange($fDate, $tDate);
		$this->load->view('reports/DrugSummaryList', $data);
	}

	public function GenderSummaryView()
	{
		$this->load->view('reports/GenderSummaryView');
	}
	public function DrugSummaryByDeptView()
	{
		$this->load->view('reports/DrugSummaryByDeptView');
	}
	public function DrugSummaryView()
	{
		$this->load->view('reports/DrugSummaryView');
	}

	public function FetchGenderSummary($fDate, $tDate)
	{
		$data['dates'] = $this->DateRange($fDate, $tDate);
		$this->load->view('reports/GenderSummaryList', $data);
	}
	public function DateRange($fDate, $tDate, $step = '1 day', $format = 'Y-m-d')
	{
		$dates = array();
		$fromDate = strtotime($fDate);
		$toDate = strtotime($tDate);

		$interval = date_diff(date_create($fDate), date_create($tDate));
		$dateDiff = $interval->days + 1;

		while ($fromDate <= $toDate) {
			$dates[] = date($format, $fromDate);
			$fromDate = strtotime($step, $fromDate);
		}

		$dataArray = array(
			'numDays' => $dateDiff,
			'days' => $dates
		);

		return $dataArray;
	}
	public function MonthlyView()
	{
		$this->load->view('reports/MonthlyView');
	}
	public function PrintReportView()
	{
		$fDate = $this->input->get('fDate');
		$tDate = $this->input->get('tDate');

		$data['fDate'] = $fDate;
		$data['tDate'] = $tDate;
		$data['sumtime'] = $this->ReportModel->FindCountByGender1($fDate, $tDate);
		$data['mf'] = $this->ReportModel->FindCountMaleFemale($fDate, $tDate);

		$this->load->view('reports/printPdf/MonthlyPrint', $data);
	}
	public function PrintReportPetiatBydept()
	{
		$fDate = $this->input->get('fDate');
		$tDate = $this->input->get('tDate');
		$data['fDate'] = $fDate;
		$data['tDate'] = $tDate;
		$data['depts'] = $this->ReportModel->FindAllVisitByDepts($fDate,$tDate);
		$this->load->view('reports/printPdf/MonthlyByDeptPrint',$data);
	}
	public function PrintReportDiseases()
	{
		$fDate = $this->input->get('fDate');
		$tDate = $this->input->get('tDate');
		$data['fDate'] = $fDate;
		$data['tDate'] = $tDate;
		$data['dises'] = $this->ReportModel->FindDiseases($fDate,$tDate);
		$this->load->view('reports/printPdf/MonthlyDiseasesPrint',$data);
	}

	
}
